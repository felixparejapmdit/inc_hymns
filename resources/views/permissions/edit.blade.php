<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    :root {
        --primary-gradient: linear-gradient(to bottom, #64B5D6 0%, #3E6D9C 100%);
        --card-bg: rgba(255, 255, 255, 0.96);
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

    .page-form-card {
        background: var(--card-bg);
        border-radius: 30px;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.12);
        overflow: hidden;
    }

    .page-form-header {
        padding: 1.5rem 1.75rem;
        background: linear-gradient(135deg, rgba(62, 109, 156, 0.12), rgba(255, 255, 255, 0.4));
        border-bottom: 1px solid rgba(148, 163, 184, 0.18);
    }

    .page-form-title {
        margin: 0;
        color: #12314d;
        font-size: 1.1rem;
        font-weight: 900;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .page-form-hint {
        margin: 0.45rem 0 0;
        color: #5f6f85;
        font-weight: 600;
        font-size: 0.92rem;
    }

    .page-form-body {
        padding: 1.75rem;
    }

    .field-label {
        display: block;
        margin-bottom: 0.55rem;
        color: #36485d;
        font-size: 0.8rem;
        font-weight: 900;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .field-input {
        width: 100%;
        height: 52px;
        border-radius: 18px;
        border: 1px solid #d8e3ef;
        background: #fff;
        padding: 0 1rem;
        font-weight: 700;
        color: #17324f;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .field-textarea {
        min-height: 130px;
        height: auto;
        padding-top: 0.9rem;
        resize: vertical;
    }

    .field-input:focus {
        outline: none;
        border-color: rgba(62, 109, 156, 0.7);
        box-shadow: 0 0 0 4px rgba(62, 109, 156, 0.1);
    }

    .field-note {
        margin-top: 0.45rem;
        color: #7a879a;
        font-size: 0.82rem;
        font-weight: 600;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }

    .action-btn {
        min-height: 48px;
        padding: 0 1.4rem;
        border-radius: 999px;
        font-weight: 900;
        letter-spacing: 0.04em;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        border: none;
        transition: transform 0.2s ease, background 0.2s ease;
    }

    .action-btn:hover {
        transform: translateY(-1px);
    }

    .action-btn-cancel {
        background: #eef2f7;
        color: #334155;
    }

    .action-btn-primary {
        background: var(--accent-blue);
        color: #fff;
        box-shadow: 0 14px 30px rgba(62, 109, 156, 0.22);
    }

    .action-btn-primary:hover {
        background: #2f5780;
        color: #fff;
    }
</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container-fluid px-5 px-xl-5 page-shell">
            <div class="page-header-shell">
                <div>
                    <div class="page-kicker">
                        <i class="fas fa-shield-alt"></i>
                        Edit Permission
                    </div>
                    <h1 class="page-title">Edit Permission</h1>
                    <p class="page-subtitle">Refine the permission name, description, and category with a clean editing flow.</p>
                </div>
                <a href="{{ route('permissions.index') }}" class="page-action-btn page-action-btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

            <div class="page-form-card">
                <div class="page-form-header">
                    <p class="page-form-title">Permission Details</p>
                    <p class="page-form-hint">Update this permission so it remains aligned with your access structure.</p>
                </div>

                <div class="page-form-body">
                    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="field-label">Name</label>
                            <input id="name" class="field-input" type="text" name="name" value="{{ old('name', $permission->name) }}" required autofocus>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="description" class="field-label">Description</label>
                            <textarea id="description" class="field-input field-textarea" name="description" required>{{ old('description', $permission->description) }}</textarea>
                            <div class="field-note">Use a concise description that explains what the permission unlocks.</div>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mb-2">
                            <label for="category_id" class="field-label">Category</label>
                            <select id="category_id" name="category_id" class="field-input">
                                @if (!empty($categories))
                                    @foreach ($categories as $category)
                                        @if (!empty($category->name))
                                            <option value="{{ $category->id }}" @selected(old('category_id', $permission->category_id) == $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('permissions.index') }}" class="action-btn action-btn-cancel">
                                Cancel
                            </a>
                            <button type="submit" class="action-btn action-btn-primary">
                                <i class="fas fa-check"></i>
                                <span>Save Changes</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
