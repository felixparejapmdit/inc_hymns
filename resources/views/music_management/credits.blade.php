<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    :root {
        --primary-gradient: linear-gradient(to bottom, #64B5D6 0%, #3E6D9C 100%);
        --card-bg: rgba(255, 255, 255, 0.95);
        --accent-blue: #3E6D9C;
        --accent-gold: #FFD700;
        --row-even: #f8fafc;
        --row-hover: #e2e8f0;
    }

    body {
        background: var(--primary-gradient) !important;
        background-attachment: fixed !important;
        min-height: 100vh;
        font-family: 'Outfit', sans-serif;
    }

    .glass-container {
        padding: 10px 0;
    }

    .dashboard-card {
        background: var(--card-bg);
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
        padding: 2.5rem;
        position: relative;
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table-modern th {
        padding: 1.2rem;
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #64748b;
        font-weight: 800;
        letter-spacing: 1px;
        border: none;
    }

    .table-modern td {
        padding: 1rem;
        background: white;
        border: none;
        vertical-align: middle;
        font-size: 0.95rem;
        color: #334155;
        font-weight: 600;
    }

    .table-modern tr td:first-child { border-radius: 15px 0 0 15px; }
    .table-modern tr td:last-child { border-radius: 0 15px 15px 0; }

    .table-modern tr:hover td {
        background: #f1f7ff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    }

    .creator-image {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border: 2px solid white;
    }

    .creator-name {
        font-weight: 800;
        color: #1e293b;
        text-decoration: none !important;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .creator-name:hover {
        color: var(--accent-blue);
    }

    .designation-pill {
        display: inline-block;
        padding: 4px 10px;
        background: #e0f2fe;
        color: #0369a1;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        margin-right: 4px;
        margin-bottom: 4px;
        border: 1px solid #bae6fd;
    }

    /* Music Background Box */
    .background-box-styled {
        background: #f8fafc;
        padding: 1.5rem;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        border-left: 6px solid var(--accent-blue);
        position: relative;
        transition: all 0.3s ease;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
    }

    .background-box-styled:focus-within {
        background: white;
        border-color: var(--accent-blue);
        box-shadow: 0 10px 25px rgba(62, 109, 156, 0.1);
        transform: translateY(-2px);
    }

    .background-box-styled textarea {
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        font-style: italic;
        line-height: 1.8;
        color: #334155;
        font-weight: 500;
        resize: none;
        font-size: 0.95rem;
        width: 100%;
        min-height: 100px;
    }

    .background-box-styled textarea:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    .background-icon {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-size: 2rem;
        color: var(--accent-blue);
        opacity: 0.05;
        pointer-events: none;
    }

    .search-bar {
        background: white;
        border-radius: 50px;
        padding: 5px 15px 5px 25px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    .search-bar input {
        border: none !important;
        box-shadow: none !important;
        font-weight: 700;
        color: #1e293b;
        flex-grow: 1;
    }

    .btn-create {
        background: var(--accent-blue);
        color: white;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: all 0.3s;
    }

    .btn-create:hover {
        background: #2a5298;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        color: white;
    }

    .btn-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
        transition: all 0.2s;
        margin-left: 5px;
    }

    .btn-icon:hover {
        background: var(--accent-blue);
        color: white;
        border-color: var(--accent-blue);
        transform: scale(1.1);
    }

    .btn-delete:hover {
        background: #ef4444;
        border-color: #ef4444;
    }

    /* Modals customization */
    .modal-content {
        border-radius: 25px;
        border: none;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }

    .modal-header {
        border-bottom: 1px solid #f1f5f9;
        padding: 1.5rem 2rem;
    }

    .modal-title {
        font-weight: 900;
        color: #1e293b;
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    /* Custom Pagination */
    .pagination nav div:last-child {
        display: flex;
        justify-content: center;
        gap: 6px;
    }
    
    .pagination .page-link {
        border-radius: 10px !important;
        margin: 0 2px;
        font-weight: 700;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .pagination .page-item.active .page-link {
        background: var(--accent-blue);
        border-color: var(--accent-blue);
    }

    /* Drag and Drop Zone */
    .image-drop-zone {
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s;
        cursor: pointer;
        background: #f8fafc;
        position: relative;
        overflow: hidden;
    }

    .image-drop-zone.dragover {
        border-color: var(--accent-blue);
        background: #eff6ff;
    }

    .image-drop-zone i {
        font-size: 2.5rem;
        color: #94a3b8;
        margin-bottom: 1rem;
    }

    .preview-container {
        width: 120px;
        height: 120px;
        margin: 0 auto 1rem;
        border-radius: 15px;
        overflow: hidden;
        display: none;
        border: 3px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Checkbox Group Styling */
    .designation-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 10px;
        background: #f8fafc;
        padding: 15px;
        border-radius: 15px;
        border: 1px solid #e2e8f0;
    }

    .designation-check-item {
        position: relative;
        cursor: pointer;
        display: block;
    }

    .designation-check-item input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .check-label {
        display: block;
        padding: 8px 12px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 700;
        color: #64748b;
        text-align: center;
        transition: all 0.2s;
        height: 100%;
    }

    .designation-check-item input:checked + .check-label {
        background: var(--accent-blue);
        color: white;
        border-color: var(--accent-blue);
        box-shadow: 0 4px 10px rgba(62, 109, 156, 0.2);
    }

    .designation-check-item:hover .check-label {
        border-color: var(--accent-blue);
        background: #f1f7ff;
    }

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container" style="max-width: 1200px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="font-black text-4xl text-white tracking-tighter mb-0 uppercase">Music Creators</h1>
                    <p class="text-white opacity-80 font-bold uppercase tracking-wider small mt-1">Management & Credits List</p>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('admin.settings') }}" class="btn btn-light rounded-pill px-4 font-bold shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i> Settings
                    </a>
                    @if (\App\Helpers\AccessRightsHelper::checkPermission('credits.create') == 'inline')
                        <button data-toggle="modal" data-target="#addCreditModal" class="btn-create shadow-lg">
                            <i class="fas fa-plus-circle mr-2"></i> New Credit
                        </button>
                    @endif
                </div>
            </div>

            <div class="dashboard-card pt-4">
                <div class="search-bar mb-4">
                    <i class="fas fa-search text-muted mr-3"></i>
                    <input type="text" id="liveSearch" placeholder="Search creators by name, location, or background..." class="form-control">
                </div>

                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 35%;">Creator</th>
                                <th style="width: 15%;">Location</th>
                                <th style="width: 15%;">Duty</th>
                                <th style="width: 15%;">Designations</th>
                                <th style="width: 15%;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($credits as $index => $credit)
                                <tr>
                                    <td class="text-center font-bold text-muted" style="font-size: 0.8rem;">
                                        {{ ($credits->currentPage() - 1) * $credits->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <a href="{{ route('music_creators.profile', $credit->id) }}" class="creator-name">
                                            <img src="{{ $credit->image ? asset('storage/' . $credit->image) : asset('images/blank_image.png') }}" class="creator-image">
                                            <div>
                                                <div class="mb-0">{{ $credit->name }}</div>
                                                <div class="small text-muted opacity-60 font-bold">{{ $credit->birthday && $credit->birthday !== '0000-00-00 00:00:00' ? \Carbon\Carbon::parse($credit->birthday)->format('M d, Y') : 'N/A' }}</div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="small font-bold text-slate-600">{{ $credit->local ?: '---' }}</div>
                                        <div class="small text-muted opacity-60">{{ $credit->district ?: '---' }}</div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light px-3 py-2 border rounded-pill" style="font-size: 0.75rem;">{{ $credit->duty ?: 'Contributor' }}</span>
                                    </td>
                                    <td>
                                        <div class="flex flex-wrap">
                                            @foreach($credit->designations as $designation)
                                                <span class="designation-pill">{{ $designation->name }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            @if (\App\Helpers\AccessRightsHelper::checkPermission('credits.edit') == 'inline')
                                                <button class="btn-icon edit-Credit" 
                                                    data-toggle="modal" 
                                                    data-target="#editCreditModal" 
                                                    data-id="{{ $credit->id }}"
                                                    data-name="{{ $credit->name }}"
                                                    data-birthday="{{ $credit->birthday }}"
                                                    data-district="{{ $credit->district }}"
                                                    data-local="{{ $credit->local }}"
                                                    data-music_background="{{ $credit->music_background }}"
                                                    data-designation="{{ $credit->designations->pluck('id')->implode(',') }}"
                                                    data-duty="{{ $credit->duty }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            @endif

                                            @if (\App\Helpers\AccessRightsHelper::checkPermission('credits.delete') == 'inline')
                                                <button class="btn-icon btn-delete delete-Credit" 
                                                    data-credit-id="{{ $credit->id }}"
                                                    data-credit-name="{{ $credit->name }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-5 d-flex justify-content-center pagination">
                    {{ $credits->appends(['query' => request()->query('query')])->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modals (Add, Edit, Delete) - Keeping Existing Functionality but Cleaned UI -->
    
    <!-- Add Credit Modal -->
    <div class="modal fade" id="addCreditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Music Creator</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form action="{{ route('credits.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
                    @csrf
                    <!-- Basic Profile Header -->
                    <div class="row align-items-center mb-5">
                        <div class="col-md-4">
                            <label class="font-bold small uppercase text-slate-500 mb-2">Profile Image</label>
                            <div class="image-drop-zone" id="add-drop-zone">
                                <div class="preview-container" id="add-preview-box">
                                    <img id="add-preview-img" src="">
                                </div>
                                <div class="drop-zone-prompt">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="mb-0 font-bold small text-muted">UPLOAD PHOTO</p>
                                </div>
                                <input type="file" name="image" id="add-image-input" class="d-none" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group mb-4">
                                <label class="font-bold small uppercase text-slate-500 mb-2">Full Name</label>
                                <input type="text" name="name" class="form-control rounded-pill custom-input" required placeholder="Enter complete name">
                            </div>
                            <div class="form-group mb-0">
                                <label class="font-bold small uppercase text-slate-500 mb-2">Designations</label>
                                <div class="designation-grid">
                                    @foreach($designations as $designation)
                                        <label class="designation-check-item">
                                            <input type="checkbox" name="add_designation[]" value="{{ $designation->id }}">
                                            <span class="check-label">{{ $designation->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location & Duty Section -->
                    <div class="row bg-slate-50 rounded-3xl p-4 mb-4" style="border: 1px dashed #e2e8f0;">
                        <div class="col-md-6 form-group">
                            <label class="font-bold small uppercase text-slate-500">Ecclesiastical District</label>
                            <input type="text" name="district" class="form-control rounded-pill custom-input shadow-none">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-bold small uppercase text-slate-500">Local Congregation</label>
                            <input type="text" name="local" class="form-control rounded-pill custom-input shadow-none">
                        </div>
                        <div class="col-md-6 form-group mb-0">
                            <label class="font-bold small uppercase text-slate-500">Current Duty</label>
                            <input type="text" name="duty" class="form-control rounded-pill custom-input shadow-none">
                        </div>
                        <div class="col-md-6 form-group mb-0">
                            <label class="font-bold small uppercase text-slate-500">Birth Month/Year</label>
                            <input type="date" name="birthday" class="form-control rounded-pill custom-input shadow-none">
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label class="font-bold small uppercase text-slate-500 mb-2">Music Background</label>
                        <div class="background-box-styled">
                            <i class="fas fa-quote-right background-icon"></i>
                            <textarea name="music_background" class="form-control" rows="4" placeholder="Share creator's artistic journey..."></textarea>
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 font-black uppercase shadow-lg">Create Creator</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Credit Modal -->
    <div class="modal fade" id="editCreditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Music Creator</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data" class="p-4">
                    @csrf
                    @method('PUT')
                    <!-- Basic Profile Header -->
                    <div class="row align-items-center mb-5">
                        <div class="col-md-4">
                            <label class="font-bold small uppercase text-slate-500 mb-2">Profile Image</label>
                            <div class="image-drop-zone" id="edit-drop-zone">
                                <div class="preview-container" id="edit-preview-box">
                                    <img id="edit-preview-img" src="">
                                </div>
                                <div class="drop-zone-prompt">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="mb-0 font-bold small text-muted">UPDATE PHOTO</p>
                                </div>
                                <input type="file" name="edit_image" id="edit-image-input" class="d-none" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group mb-4">
                                <label class="font-bold small uppercase text-slate-500 mb-2">Full Name</label>
                                <input type="text" id="edit_name" name="edit_name" class="form-control rounded-pill custom-input shadow-none" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="font-bold small uppercase text-slate-500 mb-2">Designations</label>
                                <div class="designation-grid">
                                    @foreach($designations as $designation)
                                        <label class="designation-check-item">
                                            <input type="checkbox" name="edit_designation[]" class="edit_designation_check" value="{{ $designation->id }}">
                                            <span class="check-label">{{ $designation->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location & Duty Section -->
                    <div class="row bg-slate-50 rounded-3xl p-4 mb-4" style="border: 1px dashed #e2e8f0;">
                        <div class="col-md-6 form-group">
                            <label class="font-bold small uppercase text-slate-500">Ecclesiastical District</label>
                            <input type="text" id="edit_district" name="edit_district" class="form-control rounded-pill custom-input shadow-none">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-bold small uppercase text-slate-500">Local Congregation</label>
                            <input type="text" id="edit_local" name="edit_local" class="form-control rounded-pill custom-input shadow-none">
                        </div>
                        <div class="col-md-6 form-group mb-0">
                            <label class="font-bold small uppercase text-slate-500">Current Duty</label>
                            <input type="text" id="edit_duty" name="edit_duty" class="form-control rounded-pill custom-input shadow-none">
                        </div>
                        <div class="col-md-6 form-group mb-0">
                            <label class="font-bold small uppercase text-slate-500">Birth Month/Year</label>
                            <input type="date" id="edit_birthday" name="edit_birthday" class="form-control rounded-pill custom-input shadow-none">
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label class="font-bold small uppercase text-slate-500 mb-2">Music Background</label>
                        <div class="background-box-styled">
                            <i class="fas fa-quote-right background-icon"></i>
                            <textarea id="edit_music_background" name="edit_music_background" class="form-control" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 font-black uppercase shadow-lg">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteCreditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="p-5 text-center">
                    <i class="fas fa-exclamation-circle text-danger mb-4" style="font-size: 4rem;"></i>
                    <h3 class="font-black uppercase text-slate-800">Are you sure?</h3>
                    <p class="text-muted font-bold">You are about to delete <span id="del_name" class="text-danger"></span>. This action cannot be undone.</p>
                    <div class="d-flex justify-content-center gap-3 mt-5">
                        <button type="button" class="btn btn-light rounded-pill px-4 font-bold" data-dismiss="modal">Cancel</button>
                        <form id="deleteCreditForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-pill px-4 font-bold">Yes, Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Live Search
            $('#liveSearch').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $(".table-modern tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // Image Upload Enhancement (Add Modal)
            const setupImageUpload = (dropZoneId, inputId, previewBoxId, previewImgId) => {
                const dropZone = document.getElementById(dropZoneId);
                const input = document.getElementById(inputId);
                const previewBox = document.getElementById(previewBoxId);
                const previewImg = document.getElementById(previewImgId);

                if (!dropZone) return;

                dropZone.addEventListener('click', () => input.click());

                dropZone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    dropZone.classList.add('dragover');
                });

                ['dragleave', 'dragend'].forEach(type => {
                    dropZone.addEventListener(type, () => dropZone.classList.remove('dragover'));
                });

                dropZone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    dropZone.classList.remove('dragover');
                    const files = e.dataTransfer.files;
                    if (files.length) {
                        input.files = files;
                        handlePreview(files[0]);
                    }
                });

                window.addEventListener('paste', (e) => {
                    if (document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'TEXTAREA') return;
                    
                    const items = (e.clipboardData || e.originalEvent.clipboardData).items;
                    for (let item of items) {
                        if (item.kind === 'file') {
                            const blob = item.getAsFile();
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(blob);
                            input.files = dataTransfer.files;
                            handlePreview(blob);
                        }
                    }
                });

                input.addEventListener('change', () => {
                    if (input.files.length) handlePreview(input.files[0]);
                });

                const handlePreview = (file) => {
                    if (!file.type.startsWith('image/')) return;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        previewImg.src = e.target.result;
                        previewBox.style.display = 'block';
                        dropZone.querySelector('.drop-zone-prompt').style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                };
            };

            setupImageUpload('add-drop-zone', 'add-image-input', 'add-preview-box', 'add-preview-img');
            setupImageUpload('edit-drop-zone', 'edit-image-input', 'edit-preview-box', 'edit-preview-img');

            // Edit Modal Handler
            $('.edit-Credit').click(function() {
                const id = $(this).data('id');
                const birthday = $(this).data('birthday');
                
                $('#edit_name').val($(this).data('name'));
                $('#edit_local').val($(this).data('local'));
                $('#edit_district').val($(this).data('district'));
                $('#edit_duty').val($(this).data('duty'));
                $('#edit_music_background').val($(this).data('music_background'));
                
                if (birthday && birthday !== '0000-00-00 00:00:00') {
                    $('#edit_birthday').val(new Date(birthday).toISOString().split('T')[0]);
                } else {
                    $('#edit_birthday').val('');
                }

                // Reset Checkboxes
                $('.edit_designation_check').prop('checked', false);
                const designations = String($(this).data('designation')).split(',');
                designations.forEach(id => {
                    $(`.edit_designation_check[value="${id}"]`).prop('checked', true);
                });

                // Update Edit Preview Image
                const currentImg = $(this).closest('tr').find('.creator-image').attr('src');
                $('#edit-preview-img').attr('src', currentImg);
                $('#edit-preview-box').show();
                $('#edit-drop-zone .drop-zone-prompt').hide();

                $('#editForm').attr('action', "{{ route('credits.update', ':id') }}".replace(':id', id));
            });

            // Delete Modal Handler
            $('.delete-Credit').click(function() {
                const id = $(this).data('credit-id');
                const name = $(this).data('credit-name');
                $('#del_name').text(name);
                $('#deleteCreditForm').attr('action', "{{ url('music_management/credits') }}/" + id);
                $('#deleteCreditModal').modal('show');
            });
        });
    </script>
</x-app-layout>
