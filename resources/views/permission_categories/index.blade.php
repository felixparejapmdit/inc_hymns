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
        background: #ef4444 !important;
        border-color: #ef4444 !important;
        color: white !important;
    }

    .desc-text {
        color: #64748b;
        font-weight: 500;
        font-size: 0.9rem;
    }

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container" style="max-width: 1000px;">
            <div class="d-flex justify-content-between align-items-center mb-5 mt-2">
                <div>
                    <h1 class="font-black text-4xl text-white tracking-tighter mb-0 uppercase">Permission Groups</h1>
                    <p class="text-white opacity-80 font-bold uppercase tracking-wider small mt-1">Categorization of system access</p>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('admin.settings') }}" class="btn btn-light rounded-pill px-4 font-bold shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i> Settings
                    </a>
                    <a href="{{ route('permission_categories.create') }}" class="btn-create">
                        <i class="fas fa-plus-circle"></i> New Group
                    </a>
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
                                <th style="width: 30%;">Group Name</th>
                                <th style="width: 40%;">Description</th>
                                <th style="width: 20%;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="text-center font-bold text-muted" style="font-size: 0.85rem;">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="font-black text-slate-800">{{ $category->name }}</div>
                                    </td>
                                    <td>
                                        <div class="desc-text text-truncate" style="max-width: 300px;">{{ $category->description ?? 'No description provided' }}</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('permission_categories.edit', $category->id) }}" class="btn-icon shadow-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('permission_categories.destroy', $category->id) }}" method="POST" id="delete-form-{{ $category->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-icon btn-delete shadow-sm" onclick="confirmDelete('{{ $category->name }}', {{ $category->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete(name, id) {
        if (confirm("Are you sure you want to delete the permission group '" + name + "'?")) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
