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

    .users-page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1.5rem;
        margin-bottom: 2rem;
        margin-top: 0.5rem;
        flex-wrap: wrap;
    }

    .users-page-kicker {
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

    .users-page-title {
        font-size: clamp(2.2rem, 4vw, 3.5rem);
        line-height: 0.95;
        color: #fff;
        font-weight: 950;
        letter-spacing: -0.04em;
        margin-bottom: 0.6rem;
    }

    .users-page-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        margin-bottom: 0;
        max-width: 42rem;
    }

    .action-toolbar {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        flex-wrap: wrap;
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

    .search-panel {
        padding: 1.2rem 1.35rem !important;
        margin-bottom: 1.35rem;
    }

    .search-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .search-panel-title {
        margin: 0;
        font-size: 0.86rem;
        font-weight: 900;
        color: #3e4b61;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .search-panel-hint {
        margin: 0;
        color: #6b7a90;
        font-size: 0.88rem;
        font-weight: 600;
    }

    .search-shell {
        display: flex;
        align-items: stretch;
        width: 100%;
        min-height: 52px;
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
        height: 52px;
        padding: 0 1rem;
        font-weight: 700;
        color: #17324f;
    }

    .search-shell-input::placeholder {
        color: #8aa0b8;
        font-weight: 600;
    }

    .search-shell-button {
        min-width: 132px;
        padding: 0 1.1rem;
        border: none;
        background: var(--accent-blue);
        color: #fff;
        font-weight: 900;
        letter-spacing: 0.03em;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: background 0.2s ease, transform 0.2s ease;
        border-left: 1px solid rgba(255, 255, 255, 0.18);
    }

    .search-shell-button:hover {
        background: #2f5780;
        transform: translateY(-1px);
    }

    .search-shell.is-loading {
        opacity: 0.72;
        pointer-events: none;
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
        <div class="container-fluid px-5 px-xl-5 page-shell">
            @php
                $isGroupView = isset($group);
                $headerTitle = $isGroupView ? "{$group->name} Members" : 'User Directory';
                $headerSubtitle = $isGroupView
                    ? 'Manage the users assigned to this group.'
                    : 'Manage platform membership and account access.';
                $backRoute = $isGroupView ? route('groups.index') : route('admin.settings');
                $addRoute = $isGroupView ? route('groups.create') : route('users.create');
                $addLabel = $isGroupView ? 'Edit Group' : 'New User';
                $addIcon = $isGroupView ? 'fas fa-edit' : 'fas fa-user-plus';
            @endphp

            <div class="users-page-header">
                <div>
                    <div class="users-page-kicker">
                        <i class="fas fa-users"></i>
                        {{ $isGroupView ? 'Group Users' : 'User Management' }}
                    </div>
                    <h1 class="users-page-title">
                        {{ $headerTitle }}
                    </h1>
                    <p class="users-page-subtitle">{{ $headerSubtitle }}</p>
                </div>
                <div class="action-toolbar">
              
                    <a href="{{ $addRoute }}" class="page-action-btn page-action-btn-primary">
                        <i class="{{ $addIcon }}"></i>
                        <span>{{ $addLabel }}</span>
                    </a>
                </div>
            </div>

            <div class="dashboard-card search-panel">
                <div class="search-panel-header">
                    <div>
                        <p class="search-panel-title">Search Users</p>
                        <p class="search-panel-hint">Type a full name or username and the list updates automatically.</p>
                    </div>
                    <span class="group-pill">Live results</span>
                </div>

                <form id="users-search-form" method="GET" action="{{ url()->current() }}">
                    <div class="search-shell" id="users-search-shell">
                        <span class="search-shell-icon">
                            <i class="fas fa-search"></i>
                        </span>
                        <input
                            type="text"
                            id="user-search"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control search-shell-input"
                            placeholder="Search full name or username"
                            autocomplete="off"
                        >
                        <button type="submit" class="search-shell-button">
                            <i class="fas fa-search"></i>
                            <span>Search</span>
                        </button>
                    </div>
                </form>
            </div>

            <div id="users-results" class="dashboard-card shadow-lg">
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

                <div class="mt-5 d-flex justify-content-center pagination-centered">
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const form = document.getElementById('users-search-form');
            const input = document.getElementById('user-search');
            const results = document.getElementById('users-results');
            const shell = document.getElementById('users-search-shell');

            if (!form || !input || !results) {
                return;
            }

            let debounceTimer = null;
            let activeController = null;
            let requestSerial = 0;

            function setLoading(isLoading) {
                if (shell) {
                    shell.classList.toggle('is-loading', isLoading);
                }
            }

            function replaceResultsFromHtml(html) {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const nextResults = doc.getElementById('users-results');

                if (!nextResults) {
                    return false;
                }

                results.innerHTML = nextResults.innerHTML;
                return true;
            }

            async function fetchResults(url, historyMode = 'replace') {
                const currentRequestId = ++requestSerial;

                if (activeController) {
                    activeController.abort();
                }

                activeController = new AbortController();
                setLoading(true);

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html,application/xhtml+xml'
                        },
                        signal: activeController.signal
                    });

                    if (!response.ok) {
                        throw new Error('Search request failed');
                    }

                    const html = await response.text();
                    const didReplace = replaceResultsFromHtml(html);

                    if (!didReplace) {
                        window.location.href = url;
                        return;
                    }

                    if (historyMode === 'push') {
                        window.history.pushState({}, '', url);
                    } else {
                        window.history.replaceState({}, '', url);
                    }
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        form.submit();
                    }
                } finally {
                    if (currentRequestId === requestSerial) {
                        setLoading(false);
                    }
                }
            }

            input.addEventListener('input', function () {
                clearTimeout(debounceTimer);

                const url = new URL(form.action, window.location.origin);
                const query = this.value.trim();

                if (query !== '') {
                    url.searchParams.set('search', query);
                }

                url.searchParams.delete('page');

                debounceTimer = window.setTimeout(function () {
                    fetchResults(url.toString(), 'replace');
                }, 300);
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                const url = new URL(form.action, window.location.origin);
                const query = input.value.trim();

                if (query !== '') {
                    url.searchParams.set('search', query);
                }

                url.searchParams.delete('page');
                fetchResults(url.toString(), 'replace');
            });

            document.addEventListener('click', function (event) {
                const link = event.target.closest('#users-results a[href*="page="]');
                if (!link) {
                    return;
                }

                const pageUrl = new URL(link.href, window.location.origin);
                event.preventDefault();
                fetchResults(pageUrl.toString(), 'push');
            });
        })();
    </script>
</x-app-layout>
