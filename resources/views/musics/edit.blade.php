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
                    <div class="row g-4 mb-10">
                        <div class="col-md-5">
                            <label class="custom-label">Church Hymn</label>
                            <select required name="edit_church_hymn_id" class="modern-input">
                                @foreach($churchHymns as $churchHymn)
                                    <option value="{{ $churchHymn->id }}" {{ $churchHymn->id == $musics->church_hymn_id ? 'selected' : '' }}>{{ $churchHymn->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="custom-label">Hymn Number</label>
                            <input type="text" name="edit_song_number" value="{{ $musics->song_number }}" class="modern-input" maxlength="4">
                        </div>
                        <div class="col-md-4">
                            <label class="custom-label">Language</label>
                            <select required name="edit_language_id" class="modern-input">
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}" {{ $language->id == $musics->language_id ? 'selected' : '' }}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-4">
                            <label class="custom-label">Full Title</label>
                            <input required type="text" name="edit_title" value="{{ $musics->title }}" class="modern-input" maxlength="75">
                        </div>
                    </div>

                    <!-- SECTION 2: AUDIO & MEDIA -->
                    <div class="section-title">Media Files</div>
                    <div class="row g-4 mb-10">
                        @php
                            $files = [
                                'vocals' => ['label' => 'Vocals', 'icon' => 'microphone-alt', 'path' => $musics->vocals_mp3_path],
                                'organ' => ['label' => 'Organ', 'icon' => 'music', 'path' => $musics->organ_mp3_path],
                                'preludes' => ['label' => 'Preludes', 'icon' => 'headphones', 'path' => $musics->preludes_mp3_path],
                            ];
                        @endphp
                        @foreach($files as $key => $file)
                            <div class="col-md-4">
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

                        <div class="col-md-6 mt-4">
                            <label class="custom-label">Music Score (PDF)</label>
                            <div class="file-upload-card d-flex align-items-center justify-content-center py-4" onclick="document.getElementById('edit_music_score_path').click()">
                                <i class="fas fa-file-pdf mr-3 mb-0" style="color: #ef4444;"></i>
                                <div class="text-left font-bold small text-slate-500 uppercase">Score PDF <div id="score_preview" class="file-name-preview text-xs opacity-60">{{ str_replace('music_files/', '', $musics->music_score_path) ?: 'No file' }}</div></div>
                                <input type="file" id="edit_music_score_path" name="edit_music_score_path" hidden accept=".pdf" onchange="updateFileLabel(this, 'score_preview')">
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="custom-label">Lyrics (PDF)</label>
                            <div class="file-upload-card d-flex align-items-center justify-content-center py-4" onclick="document.getElementById('edit_lyrics_path').click()">
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

                    <div class="row g-4 mb-4">
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
                            <div class="col-md-6">
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

                    <div class="col-12 mt-6">
                        <label class="custom-label">Reference Verses</label>
                        <textarea name="edit_versesused" class="modern-input" rows="3">{{ $musics->verses_used }}</textarea>
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

<script>
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
