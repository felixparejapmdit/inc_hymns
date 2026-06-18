<!-- music_management/categories.blade.php -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery before Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    :root {
        --group-bg-1: #64b5d6;
        --group-bg-2: #3e6d9c;
        --group-bg-3: #2c527b;
        --group-card: rgba(255, 255, 255, 0.92);
        --group-border: rgba(255, 255, 255, 0.45);
        --group-text: #15304f;
        --group-muted: #64748b;
        --group-line: #dbe3ee;
    }

    body {
        background: linear-gradient(180deg, var(--group-bg-1) 0%, var(--group-bg-2) 58%, var(--group-bg-3) 100%) !important;
        background-attachment: fixed !important;
        min-height: 100vh;
    }

    .group-edit-shell {
        max-width: 100%;
        padding: 0 1rem 2rem;
    }

    .group-edit-hero {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
        color: #fff;
    }

    .group-edit-kicker {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 0.8rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.16);
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        margin-bottom: 0.85rem;
    }

    .group-edit-title {
        margin: 0;
        font-size: clamp(2rem, 3.8vw, 3.4rem);
        line-height: 0.98;
        font-weight: 950;
        letter-spacing: -0.05em;
        color: #fff;
    }

    .group-edit-subtitle {
        margin: 0.75rem 0 0;
        max-width: 54rem;
        color: rgba(255, 255, 255, 0.82);
        font-size: 0.95rem;
        font-weight: 600;
        line-height: 1.6;
    }

    .group-edit-card {
        background: var(--group-card);
        border: 1px solid var(--group-border);
        border-radius: 30px;
        box-shadow: 0 24px 70px rgba(0, 0, 0, 0.16);
        overflow: hidden;
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .group-edit-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(219, 227, 238, 0.9);
        background: linear-gradient(180deg, rgba(248, 250, 252, 0.95), rgba(255, 255, 255, 0.95));
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .group-edit-card-title {
        margin: 0;
        color: #0f172a;
        font-size: 1.05rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .group-edit-card-title i {
        color: var(--group-bg-2);
        margin-right: 0.55rem;
    }

    .group-edit-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .group-edit-btn {
        min-height: 46px;
        border-radius: 999px;
        padding: 0 1.3rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .group-edit-btn-secondary {
        background: #fff;
        color: #334155;
        border: 1px solid #dbe3ee;
    }

    .group-edit-body {
        padding: 1.5rem;
    }

    .group-field-label {
        display: block;
        margin-bottom: 0.55rem;
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--group-muted);
    }

    .group-name-input {
        width: 100%;
        min-height: 56px;
        border-radius: 18px;
        border: 1px solid #dbe3ee;
        background: #f8fafc;
        color: var(--group-text);
        font-weight: 700;
        padding: 0.95rem 1rem;
        transition: all 0.2s ease;
    }

    .group-name-input:focus {
        background: #fff;
        outline: none;
        border-color: rgba(62, 109, 156, 0.7);
        box-shadow: 0 0 0 4px rgba(62, 109, 156, 0.12);
    }

    .permissions-shell {
        margin-top: 1.5rem;
        border: 1px solid #e5edf5;
        border-radius: 22px;
        overflow: hidden;
        background: #fff;
    }

    .permissions-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .permissions-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .permissions-table thead th {
        position: sticky;
        top: 0;
        background: linear-gradient(180deg, #f8fafc, #eef4fb);
        color: #334155;
        font-size: 0.74rem;
        font-weight: 900;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        border-bottom: 1px solid #dbe3ee;
        padding: 1rem 1rem;
        white-space: nowrap;
    }

    .permissions-table tbody td {
        padding: 0.95rem 1rem;
        border-bottom: 1px solid #edf2f7;
        vertical-align: middle;
    }

    .permissions-table tbody tr:hover td {
        background: #f8fbff;
    }

    .permission-group-row td {
        background: linear-gradient(180deg, #f8fbff, #f1f7fd);
        font-weight: 900;
        color: #1d4f7a;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-size: 0.76rem;
    }

    .permission-name {
        font-weight: 700;
        color: #0f172a;
    }

    .permission-radio {
        width: 18px;
        height: 18px;
        accent-color: var(--group-bg-2);
        cursor: pointer;
    }

    .group-edit-footer {
        margin-top: 1.5rem;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .group-edit-shell {
            padding: 0 0.75rem 1.5rem;
        }

        .group-edit-card-header,
        .group-edit-body {
            padding: 1rem;
        }

        .permissions-table thead th,
        .permissions-table tbody td {
            padding: 0.85rem 0.75rem;
        }
    }
</style>

<x-app-layout>
    <div class="group-edit-shell py-8">
        <div class="group-edit-hero">
            <div>
                <div class="group-edit-kicker">
                    <i class="fas fa-user-shield"></i>
                    Group Editor
                </div>
                <h2 class="group-edit-title">{{ __('Edit Group') }}</h2>
                <p class="group-edit-subtitle">
                    Expand and fine-tune group access in a full-width workspace designed for faster editing and clearer permission control.
                </p>
            </div>
        </div>

        <div class="group-edit-card">
            <div class="group-edit-card-header">
                <div>
                    <h3 class="group-edit-card-title">
                        <i class="fas fa-id-badge"></i>
                        Group Details
                    </h3>
                </div>
                <div class="group-edit-actions">
                    <a href="{{ route('groups.index') }}" class="btn group-edit-btn group-edit-btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i> Cancel
                    </a>
                    <x-primary-button form="groupEditForm" class="group-edit-btn" style="background: linear-gradient(135deg, #3e6d9c, #64b5d6); border: none; color: #fff;">
                        <i class="fas fa-check mr-2 icon-white" aria-hidden="true"></i>{{ __('Save Changes') }}
                    </x-primary-button>
                </div>
            </div>

            <div class="group-edit-body">
                <form id="groupEditForm" method="POST" action="{{ route('groups.update', $group->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-12 col-xl-4 mb-4">
                            <label class="group-field-label" for="name">Group Name</label>
                            <x-text-input id="name" class="group-name-input" type="text" name="name" :value="$group->name" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <div class="permissions-shell">
                        <div class="group-edit-card-header" style="border-bottom: 1px solid #e5edf5;">
                            <div>
                                <h3 class="group-edit-card-title" style="margin:0;">
                                    <i class="fas fa-shield-halved"></i>
                                    Permissions Matrix
                                </h3>
                            </div>
                        </div>

                        <div class="permissions-table-wrap">
                            <table class="permissions-table table">
                                <thead>
                                    <tr>
                                        <th style="width: 60%;">Permission</th>
                                        <th class="text-center" style="width: 20%;">Grant</th>
                                        <th class="text-center" style="width: 20%;">Deny</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissionsArray as $permissionGroup => $groupPermissions)
                                        <tr class="permission-group-row">
                                            <td colspan="3">
                                                <i class="fas fa-folder-open mr-2"></i>{{ $permissionGroup }}
                                            </td>
                                        </tr>
                                        @foreach ($groupPermissions as $permission => $description)
                                            <tr>
                                                <td class="permission-name">{{ $description }}</td>
                                                <td class="text-center">
                                                    <input class="permission-radio" type="radio" name="permissions[{{ $permission }}]" value="1" {{ (isset($groupPermissionsArray[$permission]) && $groupPermissionsArray[$permission] == '1') ? 'checked' : '' }}>
                                                </td>
                                                <td class="text-center">
                                                    <input class="permission-radio" type="radio" name="permissions[{{ $permission }}]" value="0" {{ (!isset($groupPermissionsArray[$permission]) || $groupPermissionsArray[$permission] == '0') ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="p-3 p-md-4" style="border-top: 1px solid #e5edf5;">
                            <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                        </div>
                    </div>

                    <div class="group-edit-footer">
                        <a href="{{ route('groups.index') }}" class="btn group-edit-btn group-edit-btn-secondary">
                            <i class="fas fa-ban mr-2"></i> Cancel
                        </a>
                        <x-primary-button class="group-edit-btn" style="background: linear-gradient(135deg, #3e6d9c, #64b5d6); border: none; color: #fff;">
                            <i class="fas fa-check mr-2 icon-white" aria-hidden="true"></i>{{ __('Save Changes') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
