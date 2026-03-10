@include('musics.form_styles')

<x-app-layout>
    <div class="glass-container py-4" style="margin-top: 5px;">
        <div class="container-fluid px-5 px-xl-5" style="max-width: 90%; margin: 0 auto;">
            <div class="form-glass">
                <!-- Header (Premium Layout) -->
                <div class="d-flex align-items-center justify-content-between mb-8 pb-4 border-bottom flex-wrap gap-4">
                    <div class="d-flex align-items-center">
                        <h1 class="text-4xl font-black text-slate-800 tracking-tighter mb-0 uppercase">Edit Hymn</h1>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-premium btn-cancel px-5 shadow-sm" onclick="window.location.href='/musics'">
                            <i class="fas fa-arrow-left mr-2 opacity-50"></i> {{ __('Back') }}
                        </button>
                        <button type="button" class="btn btn-premium btn-save px-8 shadow-lg transition-all" onclick="document.getElementById('mainEditForm').submit()">
                            <i class="fas fa-check-circle mr-2"></i> {{ __('Save Changes') }}
                        </button>
                    </div>
                </div>

                <form id="mainEditForm" method="POST" action="{{ route('musics.update', ['music' => $musics->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- SECTION 1: CORE INFORMATION -->
                    <div class="section-title">Essential Metadata</div>
                    <div class="form-grid-3">
                        <div>
                            <label class="custom-label">Church Hymn</label>
                            <select required name="edit_church_hymn_id" class="modern-input">
                                @foreach($churchHymns as $churchHymn)
                                    <option value="{{ $churchHymn->id }}" {{ $churchHymn->id == $musics->church_hymn_id ? 'selected' : '' }}>{{ $churchHymn->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="custom-label">Hymn Number</label>
                            <input type="text" name="edit_song_number" value="{{ $musics->song_number }}" class="modern-input" maxlength="4">
                        </div>
                        <div>
                            <label class="custom-label">Language</label>
                            <select required name="edit_language_id" class="modern-input">
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}" {{ $language->id == $musics->language_id ? 'selected' : '' }}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-full">
                            <label class="custom-label">Full Title</label>
                            <input required type="text" name="edit_title" value="{{ $musics->title }}" class="modern-input" maxlength="75">
                        </div>
                    </div>

                    <!-- SECTION 2: AUDIO & MEDIA -->
                    <div class="section-title">Media Files</div>
                    <div class="form-grid-2">
                        @php
                            $files = [
                                'vocals' => ['label' => 'Vocals', 'icon' => 'microphone-alt', 'path' => $musics->vocals_mp3_path],
                                'organ' => ['label' => 'Organ', 'icon' => 'music', 'path' => $musics->organ_mp3_path],
                                'preludes' => ['label' => 'Preludes', 'icon' => 'headphones', 'path' => $musics->preludes_mp3_path],
                            ];
                        @endphp
                        @foreach($files as $key => $file)
                            <div>
                                <label class="custom-label">{{ $file['label'] }} (MP3)</label>
                                <div class="file-upload-card" onclick="document.getElementById('edit_{{ $key }}_mp3_path').click()">
                                    <i class="fas fa-{{ $file['icon'] }}"></i>
                                    <div class="font-bold small text-slate-500 uppercase">REPLACE MP3</div>
                                    <div id="edit_{{ $key }}_preview" class="file-name-preview text-xs opacity-60">
                                        {{ str_replace('music_files/', '', $file['path']) ?: 'No file' }}
                                    </div>
                                    <input type="file" id="edit_{{ $key }}_mp3_path" name="edit_{{ $key }}_mp3_path" hidden accept="audio/mpeg, audio/mp3" onchange="updateFileLabel(this, 'edit_{{ $key }}_preview')">
                                </div>
                            </div>
                        @endforeach

                        <div>
                            <label class="custom-label">Music Score (PDF)</label>
                            <div class="file-upload-card" style="display:flex; align-items:center; justify-content:center; padding:1.5rem;" onclick="document.getElementById('edit_music_score_path').click()">
                                <i class="fas fa-file-pdf mr-3 mb-0" style="color: #ef4444;"></i>
                                <div class="text-left font-bold small text-slate-500 uppercase">Score PDF <div id="score_preview" class="file-name-preview text-xs opacity-60">{{ str_replace('music_files/', '', $musics->music_score_path) ?: 'No file' }}</div></div>
                                <input type="file" id="edit_music_score_path" name="edit_music_score_path" hidden accept=".pdf" onchange="updateFileLabel(this, 'score_preview')">
                            </div>
                        </div>

                        <div style="grid-column: 1 / -1;">
                            <label class="custom-label">Lyrics (PDF)</label>
                            <div class="file-upload-card" style="display:flex; align-items:center; justify-content:center; padding:1.5rem;" onclick="document.getElementById('edit_lyrics_path').click()">
                                <i class="fas fa-pen-fancy mr-3 mb-0 text-blue-400"></i>
                                <div class="text-left font-bold small text-slate-500 uppercase">Lyrics PDF <div id="lyrics_preview" class="file-name-preview text-xs opacity-60">{{ str_replace('music_files/', '', $musics->lyrics_path) ?: 'No file' }}</div></div>
                                <input type="file" id="edit_lyrics_path" name="edit_lyrics_path" hidden accept=".pdf" onchange="updateFileLabel(this, 'lyrics_preview')">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: CLASSIFICATION (RESTORED EXACT FUNCTIONALITY) -->
                    <div class="section-title">Classification & Credits</div>
                    
                    <input type="hidden" id="selected_category_ids" name="category_id[]" value="">
                    <input type="hidden" id="selected_instrumentation_ids" name="instrumentation_id[]" value="">
                    <input type="hidden" id="selected_ensembletype_ids" name="ensemble_type_id[]" value="">               
                    <input type="hidden" id="selected_lyricist_ids" name="lyricist_id[]" value="">
                    <input type="hidden" id="selected_composer_ids" name="composer_id[]" value="">
                    <input type="hidden" id="selected_arranger_ids" name="arranger_id[]" value="">

                    <div class="form-grid-2">
                        @php
                            $multis = [
                                'category' => ['label' => 'Category', 'data' => $categories, 'active' => $musics->categories, 'id_suffix' => 'category'],
                                'instrumentation' => ['label' => 'Instrumentation', 'data' => $instrumentations, 'active' => $musics->instrumentations, 'id_suffix' => 'instrumentation'],
                                'ensembletype' => ['label' => 'Ensemble Type', 'data' => $ensembleTypes, 'active' => $musics->ensembleTypes, 'id_suffix' => 'ensemble_type'],
                                'lyricist' => ['label' => 'Lyricist', 'data' => $lyricists, 'active' => $musics->lyricists, 'id_suffix' => 'lyricist'],
                                'composer' => ['label' => 'Composer', 'data' => $composers, 'active' => $musics->composers, 'id_suffix' => 'composer'],
                                'arranger' => ['label' => 'Arranger', 'data' => $arrangers, 'active' => $musics->arrangers, 'id_suffix' => 'arranger'],
                            ];
                        @endphp

                        @foreach($multis as $id => $multi)
                            <div>
                                <label class="custom-label">{{ $multi['label'] }}</label>
                                <div class="combo-box">
                                    <div class="input-container" onclick="toggleDropdown('{{ $multi['id_suffix'] }}')">
                                        <div id="edit_{{ $id }}_id" class="selected-items">
                                            {{-- Will be initialized by the single script block below --}}
                                        </div>
                                        <input type="text" id="{{ $multi['id_suffix'] }}-input" placeholder="Search {{ $multi['label'] }}...">
                                        <div class="dropdown-arrow"></div>
                                    </div>
                                    <div id="{{ $multi['id_suffix'] }}-options-container" class="options-container">
                                        @foreach($multi['data'] as $item)
                                            <div class="option-item">
                                                <label>
                                                    <input type="checkbox" id="{{ $id }}_check_{{ $item->id }}" value="{{ $item->id }}" 
                                                        {{ $multi['active']->contains('id', $item->id) ? 'checked' : '' }} 
                                                        onclick="handleDropdownSelection(this, 'edit_{{ $id }}_id', 'selected_{{ $id }}_ids')"> 
                                                    {{ $item->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- SECTION 4: REFERENCE VERSES -->
                    <div class="section-title">Reference Verses</div>
                    <div class="verse-picker-row">
                        <!-- 1. Version FIRST -->
                        <div class="verse-field">
                            <label class="custom-label">Version</label>
                            <select id="verse_translation_select" class="modern-input">
                                <option value="" disabled selected>Select Version...</option>
                                <optgroup label="✅ English (text auto-fetch)">
                                    <option value="kjv">KJV – King James Version</option>
                                    <option value="asv">ASV – American Standard Version</option>
                                    <option value="bbe">BBE – Bible in Basic English</option>
                                    <option value="web">WEB – World English Bible</option>
                                    <option value="webbe">WEBBE – World English Bible (British)</option>
                                    <option value="ylt">YLT – Young's Literal Translation</option>
                                    <option value="darby">Darby – Darby Translation</option>
                                </optgroup>
                                <optgroup label="📖 English (reference only)">
                                    <option value="NIV">NIV – New International Version</option>
                                    <option value="ESV">ESV – English Standard Version</option>
                                    <option value="NKJV">NKJV – New King James Version</option>
                                    <option value="NLT">NLT – New Living Translation</option>
                                    <option value="NASB">NASB – New American Standard Bible</option>
                                    <option value="MSG">MSG – The Message</option>
                                    <option value="AMP">AMP – Amplified Bible</option>
                                    <option value="RSV">RSV – Revised Standard Version</option>
                                    <option value="NRSV">NRSV – New Revised Standard Version</option>
                                    <option value="CEV">CEV – Contemporary English Version</option>
                                    <option value="GNT">GNT – Good News Translation</option>
                                    <option value="ISV">ISV – International Standard Version</option>
                                    <option value="HCSB">HCSB – Holman Christian Standard Bible</option>
                                    <option value="CSB">CSB – Christian Standard Bible</option>
                                </optgroup>
                                <optgroup label="🇵🇭 Filipino / Tagalog">
                                    <option value="ADB">ADB – Ang Dating Biblia (1905)</option>
                                    <option value="TAB">TAB – Ang Bagong Biblia</option>
                                    <option value="MBBTAG">MBBTAG – Magandang Balita Biblia</option>
                                    <option value="ASND">ASND – Ang Salita ng Diyos</option>
                                    <option value="SND">SND – Ang Salita ng Dios (Bisaya)</option>
                                    <option value="CBBTAG">CBBTAG – Ang Biblia (Cebuano)</option>
                                    <option value="RTPV">RTPV – Revised Tagalog Popular Version</option>
                                </optgroup>
                                <optgroup label="🌍 Other Languages">
                                    <option value="vulgate">Vulgate – Latin (Clementine)</option>
                                    <option value="RVR">RVR – Reina-Valera (Spanish, 1960)</option>
                                    <option value="NVI">NVI – Nueva Versión Internacional (Spanish)</option>
                                    <option value="LSG">LSG – Louis Segond (French)</option>
                                </optgroup>
                            </select>
                        </div>
                        <!-- 2. Book -->
                        <div class="verse-field-lg">
                            <label class="custom-label">Book</label>
                            <select id="verse_book_select" class="modern-input" onchange="loadChapters()">
                                <option value="" disabled selected>Select Book...</option>
                                <optgroup label="Old Testament">
                                    <option value="Genesis">Genesis</option><option value="Exodus">Exodus</option><option value="Leviticus">Leviticus</option><option value="Numbers">Numbers</option><option value="Deuteronomy">Deuteronomy</option><option value="Joshua">Joshua</option><option value="Judges">Judges</option><option value="Ruth">Ruth</option><option value="1 Samuel">1 Samuel</option><option value="2 Samuel">2 Samuel</option><option value="1 Kings">1 Kings</option><option value="2 Kings">2 Kings</option><option value="1 Chronicles">1 Chronicles</option><option value="2 Chronicles">2 Chronicles</option><option value="Ezra">Ezra</option><option value="Nehemiah">Nehemiah</option><option value="Esther">Esther</option><option value="Job">Job</option><option value="Psalms">Psalms</option><option value="Proverbs">Proverbs</option><option value="Ecclesiastes">Ecclesiastes</option><option value="Song of Solomon">Song of Solomon</option><option value="Isaiah">Isaiah</option><option value="Jeremiah">Jeremiah</option><option value="Lamentations">Lamentations</option><option value="Ezekiel">Ezekiel</option><option value="Daniel">Daniel</option><option value="Hosea">Hosea</option><option value="Joel">Joel</option><option value="Amos">Amos</option><option value="Obadiah">Obadiah</option><option value="Jonah">Jonah</option><option value="Micah">Micah</option><option value="Nahum">Nahum</option><option value="Habakkuk">Habakkuk</option><option value="Zephaniah">Zephaniah</option><option value="Haggai">Haggai</option><option value="Zechariah">Zechariah</option><option value="Malachi">Malachi</option>
                                </optgroup>
                                <optgroup label="New Testament">
                                    <option value="Matthew">Matthew</option><option value="Mark">Mark</option><option value="Luke">Luke</option><option value="John">John</option><option value="Acts">Acts</option><option value="Romans">Romans</option><option value="1 Corinthians">1 Corinthians</option><option value="2 Corinthians">2 Corinthians</option><option value="Galatians">Galatians</option><option value="Ephesians">Ephesians</option><option value="Philippians">Philippians</option><option value="Colossians">Colossians</option><option value="1 Thessalonians">1 Thessalonians</option><option value="2 Thessalonians">2 Thessalonians</option><option value="1 Timothy">1 Timothy</option><option value="2 Timothy">2 Timothy</option><option value="Titus">Titus</option><option value="Philemon">Philemon</option><option value="Hebrews">Hebrews</option><option value="James">James</option><option value="1 Peter">1 Peter</option><option value="2 Peter">2 Peter</option><option value="1 John">1 John</option><option value="2 John">2 John</option><option value="3 John">3 John</option><option value="Jude">Jude</option><option value="Revelation">Revelation</option>
                                </optgroup>
                            </select>
                        </div>
                        <!-- 3. Chapter -->
                        <div class="verse-field-sm">
                            <label class="custom-label">Chapter</label>
                            <select id="verse_chapter_select" class="modern-input" disabled onchange="loadVerses()">
                                <option value="" disabled selected>—</option>
                            </select>
                        </div>
                        <!-- 4. Verse -->
                        <div class="verse-field-sm">
                            <label class="custom-label">Verse</label>
                            <select id="verse_number_select" class="modern-input" disabled>
                                <option value="" disabled selected>—</option>
                                <option value="custom">Custom…</option>
                            </select>
                        </div>
                        <!-- 5. Add button -->
                        <div class="verse-btn">
                            <label class="custom-label" style="visibility:hidden;">Add</label>
                            <button type="button" class="btn btn-premium btn-save" id="addVerseBtn" style="height: 52px; padding: 0 1.4rem; white-space: nowrap;" onclick="addReferenceVerse('edit_versesused')">
                                <i class="fas fa-plus-circle mr-1"></i> Add
                            </button>
                        </div>
                    </div>
                    <div id="verse_fetch_status" class="verse-fetch-status"></div>
                    <div style="margin-bottom: 2.5rem;">
                        <label class="custom-label">Added Verses <span style="color: #94a3b8; font-weight: 400;">(you may also type directly)</span></label>
                        <textarea id="edit_versesused" name="edit_versesused" class="modern-input" rows="4" placeholder='e.g. John 3:16 (KJV) — "For God so loved the world..."'>{{ $musics->verses_used }}</textarea>
                    </div>


                    <div class="d-flex justify-content-end gap-3 mt-10 pt-6 border-top">
                        <button type="button" class="btn btn-premium btn-cancel px-8" onclick="window.location.href='/musics'">
                            <i class="fas fa-arrow-left mr-2 opacity-50"></i> Back to Library
                        </button>
                        <button type="submit" class="btn btn-premium btn-save px-10 shadow-lg">
                            <i class="fas fa-save mr-2"></i> Update Masterpiece
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('bible_metadata.js') }}"></script>
<script>
    // Translations supported by bible-api.com (free, open-source texts)
    const BIBLE_API_VERSIONS = new Set(['kjv','asv','bbe','web','webbe','ylt','darby','vulgate']);

    function loadChapters() {
        const book = document.getElementById('verse_book_select').value;
        const chapterSel = document.getElementById('verse_chapter_select');
        const verseSel = document.getElementById('verse_number_select');
        chapterSel.innerHTML = '<option value="" disabled selected>—</option>';
        verseSel.innerHTML = '<option value="" disabled selected>—</option><option value="custom">Custom…</option>';
        chapterSel.disabled = true; verseSel.disabled = true;
        if (!book || !window.bibleMetadata || !window.bibleMetadata[book]) return;
        const count = window.bibleMetadata[book].length;
        for (let i = 1; i <= count; i++) chapterSel.appendChild(new Option(i, i));
        chapterSel.disabled = false;
    }

    function loadVerses() {
        const book = document.getElementById('verse_book_select').value;
        const chapter = document.getElementById('verse_chapter_select').value;
        const verseSel = document.getElementById('verse_number_select');
        verseSel.innerHTML = '<option value="" disabled selected>—</option><option value="custom">Custom…</option>';
        verseSel.disabled = true;
        if (!chapter || !window.bibleMetadata || !window.bibleMetadata[book]) return;
        const count = window.bibleMetadata[book][parseInt(chapter) - 1];
        for (let i = 1; i <= count; i++) verseSel.appendChild(new Option(i, i));
        verseSel.disabled = false;
    }

    async function addReferenceVerse(textareaId) {
        const version  = document.getElementById('verse_translation_select').value;
        const book     = document.getElementById('verse_book_select').value;
        const chapter  = document.getElementById('verse_chapter_select').value;
        const verseEl  = document.getElementById('verse_number_select');
        const statusEl = document.getElementById('verse_fetch_status');
        const textarea = document.getElementById(textareaId);

        if (verseEl.value === 'custom') {
            const v = prompt('Enter verse number or range (e.g. 3 or 1-5):');
            if (!v) return;
            verseEl.add(new Option(v, v, true, true));
        }

        const verse = verseEl.value;
        if (!version || !book || !chapter || !verse || verse === 'custom') {
            alert('Please select Version, Book, Chapter, and Verse.');
            return;
        }

        const ref = `${book} ${chapter}:${verse} (${version.toUpperCase()})`;
        const btn = document.getElementById('addVerseBtn');
        btn.disabled = true;
        statusEl.textContent = '⏳ Fetching verse text...';

        let entry = ref;

        try {
            const params = new URLSearchParams({ version, book, chapter, verse });
            const res = await fetch(`/bible-verse?${params}`);
            if (res.ok) {
                const data = await res.json();
                if (data.text) {
                    entry = `${ref}\n"${data.text}"`;
                    statusEl.textContent = `✅ Retrieved from ${data.source || 'Bible API'}`;
                } else if (data.fallback) {
                    statusEl.textContent = `ℹ️ ${data.reason || 'Text not available'} — reference added.`;
                } else {
                    statusEl.textContent = '⚠️ Text not found — reference added.';
                }
            } else {
                statusEl.textContent = '⚠️ Server error — reference added.';
            }
        } catch(e) {
            statusEl.textContent = '⚠️ Network error — reference added.';
        }

        textarea.value = textarea.value.trim() ? textarea.value.trim() + '\n\n' + entry : entry;
        btn.disabled = false;
        setTimeout(() => statusEl.textContent = '', 5000);
    }

    // --- RESTORED ORIGINAL VANILLA JS LOGIC ---
    function updateHiddenInput(dropdownId) {
        let container = document.getElementById(`edit_${dropdownId}_id`);
        let hiddenInput = document.getElementById(`selected_${dropdownId}_ids`);
        let ids = Array.from(container.querySelectorAll('.selected-tag')).map(t => t.getAttribute('data-id'));
        hiddenInput.value = ids.join(',') + (ids.length ? ',' : '');
    }

    function appendLoadedItem(container, name, id, dropdownId) {
        let tag = document.createElement("div");
        tag.className = "selected-tag anim-pop";
        tag.textContent = name;
        tag.setAttribute('data-id', id);

        let removeButton = document.createElement("span");
        removeButton.textContent = "×";
        removeButton.onclick = function(e) {
            e.stopPropagation();
            let checkbox = document.getElementById(`${dropdownId}_check_${id}`);
            if (checkbox) checkbox.checked = false;
            tag.remove();
            updateHiddenInput(dropdownId);
        };

        tag.appendChild(removeButton);
        container.appendChild(tag);
        updateHiddenInput(dropdownId);
    }

    function toggleDropdown(id) {
        document.getElementById(`${id}-options-container`).classList.toggle("active");
    }

    function handleDropdownSelection(checkbox, containerId, hiddenInputId) {
        let container = document.getElementById(containerId);
        let prefix = containerId.replace('edit_', '').replace('_id', '');
        
        if (checkbox.checked) {
            appendLoadedItem(container, checkbox.parentNode.textContent.trim(), checkbox.value, prefix);
        } else {
            Array.from(container.children).forEach(tag => {
                if (tag.getAttribute('data-id') == checkbox.value) tag.remove();
            });
            updateHiddenInput(prefix);
        }
    }

    function filterDropdownOptions(inputId, containerId) {
        let val = document.getElementById(inputId).value.toUpperCase();
        let items = document.getElementById(containerId).querySelectorAll('.option-item');
        items.forEach(item => {
            item.style.display = item.textContent.toUpperCase().includes(val) ? "" : "none";
        });
    }

    function attachFilterListeners(inputId, containerId) {
        document.getElementById(inputId).addEventListener('input', () => {
            filterDropdownOptions(inputId, containerId);
            document.getElementById(containerId).classList.add('active');
        });
    }

    document.addEventListener('click', (e) => {
        document.querySelectorAll('.combo-box').forEach(box => {
            if (!box.contains(e.target)) box.querySelector('.options-container').classList.remove('active');
        });
    });

    ['category', 'instrumentation', 'ensemble_type', 'lyricist', 'composer', 'arranger'].forEach(id => {
        attachFilterListeners(`${id}-input`, `${id}-options-container`);
    });

    function updateFileLabel(input, previewId) {
        let name = input.files[0] ? input.files[0].name : '';
        document.getElementById(previewId).innerHTML = `<b>${name}</b>`;
    }

    // Unified Initialization Block
    document.addEventListener('DOMContentLoaded', () => {
        const initialSelections = {
            @foreach($multis as $id => $multi)
                '{{ $id }}': @js($multi['active']->map(fn($m) => ['id' => $m->id, 'name' => $m->name])),
            @endforeach
        };

        Object.keys(initialSelections).forEach(key => {
            const container = document.getElementById(`edit_${key}_id`);
            if (container) {
                initialSelections[key].forEach(item => {
                    appendLoadedItem(container, item.name, item.id, key);
                });
            }
        });
    });
</script>
