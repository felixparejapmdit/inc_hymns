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
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        color: #64748b;
        border: none;
        transition: all 0.2s;
        cursor: pointer;
    }

    .btn-icon:hover {
        background: var(--accent-blue);
        color: white;
        transform: scale(1.1);
    }

    .btn-delete:hover {
        background: #ef4444 !important;
    }

    .method-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 900;
        font-size: 0.7rem;
        margin-right: 8px;
    }

    .method-get { background: #dcfce7; color: #15803d; }
    .method-post { background: #e0f2fe; color: #0369a1; }
    .method-put { background: #fef9c3; color: #854d0e; }
    .method-delete { background: #fee2e2; color: #b91c1c; }

    .endpoint-text {
        font-family: 'Courier New', monospace;
        color: #334155;
        font-size: 0.95rem;
    }

    .desc-text {
        color: #64748b;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Filter Styles */
    .filter-pills {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .filter-pill {
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 800;
        font-size: 0.75rem;
        cursor: pointer;
        transition: all 0.3s;
        border: 2px solid transparent;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: rgba(255, 255, 255, 0.5);
        color: #64748b;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }

    .filter-pill:hover {
        background: white;
        transform: translateY(-2px);
    }

    .filter-pill.active {
        background: var(--accent-blue);
        color: white;
        box-shadow: 0 8px 15px rgba(62, 109, 156, 0.3);
    }

    .search-container {
        position: relative;
        margin-bottom: 20px;
    }

    .search-container input {
        border-radius: 50px;
        padding-left: 45px;
        height: 50px;
        border: 1px solid rgba(0,0,0,0.05);
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }

    .search-container i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--accent-blue);
        font-size: 1.1rem;
    }

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container" style="max-width: 1200px;">
            <div class="d-flex justify-content-between align-items-center mb-5 mt-2">
                <div>
                    <h1 class="font-black text-4xl text-white tracking-tighter mb-0 uppercase">API Documentation</h1>
                    <p class="text-white opacity-80 font-bold uppercase tracking-wider small mt-1">Endpoints & Integration Guide</p>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('admin.settings') }}" class="btn btn-light rounded-pill px-4 font-bold shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i> Settings
                    </a>
                    <a href="{{ route('api_documentations.create') }}" class="btn-create">
                        <i class="fas fa-terminal"></i> New Endpoint
                    </a>
                </div>
            </div>

            <div class="dashboard-card shadow-lg">
                <div class="row align-items-center mb-4">
                    <div class="col-lg-5">
                        <div class="search-container">
                            <i class="fas fa-search"></i>
                            <input type="text" id="apiSearch" class="form-control" placeholder="Search endpoints or descriptions...">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="filter-pills">
                            <div class="filter-pill active" data-method="all">All Endpoints</div>
                            <div class="filter-pill" data-method="GET">GET</div>
                            <div class="filter-pill" data-method="POST">POST</div>
                            <div class="filter-pill" data-method="PUT">PUT</div>
                            <div class="filter-pill" data-method="DELETE">DELETE</div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">ID</th>
                                <th style="width: 40%;">Endpoint Path</th>
                                <th style="width: 35%;">Action / Description</th>
                                <th style="width: 20%; text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($apiDocumentations as $apiDocumentation)
                                @php
                                    $method = 'GET';
                                    $path = $apiDocumentation->endpoint;
                                    if(preg_match('/^(GET|POST|PUT|DELETE|PATCH)\s?(.*)$/i', $path, $matches)) {
                                        $method = strtoupper($matches[1]);
                                        $path = $matches[2];
                                    }
                                    $methodClass = 'method-' . strtolower($method);
                                @endphp
                                <tr class="api-row" data-method="{{ $method }}">
                                    <td class="text-center text-muted font-bold" style="font-size: 0.8rem;">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="method-badge {{ $methodClass }}">{{ $method }}</span>
                                            <span class="endpoint-text endpoint">{{ $path }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="desc-text">{{ $apiDocumentation->description }}</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn-icon view-api-btn shadow-sm" title="Test Request">
                                                <i class="fas fa-play" style="font-size: 0.8rem;"></i>
                                            </button>
                                            <a href="{{ route('api_documentations.edit', $apiDocumentation->id) }}" class="btn-icon shadow-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('api_documentations.destroy', $apiDocumentation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete documentation for this endpoint?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon btn-delete shadow-sm text-white">
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
document.addEventListener("DOMContentLoaded", function() {
    $('.view-api-btn').click(function() {
        const baseUrl = window.location.origin.trim();
        const row = $(this).closest('tr');
        const endpointRaw = row.find('.endpoint').text().trim();
        
        // Handle method if it was part of the text or extracted earlier
        let path = endpointRaw.replace(/^\/(?:GET|POST|PUT|DELETE)\s/, '');
        
        const placeholderRegex = /{([^}]*)}/;
        
        if (placeholderRegex.test(path)) {
            const placeholder = placeholderRegex.exec(path)[1];
            const value = prompt(`Enter value for ${placeholder}`);
            if (value !== null) {
                const finalUrl = constructApiUrl(baseUrl, path, value);
                window.open(finalUrl, '_blank').focus();
            }
        } else {
            const finalUrl = constructApiUrl(baseUrl, path, '');
            window.open(finalUrl, '_blank').focus();
        }
    });
    // Search and Filter Logic
    function filterEndpoints() {
        var searchValue = $('#apiSearch').val().toLowerCase();
        var activeMethod = $('.filter-pill.active').data('method');
        
        $('.api-row').each(function() {
            var rowText = $(this).text().toLowerCase();
            var rowMethod = $(this).data('method');
            
            var matchesSearch = rowText.indexOf(searchValue) > -1;
            var matchesMethod = (activeMethod === 'all' || rowMethod === activeMethod);
            
            if (matchesSearch && matchesMethod) {
                $(this).fadeIn(200);
            } else {
                $(this).fadeOut(100);
            }
        });
    }

    $('#apiSearch').on('keyup', filterEndpoints);

    $('.filter-pill').click(function() {
        $('.filter-pill').removeClass('active');
        $(this).addClass('active');
        filterEndpoints();
    });
});

function constructApiUrl(baseUrl, endpoint, value) {
    // Ensure endpoint starts with api/ if not present
    let cleanEndpoint = endpoint.replace(/^\//, '').trim();
    let apiUrl = cleanEndpoint.replace(/{([^}]*)}/g, value);
    
    // Add missing / if needed
    if (!apiUrl.startsWith('api/') && !apiUrl.startsWith('http')) {
        apiUrl = 'api/' + apiUrl;
    }
    
    return `${baseUrl}/${apiUrl}`;
}
</script>
