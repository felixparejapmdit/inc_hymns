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
                        <button type="button" class="btn btn-premium btn-cancel px-5 shadow-sm" onclick="window.location.href='/musics'">
                            <i class="fas fa-times mr-2 opacity-50"></i> {{ __('Cancel') }}
                        </button>
                        <button type="button" class="btn btn-premium btn-save px-8 shadow-lg" onclick="document.forms[0].submit()">
                            <i class="fas fa-check-circle mr-2"></i> {{ __('Save Hymn') }}
                        </button>
                    </div>
                </div>

                <form method="POST" action="{{ route('musics.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- SECTION 1: BASIC INFORMATION -->
                    <div class="section-title">Core Details</div>
                    <div class="row g-4 mb-10">
                        <div class="col-md-5">
                            <label class="custom-label">Church Hymn</label>
                            <select required name="church_hymn_id" class="modern-input">
                                <option value="" disabled selected>Select Church Hymn</option>
                                @foreach($churchHymns as $churchHymn)
                                    <option value="{{ $churchHymn->id }}">{{ $churchHymn->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="custom-label">Hymn Number</label>
                            <input type="text" name="song_number" class="modern-input" maxlength="4" placeholder="001">
                        </div>
                        <div class="col-md-4">
                            <label class="custom-label">Language</label>
                            <select required name="language_id" class="modern-input">
                                <option value="" disabled selected>Select Language</option>   
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-4">
                            <label class="custom-label">Full Title</label>
                            <input required type="text" name="add_title" class="modern-input" maxlength="75" placeholder="Enter hymn title...">
                        </div>
                    </div>

                    <!-- SECTION 2: AUDIO & MEDIA -->
                    <div class="section-title">Recordings & Files</div>
                    <div class="row g-4 mb-10">
                        <div class="col-md-4">
                            <label class="custom-label">Vocals (MP3)</label>
                            <div class="file-upload-card" onclick="document.getElementById('vocals_mp3_path').click()">
                                <i class="fas fa-microphone-alt"></i>
                                <div class="font-bold small text-slate-500">UPLOAD MP3</div>
                                <div id="vocals_preview" class="file-name-preview"></div>
                                <input type="file" id="vocals_mp3_path" name="vocals_mp3_path" hidden accept="audio/mpeg, audio/mp3" onchange="updateFileLabel(this, 'vocals_preview')">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="custom-label">Organ (MP3)</label>
                            <div class="file-upload-card" onclick="document.getElementById('organ_mp3_path').click()">
                                <i class="fas fa-music"></i>
                                <div class="font-bold small text-slate-500">UPLOAD MP3</div>
                                <div id="organ_preview" class="file-name-preview"></div>
                                <input type="file" id="organ_mp3_path" name="organ_mp3_path" hidden accept="audio/mpeg, audio/mp3" onchange="updateFileLabel(this, 'organ_preview')">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="custom-label">Preludes (MP3)</label>
                            <div class="file-upload-card" onclick="document.getElementById('preludes_mp3_path').click()">
                                <i class="fas fa-headphones"></i>
                                <div class="font-bold small text-slate-500">UPLOAD MP3</div>
                                <div id="preludes_preview" class="file-name-preview"></div>
                                <input type="file" id="preludes_mp3_path" name="preludes_mp3_path" hidden accept="audio/mpeg, audio/mp3" onchange="updateFileLabel(this, 'preludes_preview')">
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="custom-label">Music Score (PDF)</label>
                            <div class="file-upload-card d-flex align-items-center justify-content-center py-4" onclick="document.getElementById('music_score_path').click()">
                                <i class="fas fa-file-pdf mr-3 mb-0" style="color: #ef4444;"></i>
                                <div class="text-left font-bold small text-slate-500 uppercase">Score PDF <div id="score_preview" class="file-name-preview"></div></div>
                                <input type="file" id="music_score_path" name="music_score_path" hidden accept=".pdf" onchange="updateFileLabel(this, 'score_preview')">
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="custom-label">Lyrics (PDF)</label>
                            <div class="file-upload-card d-flex align-items-center justify-content-center py-4" onclick="document.getElementById('lyrics_path').click()">
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

                    <div class="row g-4 mb-4">
                        <!-- Category -->
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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

                    <div class="col-12 mt-6">
                        <label class="custom-label">Reference Verses</label>
                        <textarea id="versesused" name="versesused" class="modern-input" rows="3" placeholder="Reference verses..."></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-10 pt-6 border-top">
                        <button type="button" class="btn btn-premium btn-cancel px-8" onclick="window.location.href='/musics'">
                            <i class="fas fa-arrow-left mr-2 opacity-50"></i> Back to Library
                        </button>
                        <button type="submit" class="btn btn-premium btn-save px-10 shadow-lg">
                            <i class="fas fa-save mr-2"></i> Commit Masterpiece
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // --- RESTORED ORIGINAL VANILLA JS LOGIC ---
    function toggleDropdown(dropdownId) {
        document.getElementById(`${dropdownId}-options-container`).classList.toggle("active");
    }

    function handleDropdownSelection(checkbox, selectedContainerId, hiddenInputId) {
        let selectedContainer = document.getElementById(selectedContainerId);
        let hiddenInput = document.getElementById(hiddenInputId);

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
</script>