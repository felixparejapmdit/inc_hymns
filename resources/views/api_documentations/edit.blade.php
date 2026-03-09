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
        padding: 40px 0;
    }

    .form-card {
        background: var(--card-bg);
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
        padding: 3rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .form-control-custom {
        border-radius: 15px !important;
        padding: 15px 20px !important;
        border: 2px solid #e2e8f0 !important;
        font-weight: 600;
        transition: all 0.3s;
        background: #f8fafc !important;
    }

    .form-control-custom:focus {
        border-color: var(--accent-blue) !important;
        box-shadow: 0 0 0 4px rgba(62, 109, 156, 0.1) !important;
        background: white !important;
    }

    .form-label-custom {
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 10px;
        display: block;
    }

    .btn-submit {
        background: var(--accent-blue);
        color: white;
        border-radius: 50px;
        padding: 15px 40px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: 2px;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 10px 20px rgba(62, 109, 156, 0.3);
    }

    .btn-submit:hover {
        background: #2d547a;
        transform: translateY(-2px);
        box-shadow: 0 15px 25px rgba(62, 109, 156, 0.4);
        color: white;
    }

    .btn-cancel {
        color: #64748b;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none !important;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        color: #1e293b;
    }

    .page-title {
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: -1px;
        color: white;
        text-align: center;
        margin-bottom: 3rem;
    }

</style>

<x-app-layout>
    <div class="glass-container">
        <div class="container">
            <h1 class="page-title text-5xl">Edit Endpoint</h1>

            <div class="form-card">
                <form action="{{ route('api_documentations.update', $apiDocumentation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-5">
                        <label for="endpoint" class="form-label-custom">Endpoint Path & Method</label>
                        <input type="text" name="endpoint" id="endpoint" 
                               class="form-control form-control-custom" 
                               value="{{ $apiDocumentation->endpoint }}" 
                               required>
                        <small class="text-slate-400 font-bold mt-2 d-block">Format: METHOD /path/to/resource</small>
                    </div>

                    <div class="form-group mb-5">
                        <label for="description" class="form-label-custom">Action Description</label>
                        <textarea name="description" id="description" 
                                  class="form-control form-control-custom" 
                                  rows="4" 
                                  required>{{ $apiDocumentation->description }}</textarea>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-5">
                        <a href="{{ route('api_documentations.index') }}" class="btn-cancel">
                            <i class="fas fa-arrow-left mr-2"></i> Gallery
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-sync-alt mr-2"></i> Update Reference
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
