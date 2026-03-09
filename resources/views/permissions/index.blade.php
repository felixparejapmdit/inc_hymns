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
        margin-bottom: 2rem;
    }

    .category-header {
        background: var(--accent-blue);
        color: white;
        padding: 10px 25px;
        border-radius: 50px;
        display: inline-block;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(62, 109, 156, 0.2);
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table-modern th {
        padding: 1rem 1.2rem;
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

    .permission-desc {
        color: #64748b;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .category-header {
        cursor: pointer;
        transition: all 0.2s;
        user-select: none;
        width: 100%;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .category-header.collapsed i {
        transform: rotate(-90deg);
    }

    .permission-count-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 2px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        margin-left: 10px;
    }

    .category-header {
        cursor: pointer;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--accent-blue);
        color: white;
        padding: 15px 30px;
        border-radius: 15px;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
        transition: all 0.3s;
        border: none;
    }

    .category-header:hover {
        background: #2d547a;
        transform: translateY(-2px);
    }

    .rounded-pill-left {
        border-top-left-radius: 50px !important;
        border-bottom-left-radius: 50px !important;
    }

    .rounded-pill-right {
        border-top-right-radius: 50px !important;
        border-bottom-right-radius: 50px !important;
    }

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container" style="max-width: 1100px;">
            <div class="d-flex justify-content-between align-items-center mb-5 mt-2">
                <div>
                    <h1 class="font-black text-4xl text-white tracking-tighter mb-0 uppercase">Permissions</h1>
                    <p class="text-white opacity-80 font-bold uppercase tracking-wider small mt-1">Access Control & Security</p>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <div class="input-group mr-2">
                        <input type="text" id="permissionSearch" class="form-control rounded-pill-left border-0 px-4 font-bold shadow-sm" style="width: 250px; height: 45px;" placeholder="Search permissions...">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-0 rounded-pill-right shadow-sm px-3">
                                <i class="fas fa-search text-primary"></i>
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('admin.settings') }}" class="btn btn-light rounded-pill px-4 font-bold shadow-sm d-flex align-items-center" style="height: 45px;">
                        <i class="fas fa-arrow-left mr-2"></i> Settings
                    </a>
                    <a href="{{ route('permissions.create') }}" class="btn-create" style="height: 45px;">
                        <i class="fas fa-shield-alt"></i> New Permission
                    </a>
                </div>
            </div>

            @if ($categories->isNotEmpty())
                @foreach ($categories as $category)
                    @if ($category->permissions->isNotEmpty())
                        <div class="category-container mb-4">
                            <div class="category-header toggle-accordion" data-target="#cat-{{ $category->id }}">
                                <div>
                                    <i class="fas fa-folder-open mr-2 opacity-70"></i>
                                    {{ $category->name }}
                                    <span class="permission-count-badge">{{ $category->permissions->count() }} Permissions</span>
                                </div>
                                <i class="fas fa-chevron-down transition-transform duration-300"></i>
                            </div>
                            
                            <div id="cat-{{ $category->id }}" class="dashboard-card shadow-lg mt-3" style="display: block;">
                                <div class="table-responsive">
                                <table class="table-modern">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:5%;">#</th>
                                            <th style="width:35%;">{{ __('Permission Name') }}</th>
                                            <th style="width:40%;">{{ __('Description') }}</th>
                                            <th class="text-center" style="width:20%;">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category->permissions as $permission)
                                            <tr>
                                                <td class="text-center text-muted font-bold" style="font-size: 0.8rem;">{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="font-black text-slate-800">{{ $permission->name }}</div>
                                                </td>
                                                <td>
                                                    <div class="permission-desc">{{ $permission->description }}</div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn-icon shadow-sm" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-icon btn-delete shadow-sm" title="Delete">
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
                    @endif
                @endforeach
            @else
                <div class="dashboard-card shadow-lg text-center p-5">
                    <div class="text-slate-400 font-bold uppercase tracking-widest">{{ __('No permissions found.') }}</div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

<script>
    $('.delete-form').submit(function(e) {
        if (!$(this).data('confirmed')) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this permission? This cannot be undone.')) {
                $(this).data('confirmed', true);
                this.submit();
            }
        }
    });

    // Manual Accordion Control to fix the double-toggle bug
    $('.toggle-accordion').click(function() {
        var targetId = $(this).data('target');
        var $target = $(targetId);
        var $icon = $(this).find('.fa-chevron-down');
        
        $(this).toggleClass('collapsed');
        $target.slideToggle(300);
        
        // Rotate icon
        if ($(this).hasClass('collapsed')) {
            $icon.css('transform', 'rotate(-90deg)');
        } else {
            $icon.css('transform', 'rotate(0deg)');
        }
    });

    // Client-side search logic
    $('#permissionSearch').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        
        $('.category-container').each(function() {
            var hasVisible = false;
            var $container = $(this);
            
            $container.find('tbody tr').filter(function() {
                var match = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(match);
                if (match) hasVisible = true;
            });
            
            if (hasVisible) {
                $container.fadeIn(200);
                // If searching, ensure matched categories are expanded
                if (value.length > 0) {
                    $container.find('.dashboard-card').slideDown();
                    $container.find('.toggle-accordion').removeClass('collapsed').find('.fa-chevron-down').css('transform', 'rotate(0deg)');
                }
            } else {
                $container.fadeOut(100);
            }
        });
    });
</script>
