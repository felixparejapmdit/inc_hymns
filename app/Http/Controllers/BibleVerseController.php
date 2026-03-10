<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BibleVerseController extends Controller
{
    /**
     * Versions handled by bible-api.com (free, no API key needed).
     */
    private array $bibleApiComVersions = [
        'kjv', 'asv', 'bbe', 'web', 'webbe', 'ylt', 'darby', 'vulgate',
    ];

    /**
     * Mapping from our version codes → API.Bible Bible IDs.
     * Full list of available Bibles: https://api.scripture.api.bible/v1/bibles
     * (pass your API key as header: api-key: YOUR_KEY)
     *
     * NOTE: NIV is NOT available on API.Bible (copyrighted & not licensed to them).
     * The versions below ARE available and confirmed on the platform.
     */
    private array $apiBibleIds = [
        // ── English ──────────────────────────────────────────────────────────
        'ESV'   => '01b29f4b342acc35-01',   // English Standard Version 2016
        'NKJV'  => 'de4e12af7f28f599-02',   // New King James Version (check your dashboard)
        'NLT'   => 'Not-Available',          // NLT is not on API.Bible
        'NIV'   => 'Not-Available',          // NIV is not on API.Bible
        'NASB'  => '01b29f4b342acc35-02',   // NASB (verify in dashboard)
        'MSG'   => 'Not-Available',          // The Message not on API.Bible
        'AMP'   => 'Not-Available',          // Amplified not on API.Bible
        'RSV'   => '7142879509583d59-01',   // Revised Standard Version
        'NRSV'  => '71a9061bca21e2c3-01',   // New Revised Standard Version (Anglicised)
        'CEV'   => 'Not-Available',          // CEV not on API.Bible
        'GNT'   => 'Not-Available',          // GNT — check your dashboard
        'ISV'   => 'de4e12af7f28f599-03',   // ISV (verify in dashboard)
        'HCSB'  => 'Not-Available',          // HCSB not on API.Bible
        'CSB'   => 'Not-Available',          // CSB not on API.Bible

        // ── Filipino / Tagalog ───────────────────────────────────────────────
        'ADB'   => '522a10ced2d33f12-02',   // Ang Dating Biblia (1905)
        'TAB'   => '522a10ced2d33f12-03',   // Ang Bagong Biblia (verify)
        'MBBTAG'=> 'Not-Available',          // MBBTAG — check your dashboard
        'ASND'  => 'Not-Available',          // ASND — check your dashboard
        'SND'   => 'Not-Available',          // Bisaya — check your dashboard
        'CBBTAG'=> 'Not-Available',          // Cebuano — check your dashboard
        'RTPV'  => 'Not-Available',          // RTPV — check your dashboard

        // ── Other Languages ──────────────────────────────────────────────────
        'RVR'   => 'b32b9d1b64b4ef29-01',   // Reina-Valera 1960 (Spanish)
        'NVI'   => 'Not-Available',          // NVI not on API.Bible
        'LSG'   => '3b39849b855e6c91-01',   // Louis Segond 1910 (French)
    ];

    /**
     * Book name → OSIS ID mapping for API.Bible verse IDs.
     */
    private array $osisIds = [
        'Genesis'         => 'GEN', 'Exodus'           => 'EXO', 'Leviticus'        => 'LEV',
        'Numbers'         => 'NUM', 'Deuteronomy'      => 'DEU', 'Joshua'           => 'JOS',
        'Judges'          => 'JDG', 'Ruth'             => 'RUT', '1 Samuel'         => '1SA',
        '2 Samuel'        => '2SA', '1 Kings'          => '1KI', '2 Kings'          => '2KI',
        '1 Chronicles'    => '1CH', '2 Chronicles'     => '2CH', 'Ezra'             => 'EZR',
        'Nehemiah'        => 'NEH', 'Esther'           => 'EST', 'Job'              => 'JOB',
        'Psalms'          => 'PSA', 'Proverbs'         => 'PRO', 'Ecclesiastes'     => 'ECC',
        'Song of Solomon' => 'SNG', 'Isaiah'           => 'ISA', 'Jeremiah'         => 'JER',
        'Lamentations'    => 'LAM', 'Ezekiel'          => 'EZK', 'Daniel'           => 'DAN',
        'Hosea'           => 'HOS', 'Joel'             => 'JOL', 'Amos'             => 'AMO',
        'Obadiah'         => 'OBA', 'Jonah'            => 'JON', 'Micah'            => 'MIC',
        'Nahum'           => 'NAM', 'Habakkuk'         => 'HAB', 'Zephaniah'        => 'ZEP',
        'Haggai'          => 'HAG', 'Zechariah'        => 'ZEC', 'Malachi'          => 'MAL',
        'Matthew'         => 'MAT', 'Mark'             => 'MRK', 'Luke'             => 'LUK',
        'John'            => 'JHN', 'Acts'             => 'ACT', 'Romans'           => 'ROM',
        '1 Corinthians'   => '1CO', '2 Corinthians'    => '2CO', 'Galatians'        => 'GAL',
        'Ephesians'       => 'EPH', 'Philippians'      => 'PHP', 'Colossians'       => 'COL',
        '1 Thessalonians' => '1TH', '2 Thessalonians'  => '2TH', '1 Timothy'        => '1TI',
        '2 Timothy'       => '2TI', 'Titus'            => 'TIT', 'Philemon'         => 'PHM',
        'Hebrews'         => 'HEB', 'James'            => 'JAS', '1 Peter'          => '1PE',
        '2 Peter'         => '2PE', '1 John'           => '1JN', '2 John'           => '2JN',
        '3 John'          => '3JN', 'Jude'             => 'JUD', 'Revelation'       => 'REV',
    ];

    /**
     * Fetch verse text. Called by the frontend via GET /bible-verse
     * Query params: version, book, chapter, verse
     */
    public function fetch(Request $request)
    {
        $version = trim($request->query('version', ''));
        $book    = trim($request->query('book', ''));
        $chapter = trim($request->query('chapter', ''));
        $verse   = trim($request->query('verse', ''));

        if (!$version || !$book || !$chapter || !$verse) {
            return response()->json(['error' => 'Missing parameters.'], 400);
        }

        $versionLower = strtolower($version);

        // ── Strategy 1: Bible-API.com (free, open-source texts) ──────────────
        if (in_array($versionLower, $this->bibleApiComVersions)) {
            return $this->fetchFromBibleApiCom($book, $chapter, $verse, $versionLower);
        }

        // ── Strategy 2: API.Bible (requires SCRIPTURE_API_KEY in .env) ───────
        $apiKey = config('services.scripture.key');
        $bibleId = $this->apiBibleIds[$version] ?? null;

        if ($apiKey && $bibleId && $bibleId !== 'Not-Available') {
            return $this->fetchFromApiBible($book, $chapter, $verse, $bibleId, $version, $apiKey);
        }

        // ── Strategy 3: Fallback — return reference only ─────────────────────
        $reason = !$apiKey
            ? 'SCRIPTURE_API_KEY not set in .env'
            : (!$bibleId ? 'Version not yet mapped' : 'Version not available on API.Bible');

        return response()->json([
            'text'      => null,
            'reference' => "{$book} {$chapter}:{$verse}",
            'version'   => strtoupper($version),
            'fallback'  => true,
            'reason'    => $reason,
        ]);
    }

    /**
     * Fetch from bible-api.com (GET /{passage}?translation={version})
     */
    private function fetchFromBibleApiCom(string $book, string $chapter, string $verse, string $version): \Illuminate\Http\JsonResponse
    {
        try {
            $passage = urlencode("{$book} {$chapter}:{$verse}");
            $response = Http::timeout(8)->get("https://bible-api.com/{$passage}?translation={$version}");

            if ($response->successful()) {
                $data = $response->json();
                $text = isset($data['text']) ? str_replace("\n", ' ', trim($data['text'])) : null;

                return response()->json([
                    'text'      => $text,
                    'reference' => "{$book} {$chapter}:{$verse}",
                    'version'   => strtoupper($version),
                    'source'    => 'bible-api.com',
                    'fallback'  => false,
                ]);
            }
        } catch (\Exception $e) {
            Log::warning("BibleVerseController: bible-api.com error: " . $e->getMessage());
        }

        return response()->json([
            'text' => null, 'reference' => "{$book} {$chapter}:{$verse}",
            'version' => strtoupper($version), 'fallback' => true, 'reason' => 'Network error',
        ]);
    }

    /**
     * Fetch from API.Bible (scripture.api.bible)
     * Verse ID format: BOOK.CHAPTER.VERSE (e.g. JHN.3.16)
     */
    private function fetchFromApiBible(string $book, string $chapter, string $verse, string $bibleId, string $version, string $apiKey): \Illuminate\Http\JsonResponse
    {
        $bookId = $this->osisIds[$book] ?? null;

        if (!$bookId) {
            return response()->json([
                'text' => null, 'reference' => "{$book} {$chapter}:{$verse}",
                'version' => strtoupper($version), 'fallback' => true, 'reason' => "Book '{$book}' not mapped",
            ]);
        }

        // Handle verse ranges like "1-5" → fetch verse 1 only for now
        $verseNum = explode('-', $verse)[0];
        $verseId  = "{$bookId}.{$chapter}.{$verseNum}";

        try {
            $url = "https://api.scripture.api.bible/v1/bibles/{$bibleId}/verses/{$verseId}";
            $response = Http::timeout(10)->withHeaders(['api-key' => $apiKey])->get($url, [
                'content-type'              => 'text',
                'include-notes'             => 'false',
                'include-titles'            => 'false',
                'include-chapter-numbers'   => 'false',
                'include-verse-numbers'     => 'false',
                'include-verse-spans'       => 'false',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $raw  = $data['data']['content'] ?? '';
                // Strip any HTML tags that the API might return
                $text = strip_tags(str_replace("\n", ' ', trim($raw)));
                $text = preg_replace('/\s+/', ' ', $text);

                return response()->json([
                    'text'      => $text ?: null,
                    'reference' => "{$book} {$chapter}:{$verse}",
                    'version'   => strtoupper($version),
                    'source'    => 'api.scripture.api.bible',
                    'fallback'  => false,
                ]);
            }

            Log::warning("API.Bible returned " . $response->status() . " for {$verseId} ({$version})");
        } catch (\Exception $e) {
            Log::warning("BibleVerseController: API.Bible error: " . $e->getMessage());
        }

        return response()->json([
            'text' => null, 'reference' => "{$book} {$chapter}:{$verse}",
            'version' => strtoupper($version), 'fallback' => true, 'reason' => 'API.Bible fetch failed',
        ]);
    }

    /**
     * List all available Bibles from API.Bible (helper for discovering Bible IDs).
     * Visit: GET /bible-verse/list-bibles?lang=eng
     */
    public function listBibles(Request $request)
    {
        $apiKey = config('services.scripture.key');
        if (!$apiKey) {
            return response()->json(['error' => 'SCRIPTURE_API_KEY not set in .env'], 503);
        }

        $lang = $request->query('lang', 'tgl'); // default tagalog, use 'eng' for English

        try {
            $response = Http::withHeaders(['api-key' => $apiKey])
                ->get("https://api.scripture.api.bible/v1/bibles", ['language' => $lang]);
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
