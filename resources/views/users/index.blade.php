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
        font-size: 0.75rem;
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
        font-size: 0.95rem;
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

    .status-pill {
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 900;
        letter-spacing: 0.5px;
    }

    .status-active { background: #dcfce7; color: #166534; }
    .status-inactive { background: #fee2e2; color: #991b1b; }

    .group-pill {
        background: #f1f5f9;
        color: #475569;
        padding: 2px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-right: 4px;
        border: 1px solid #e2e8f0;
    }

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container" style="max-width: 1200px;">
            <div class="d-flex justify-content-between align-items-center mb-5 mt-2">
                <div>
                    <h1 class="font-black text-4xl text-white tracking-tighter mb-0 uppercase">
                        {{ isset($group) ? $group->name : 'System' }} Users
                    </h1>
                    <p class="text-white opacity-80 font-bold uppercase tracking-wider small mt-1">Platform Membership & Accounts</p>
                </div>
                <div class="d-flex gap-3">
                    @php
                        $currentUrl = url()->current();
                        $isGroupView = str_contains($currentUrl, 'groups');
                        $backRoute = $isGroupView ? route('groups.index') : route('admin.settings');
                        $addRoute = $isGroupView ? route('groups.create') : route('users.create');
                        $addLabel = $isGroupView ? 'Edit Group' : 'New User';
                        $addIcon = $isGroupView ? 'fas fa-edit' : 'fas fa-user-plus';
                    @endphp
                    <a href="{{ $backRoute }}" class="btn btn-light rounded-pill px-4 font-bold shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                    <a href="{{ $addRoute }}" class="btn-create">
                        <i class="{{ $addIcon }}"></i> {{ $addLabel }}
                    </a>
                </div>
            </div>

            <div class="dashboard-card shadow-lg">
                @if(session('success'))
                    <div class="alert alert-success rounded-xl font-bold mb-4 shadow-sm border-none">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">#</th>
                                <th style="width: 20%;">Full Name</th>
                                <th style="width: 25%;">Email / Username</th>
                                <th class="text-center" style="width: 10%;">Status</th>
                                <th style="width: 25%;">Groups</th>
                                <th class="text-center" style="width: 15%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center text-muted font-bold" style="font-size: 0.8rem;">
                                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="font-black text-slate-800">{{ $user->name }}</div>
                                    </td>
                                    <td>
                                        <div class="text-slate-700 font-bold" style="font-size: 0.9rem;">{{ $user->email }}</div>
                                        <div class="text-slate-400 smaller">@ {{ $user->username }}</div>
                                    </td>
                                    <td class="text-center">
                                        <span class="status-pill {{ $user->activated ? 'status-active' : 'status-inactive' }}">
                                            {{ $user->activated ? 'Active' : 'Locked' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->groups->isEmpty())
                                            <span class="text-slate-400 italic small">Individual</span>
                                        @else
                                            @foreach($user->groups as $group)
                                                <span class="group-pill">{{ $group->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            @php
                                                $url = url()->current();
                                                $group_id = null;
                                                if (Str::contains($url, 'groups') && Str::contains($url, 'users')) {
                                                    $segments = explode('/', $url);
                                                    $group_index = array_search('groups', $segments);
                                                    $user_index = array_search('users', $segments);
                                                    if ($group_index !== false && $user_index !== false && $group_index < $user_index) {
                                                        $group_id = $segments[$group_index + 1];
                                                    }
                                                }
                                            @endphp
                                            <a href="{{ isset($group_id) ? route('users.edit', ['user' => $user->id, 'group' => $group_id]) : route('users.edit', ['user' => $user->id]) }}" class="btn-icon shadow-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon btn-delete shadow-sm">
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

                <div class="mt-5 d-flex justify-content-center">
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>