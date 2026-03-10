<?php

$fileName = __DIR__ . '/bible_data.json';
if (!file_exists($fileName)) {
    die("Data file not found\n");
}

$content = file_get_contents($fileName);
$data = json_decode($content, true);

if (!$data) {
    die("Failed to decode JSON\n");
}

$metadata = [];
foreach ($data as $book) {
    $chapterVerses = [];
    foreach ($book['chapters'] as $chapter) {
        $chapterVerses[] = count($chapter);
    }
    $metadata[$book['name']] = $chapterVerses;
}

file_put_contents(__DIR__ . '/bible_metadata.json', json_encode($metadata));
echo "Successfully built bible_metadata.json\n";
