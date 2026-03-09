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
    }

    body {
        background: var(--primary-gradient) !important;
        background-attachment: fixed !important;
        min-height: 100vh;
        font-family: 'Outfit', sans-serif;
    }

    .glass-container {
        padding: 20px 0;
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
        padding: 1.2rem;
        background: white;
        border: none;
        vertical-align: middle;
        font-size: 1rem;
        color: #1e293b;
        font-weight: 700;
    }

    .table-modern tr td:first-child { border-radius: 15px 0 0 15px; }
    .table-modern tr td:last-child { border-radius: 0 15px 15px 0; }

    .table-modern tr:hover td {
        background: #f1f7ff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    }

    .btn-create {
        background: white;
        color: var(--accent-blue);
        border-radius: 50px;
        padding: 12px 25px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .btn-create:hover {
        background: var(--accent-gold);
        color: #1e293b;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
    }

    .btn-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
        transition: all 0.2s;
        margin-left: 5px;
        cursor: pointer;
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

    /* Modal Styling */
    .modal-content {
        border-radius: 30px;
        border: none;
        box-shadow: 0 25px 50px rgba(0,0,0,0.2);
    }

    .modal-header {
        border-bottom: 1px solid #f1f5f9;
        padding: 2rem;
    }

    .modal-title {
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -0.5px;
        color: #1e293b;
    }

    .rounded-pill-custom {
        border-radius: 50px !important;
        padding: 12px 20px !important;
        border: 2px solid #e2e8f0 !important;
        font-weight: 600;
    }

    .rounded-pill-custom:focus {
        border-color: var(--accent-blue) !important;
        box-shadow: 0 0 0 4px rgba(62, 109, 156, 0.1) !important;
    }

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container" style="max-width: 1000px;">
            <div class="d-flex justify-content-between align-items-center mb-5 mt-2">
                <div>
                    <h1 class="font-black text-4xl text-white tracking-tighter mb-0 uppercase">Languages</h1>
                    <p class="text-white opacity-80 font-bold uppercase tracking-wider small mt-1">Multi-language Support</p>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('admin.settings') }}" class="btn btn-light rounded-pill px-4 font-bold shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i> Settings
                    </a>
                    <button class="btn-create" data-toggle="modal" data-target="#addLanguageModal">
                        <i class="fas fa-plus-circle"></i> New Language
                    </button>
                </div>
            </div>

            <div class="dashboard-card">
                @if(session('success'))
                    <div class="alert alert-success rounded-xl font-bold mb-4 shadow-sm border-none">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 10%;" class="text-center">#</th>
                                <th style="width: 70%;">Language Name</th>
                                <th style="width: 20%;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($languages as $language)
                                <tr>
                                    <td class="text-center font-bold text-muted" style="font-size: 0.85rem;">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="font-black text-slate-800">{{ $language->name }}</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn-icon shadow-sm" data-toggle="modal" data-target="#editLanguageModal{{ $language->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon btn-delete shadow-sm" data-toggle="modal" data-target="#deleteLanguageModal{{ $language->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Language Modal -->
                                <div class="modal fade" id="editLanguageModal{{ $language->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Language</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <form action="{{ route('languages.update', $language->id) }}" method="POST" class="p-4">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mb-4">
                                                    <label class="font-bold small uppercase text-slate-500 mb-2">Language Name</label>
                                                    <input type="text" class="form-control rounded-pill-custom" name="name" value="{{ $language->name }}" required>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary rounded-pill px-5 font-black uppercase shadow-lg">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteLanguageModal{{ $language->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="p-5 text-center">
                                                <i class="fas fa-exclamation-circle text-danger mb-4" style="font-size: 4rem;"></i>
                                                <h3 class="font-black uppercase text-slate-800">Are you sure?</h3>
                                                <p class="text-muted font-bold">You are about to delete <b>{{ $language->name }}</b>.</p>
                                                <div class="d-flex justify-content-center gap-3 mt-5">
                                                    <form action="{{ route('languages.destroy', $language->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger rounded-pill px-5 font-black uppercase shadow-lg">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-light rounded-pill px-5 font-black uppercase border" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Language Modal -->
    <div class="modal fade" id="addLanguageModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Language</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form action="{{ route('languages.store') }}" method="POST" class="p-4">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="font-bold small uppercase text-slate-500 mb-2">Language Name</label>
                        <input type="text" class="form-control rounded-pill-custom" name="name" required placeholder="e.g. English">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 font-black uppercase shadow-lg">Create Language</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
