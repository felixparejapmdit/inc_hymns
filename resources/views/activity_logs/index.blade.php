<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
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
        font-size: 0.7rem;
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
        font-size: 0.9rem;
        color: #1e293b;
        font-weight: 600;
    }

    .table-modern tr td:first-child { border-radius: 15px 0 0 15px; }
    .table-modern tr td:last-child { border-radius: 0 15px 15px 0; }

    .table-modern tr:hover td {
        background: #f1f7ff;
    }

    .action-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.65rem;
        text-transform: uppercase;
        font-weight: 950;
        letter-spacing: 0.5px;
    }

    .action-create { background: #dcfce7; color: #166534; }
    .action-update { background: #fef9c3; color: #854d0e; }
    .action-delete { background: #fee2e2; color: #991b1b; }
    .action-other { background: #f1f5f9; color: #475569; }

    .btn-view-log {
        color: var(--accent-blue);
        font-weight: 800;
        text-decoration: none !important;
        background: #eefbff;
        padding: 6px 15px;
        border-radius: 10px;
        font-size: 0.8rem;
        transition: all 0.2s;
    }

    .btn-view-log:hover {
        background: var(--accent-blue);
        color: white;
        transform: translateY(-1px);
    }

    .rounded-pill-left {
        border-top-left-radius: 50px !important;
        border-bottom-left-radius: 50px !important;
    }

    .rounded-pill-right {
        border-top-right-radius: 50px !important;
        border-bottom-right-radius: 50px !important;
    }

    .btn-white {
        background: white;
        color: #3e6d9c;
    }

    .page-header-shell {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1.5rem;
        margin: 0.5rem 0 1.5rem;
        flex-wrap: wrap;
    }

    .page-kicker {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 0.8rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.18);
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        margin-bottom: 0.9rem;
    }

    .page-title {
        font-size: clamp(2.2rem, 4vw, 3.5rem);
        line-height: 0.95;
        color: #fff;
        font-weight: 950;
        letter-spacing: -0.04em;
        margin-bottom: 0.6rem;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        margin-bottom: 0;
        max-width: 42rem;
    }

    .toolbar-stack {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .page-action-btn {
        min-height: 48px;
        min-width: 140px;
        padding: 0 1.25rem;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
        text-decoration: none !important;
    }

    .page-action-btn:hover {
        transform: translateY(-1px);
    }

    .page-action-btn-secondary {
        background: rgba(255, 255, 255, 0.16);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.28);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .page-action-btn-secondary:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.24);
    }

    .page-action-btn-primary {
        background: #fff;
        color: var(--accent-blue);
        border: 1px solid rgba(255, 255, 255, 0.7);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.1);
    }

    .page-action-btn-primary:hover {
        color: #22486c;
        background: #f8fbff;
    }

    .search-shell {
        display: flex;
        align-items: stretch;
        width: min(100%, 420px);
        min-height: 48px;
        border-radius: 18px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(62, 109, 156, 0.12);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.75);
    }

    .search-shell-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        color: #7c8aa0;
        flex: 0 0 54px;
        border-right: 1px solid rgba(148, 163, 184, 0.18);
    }

    .search-shell-input {
        flex: 1;
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
        height: 48px;
        padding: 0 1rem;
        font-weight: 700;
        color: #17324f;
    }

    .search-shell-input::placeholder {
        color: #8aa0b8;
        font-weight: 600;
    }

    .search-shell-button {
        min-width: 118px;
        padding: 0 1rem;
        border: none;
        background: var(--accent-blue);
        color: #fff;
        font-weight: 900;
        letter-spacing: 0.03em;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
        transition: background 0.2s ease, transform 0.2s ease;
        border-left: 1px solid rgba(255, 255, 255, 0.18);
    }

    .search-shell-button:hover {
        background: #2f5780;
        transform: translateY(-1px);
    }

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container-fluid px-5 px-xl-5 page-shell">
            <div class="page-header-shell">
                <div>
                    <div class="page-kicker">
                        <i class="fas fa-clipboard-list"></i>
                        Audit Trail
                    </div>
                    <h1 class="page-title">Activity Logs</h1>
                    <p class="page-subtitle">Audit trail and system events captured across the platform.</p>
                </div>
                <div class="toolbar-stack">
                    <form action="{{ route('activity_logs.index') }}" method="GET" class="m-0">
                        <div class="search-shell">
                            <span class="search-shell-icon">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control search-shell-input" placeholder="Search logs..." value="{{ request('search') }}">
                            <button class="search-shell-button" type="submit">
                                <i class="fas fa-search"></i>
                                <span>Search</span>
                            </button>
                        </div>
                    </form>
                    <a href="{{ route('admin.settings') }}" class="page-action-btn page-action-btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        <span>Settings</span>
                    </a>
                </div>
            </div>

            <div class="dashboard-card shadow-lg">
                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>User</th>
                                <th class="text-center">Action</th>
                                <th>Resource / Model</th>
                                <th>IP Address</th>
                                <th>Date & Time</th>
                                <th class="text-center">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td class="text-center text-muted font-bold" style="font-size: 0.75rem;">
                                        {{ ($logs->currentPage() - 1) * $logs->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="font-black text-slate-800">{{ optional($log->user)->name ?? 'System' }}</div>
                                        <div class="text-slate-400 smaller">ID: {{ $log->user_id ?? 'N/A' }}</div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $actionClass = 'action-other';
                                            $action = strtolower($log->action);
                                            if(str_contains($action, 'create') || str_contains($action, 'add')) $actionClass = 'action-create';
                                            elseif(str_contains($action, 'update') || str_contains($action, 'edit')) $actionClass = 'action-update';
                                            elseif(str_contains($action, 'delete') || str_contains($action, 'destroy')) $actionClass = 'action-delete';
                                        @endphp
                                        <span class="action-badge {{ $actionClass }}">{{ $log->action }}</span>
                                    </td>
                                    <td>
                                        <div class="text-slate-700 font-bold" style="font-size: 0.85rem;">{{ class_basename($log->model) }}</div>
                                        <div class="text-slate-400 smaller text-truncate" style="max-width: 200px;">{{ $log->model }}</div>
                                    </td>
                                    <td>
                                        <code class="bg-slate-100 px-2 py-1 rounded text-slate-600 font-bold" style="font-size: 0.75rem;">{{ $log->ip_address }}</code>
                                    </td>
                                    <td>
                                        <div class="text-slate-700 font-bold">{{ $log->created_at->format('M d, Y') }}</div>
                                        <div class="text-slate-400 smaller uppercase">{{ $log->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('activity_logs.show', $log->id) }}" class="btn-view-log shadow-sm">
                                            <i class="fas fa-eye mr-1"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-5 d-flex justify-content-center pagination-centered">
                    {{ $logs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
