@include('musics.form_styles')

<x-app-layout>
    <div class="glass-container py-4" style="margin-top: 5px;">
        <div class="container-fluid px-5 px-xl-5" style="max-width: 90%; margin: 0 auto;">
            <div class="form-glass">
                <!-- Header (Premium Single-Row) -->
                <div class="d-flex align-items-center justify-content-between mb-8 pb-4 border-bottom flex-wrap gap-4">
                    <div class="d-flex align-items-center">
                        <h1 class="text-4xl font-black text-slate-800 tracking-tighter mb-0 uppercase">New Hymn</h1>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-premium btn-cancel px-5 shadow-sm" onclick="cancelWithWarning()">
                            <i class="fas fa-arrow-left mr-2 opacity-50"></i> {{ __('Back to Library') }}
                        </button>
                        <button type="submit" form="createMusicForm" class="btn btn-premium btn-save px-8 shadow-lg">
                            <i class="fas fa-check-circle mr-2"></i> {{ __('Save Hymn') }}
                        </button>
                    </div>
                </div>

                <form id="createMusicForm" method="POST" action="{{ route('musics.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- SECTION 1: BASIC INFORMATION -->
                    <div class="section-title">Core Details</div>
                    <div class="form-grid-3">
                        <div>
                            <label class="custom-label">Church Hymn</label>
                            <select required name="church_hymn_id" class="modern-input">
                                <option value="" disabled selected>Select Church Hymn</option>
                                @foreach($churchHymns as $churchHymn)
                                    <option value="{{ $churchHymn->id }}">{{ $churchHymn->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="custom-label">Hymn Number</label>
                            <input type="text" name="song_number" class="modern-input" maxlength="4" placeholder="001">
                        </div>
                        <div>
                            <label class="custom-label">Language</label>
                            <select required name="language_id" class="modern-input">
                                <option value="" disabled selected>Select Language</option>
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-full">
                            <label class="custom-label">Full Title</label>
                            <input required type="text" name="add_title" class="modern-input" maxlength="75" placeholder="Enter hymn title...">
                        </div>
                    </div>

                    <!-- SECTION 2: AUDIO & MEDIA -->
                    <div class="section-title">Recordings &amp; Files</div>
                    <div class="form-grid-2">
                        <div>
                            <label class="custom-label">Vocals (MP3)</label>
                            <div class="file-upload-card" onclick="document.getElementById('vocals_mp3_path').click()">
                                <i class="fas fa-microphone-alt"></i>
                                <div class="font-bold small text-slate-500">UPLOAD MP3</div>
                                <div id="vocals_preview" class="file-name-preview"></div>
                                <input type="file" id="vocals_mp3_path" name="vocals_mp3_path" hidden accept="audio/mpeg, audio/mp3" onchange="updateFileLabel(this, 'vocals_preview')">
                            </div>
                        </div>
                        <div>
                            <label class="custom-label">Organ (MP3)</label>
                            <div class="file-upload-card" onclick="document.getElementById('organ_mp3_path').click()">
                                <i class="fas fa-music"></i>
                                <div class="font-bold small text-slate-500">UPLOAD MP3</div>
                                <div id="organ_preview" class="file-name-preview"></div>
                                <input type="file" id="organ_mp3_path" name="organ_mp3_path" hidden accept="audio/mpeg, audio/mp3" onchange="updateFileLabel(this, 'organ_preview')">
                            </div>
                        </div>
                        <div>
                            <label class="custom-label">Preludes (MP3)</label>
                            <div class="file-upload-card" onclick="document.getElementById('preludes_mp3_path').click()">
                                <i class="fas fa-headphones"></i>
                                <div class="font-bold small text-slate-500">UPLOAD MP3</div>
                                <div id="preludes_preview" class="file-name-preview"></div>
                                <input type="file" id="preludes_mp3_path" name="preludes_mp3_path" hidden accept="audio/mpeg, audio/mp3" onchange="updateFileLabel(this, 'preludes_preview')">
                            </div>
                        </div>
                        <div>
                            <label class="custom-label">Music Score (PDF)</label>
                            <div class="file-upload-card" style="display:flex; align-items:center; justify-content:center; padding: 1.5rem;" onclick="document.getElementById('music_score_path').click()">
                                <i class="fas fa-file-pdf mr-3 mb-0" style="color: #ef4444;"></i>
                                <div class="text-left font-bold small text-slate-500 uppercase">Score PDF <div id="score_preview" class="file-name-preview"></div></div>
                                <input type="file" id="music_score_path" name="music_score_path" hidden accept=".pdf" onchange="updateFileLabel(this, 'score_preview')">
                            </div>
                        </div>
                        <div style="grid-column: 1 / -1;">
                            <label class="custom-label">Lyrics (PDF)</label>
                            <div class="file-upload-card" style="display:flex; align-items:center; justify-content:center; padding: 1.5rem;" onclick="document.getElementById('lyrics_path').click()">
                                <i class="fas fa-pen-fancy mr-3 mb-0 text-blue-400"></i>
                                <div class="text-left font-bold small text-slate-500 uppercase">Lyrics PDF <div id="lyrics_preview" class="file-name-preview"></div></div>
                                <input type="file" id="lyrics_path" name="lyrics_path" hidden accept=".pdf" onchange="updateFileLabel(this, 'lyrics_preview')">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: CLASSIFICATION (RESTORED EXACT FUNCTIONALITY) -->
                    <div class="section-title">Classification & Credits</div>
                    
                    <!-- Hidden inputs -->
                    <input type="hidden" id="selected_category_ids" name="category_id[]" value="">
                    <input type="hidden" id="selected_instrumentation_ids" name="instrumentation_id[]" value="">
                    <input type="hidden" id="selected_ensemble_type_ids" name="ensembletype_id[]" value="">
                    <input type="hidden" id="selected_lyricist_ids" name="lyricist_id[]" value="">
                    <input type="hidden" id="selected_composer_ids" name="composer_id[]" value="">
                    <input type="hidden" id="selected_arranger_ids" name="arranger_id[]" value="">

                    <div class="form-grid-2">
                        <!-- Category -->
                        <div>
                            <label class="custom-label">Category</label>
                            <div class="combo-box">
                                <div class="input-container" onclick="toggleDropdown('category')">
                                    <div id="category_id_container" class="selected-items"></div>
                                    <input type="text" id="category-input" placeholder="Select categories...">
                                    <div class="dropdown-arrow"></div>
                                </div>
                                <div id="category-options-container" class="options-container">
                                    @foreach($categories as $category)
                                        <div class="option-item">
                                            <label><input type="checkbox" value="{{ $category->id }}" onclick="handleDropdownSelection(this, 'category_id_container', 'selected_category_ids')"> {{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Instrumentation -->
                        <div>
                            <label class="custom-label">Instrumentation</label>
                            <div class="combo-box">
                                <div class="input-container" onclick="toggleDropdown('instrumentation')">
                                    <div id="instrumentation_id_container" class="selected-items"></div>
                                    <input type="text" id="instrumentation-input" placeholder="Select instrumentations...">
                                    <div class="dropdown-arrow"></div>
                                </div>
                                <div id="instrumentation-options-container" class="options-container">
                                    @foreach($instrumentations as $instrumentation)
                                        <div class="option-item">
                                            <label><input type="checkbox" value="{{ $instrumentation->id }}" onclick="handleDropdownSelection(this, 'instrumentation_id_container', 'selected_instrumentation_ids')"> {{ $instrumentation->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Ensemble Type -->
                        <div>
                            <label class="custom-label">Ensemble Type</label>
                            <div class="combo-box">
                                <div class="input-container" onclick="toggleDropdown('ensemble_type')">
                                    <div id="ensemble_type_id_container" class="selected-items"></div>
                                    <input type="text" id="ensemble_type-input" placeholder="Select type...">
                                    <div class="dropdown-arrow"></div>
                                </div>
                                <div id="ensemble_type-options-container" class="options-container">
                                    @foreach($ensembleTypes as $ensembleType)
                                        <div class="option-item">
                                            <label><input type="checkbox" value="{{ $ensembleType->id }}" onclick="handleDropdownSelection(this, 'ensemble_type_id_container', 'selected_ensemble_type_ids')"> {{ $ensembleType->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Lyricist -->
                        <div>
                            <label class="custom-label">Lyricist</label>
                            <div class="combo-box">
                                <div class="input-container" onclick="toggleDropdown('lyricist')">
                                    <div id="lyricist_id_container" class="selected-items"></div>
                                    <input type="text" id="lyricist-input" placeholder="Select lyricists...">
                                    <div class="dropdown-arrow"></div>
                                </div>
                                <div id="lyricist-options-container" class="options-container">
                                    @foreach($lyricists as $creator)
                                        <div class="option-item">
                                            <label><input type="checkbox" value="{{ $creator->id }}" onclick="handleDropdownSelection(this, 'lyricist_id_container', 'selected_lyricist_ids')"> {{ $creator->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Composer -->
                        <div>
                            <label class="custom-label">Composer</label>
                            <div class="combo-box">
                                <div class="input-container" onclick="toggleDropdown('composer')">
                                    <div id="composer_id_container" class="selected-items"></div>
                                    <input type="text" id="composer-input" placeholder="Select composers...">
                                    <div class="dropdown-arrow"></div>
                                </div>
                                <div id="composer-options-container" class="options-container">
                                    @foreach($composers as $creator)
                                        <div class="option-item">
                                            <label><input type="checkbox" value="{{ $creator->id }}" onclick="handleDropdownSelection(this, 'composer_id_container', 'selected_composer_ids')"> {{ $creator->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Arranger -->
                        <div>
                            <label class="custom-label">Arranger</label>
                            <div class="combo-box">
                                <div class="input-container" onclick="toggleDropdown('arranger')">
                                    <div id="arranger_id_container" class="selected-items"></div>
                                    <input type="text" id="arranger-input" placeholder="Select arrangers...">
                                    <div class="dropdown-arrow"></div>
                                </div>
                                <div id="arranger-options-container" class="options-container">
                                    @foreach($arrangers as $creator)
                                        <div class="option-item">
                                            <label><input type="checkbox" value="{{ $creator->id }}" onclick="handleDropdownSelection(this, 'arranger_id_container', 'selected_arranger_ids')"> {{ $creator->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
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
                            <button type="button" class="btn btn-premium btn-save" id="addVerseBtn" style="height: 52px; padding: 0 1.4rem; white-space: nowrap;" onclick="addReferenceVerse('versesused')">
                                <i class="fas fa-plus-circle mr-1"></i> Add
                            </button>
                        </div>
                    </div>
                    <div id="verse_fetch_status" class="verse-fetch-status"></div>
                    <div style="margin-bottom: 2.5rem;">
                        <label class="custom-label">Added Verses <span style="color: #94a3b8; font-weight: 400;">(you may also type directly)</span></label>
                        <textarea id="versesused" name="versesused" class="modern-input" rows="4" placeholder='e.g. John 3:16 (KJV) — "For God so loved the world..."'></textarea>

                    <div class="d-flex justify-content-end gap-3 mt-10 pt-6 border-top">
                        <button type="button" class="btn btn-premium btn-cancel px-8" onclick="cancelWithWarning()">
                            <i class="fas fa-arrow-left mr-2 opacity-50"></i> Back to Library
                        </button>
                        <button type="submit" class="btn btn-premium btn-save px-10 shadow-lg">
                            <i class="fas fa-save mr-2"></i> Save Hymn
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('bible_metadata.js') }}"></script>
<script>
    // --- RESTORED ORIGINAL VANILLA JS LOGIC ---
    function toggleDropdown(dropdownId) {
        document.getElementById(`${dropdownId}-options-container`).classList.toggle("active");
    }

    function handleDropdownSelection(checkbox, selectedContainerId, hiddenInputId) {
        let selectedContainer = document.getElementById(selectedContainerId);
        let hiddenInput = document.getElementById(hiddenInputId);
        isFormDirty = true; // Mark form as dirty on multiselect change

        if (checkbox.checked) {
            appendSelectedItem(selectedContainer, checkbox);
            hiddenInput.value += checkbox.value + ',';
        } else {
            removeSelectedItem(selectedContainer, checkbox);
            let regex = new RegExp(checkbox.value + ',', 'g');
            hiddenInput.value = hiddenInput.value.replace(regex, '');
        }
    }

    function appendSelectedItem(selectedContainer, checkbox) {
        let itemName = checkbox.parentNode.textContent.trim();
        let selectedItem = document.createElement("div");
        selectedItem.className = "selected-tag";
        selectedItem.textContent = itemName;

        let removeButton = document.createElement("span");
        removeButton.textContent = "×";
        removeButton.onclick = function (e) {
            e.stopPropagation();
            checkbox.checked = false;
            selectedItem.remove();
            let hiddenInput = document.getElementById(checkbox.closest('.combo-box').previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.id);
            // Search for the right hidden input is complex in this structure, better pass it or use data-attrs
            // Simplified: re-run handleDropdownSelection(checkbox, ...)
            handleDropdownSelection(checkbox, selectedContainer.id, checkbox.closest('.row').previousElementSibling.previousElementSibling.previousElementSibling.id.replace('id_container', 'ids'));
            // Wait, I'll just use a smarter way to find hidden input via data-attributes or explicit call
        };
        // Re-implementing simplified remove inside checkbox closure
        removeButton.onclick = function(e) {
            e.stopPropagation();
            checkbox.click(); // This will trigger handleDropdownSelection and handle everything
        };

        selectedItem.appendChild(removeButton);
        selectedContainer.appendChild(selectedItem);
    }

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
            Swal.fire({ icon: 'warning', title: 'Incomplete', text: 'Please select Version, Book, Chapter, and Verse.' });
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

    function removeSelectedItem(selectedContainer, checkbox) {
        Array.from(selectedContainer.children).forEach((tag) => {
            let tagText = tag.textContent.trim().replace(/×/g, "");
            let checkboxText = checkbox.parentNode.textContent.trim();
            if (tagText === checkboxText) tag.remove();
        });
    }

    function filterDropdownOptions(inputId, optionsContainerId) {
        const input = document.getElementById(inputId).value.trim().toUpperCase();
        const optionsContainer = document.getElementById(optionsContainerId);
        const optionItems = optionsContainer.querySelectorAll(".option-item");
        optionItems.forEach((item) => {
            const text = item.textContent.trim().toUpperCase();
            item.style.display = text.includes(input) ? "" : "none";
        });
    }

    function attachFilterListeners(inputId, optionsContainerId) {
        const inputElement = document.getElementById(inputId);
        inputElement.addEventListener("input", function () {
            filterDropdownOptions(inputId, optionsContainerId);
            document.getElementById(optionsContainerId).classList.add("active");
        });
    }

    document.addEventListener("click", function (event) {
        const allComboBoxes = document.querySelectorAll(".combo-box");
        allComboBoxes.forEach((comboBox) => {
            if (!comboBox.contains(event.target)) {
                comboBox.querySelector(".options-container").classList.remove("active");
            }
        });
    });

    function updateFileLabel(input, previewId) {
        let name = input.files[0] ? input.files[0].name : '';
        document.getElementById(previewId).innerHTML = `<b>${name}</b>`;
    }

    // Initialize listeners
    ['category', 'instrumentation', 'ensemble_type', 'lyricist', 'composer', 'arranger'].forEach(id => {
        attachFilterListeners(`${id}-input`, `${id}-options-container`);
    });

    // --- DIRTY FORM TRACKING FOR UNSAVED CHANGES WARNING ---
    let isFormDirty = false;

    // Listen to standard inputs within the form
    document.getElementById('createMusicForm').addEventListener('input', function() {
        isFormDirty = true;
    });

    // Listen to file uploads specifically
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', () => isFormDirty = true);
    });

    function cancelWithWarning() {
        if (isFormDirty) {
            Swal.fire({
                title: 'Discard unsaved changes?',
                text: "You have made changes to this hymn. Are you sure you want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="fas fa-trash-alt mr-2"></i> Yes, discard changes',
                cancelButtonText: 'No, stay here',
                background: 'rgba(255, 255, 255, 0.95)',
                backdrop: `rgba(0,0,0,0.4)`,
                customClass: {
                    popup: 'rounded-2xl shadow-2xl border border-gray-200'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/musics';
                }
            });
        } else {
            window.location.href = '/musics';
        }
    }
</script>