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

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container-fluid" style="padding: 0 40px; max-width: 1600px;">
            <div class="d-flex justify-content-between align-items-center mb-5 mt-2">
                <div>
                    <h1 class="font-black text-4xl text-white tracking-tighter mb-0 uppercase">Activity Logs</h1>
                    <p class="text-white opacity-80 font-bold uppercase tracking-wider small mt-1">Audit Trail & System Events</p>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <form action="{{ route('activity_logs.index') }}" method="GET" class="mr-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control rounded-pill-left border-0 px-4 font-bold shadow-sm" style="width: 300px; height: 45px;" placeholder="Search logs..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-white rounded-pill-right border-0 px-3 shadow-sm" type="submit">
                                    <i class="fas fa-search text-primary"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="{{ route('admin.settings') }}" class="btn btn-light rounded-pill px-4 font-bold shadow-sm d-flex align-items-center" style="height: 45px;">
                        <i class="fas fa-arrow-left mr-2"></i> Settings
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

                <div class="mt-5 d-flex justify-content-center">
                    {{ $logs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
