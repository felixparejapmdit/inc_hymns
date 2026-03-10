<style>
    :root {
        --accent-blue: #3e6d9c;
        --accent-dark: #2c527a;
        --glass-bg: rgba(255, 255, 255, 0.65); /* Reduced opacity for better glass effect */
        --input-bg: rgba(248, 250, 252, 0.8);
        --input-border: #e2e8f0;
        --primary-gradient: linear-gradient(to bottom, #64B5D6 0%, #3E6D9C 100%);
    }

    body {
        background: var(--primary-gradient) !important;
        background-attachment: fixed !important;
        min-height: 100vh;
    }

    .form-glass {
        background: var(--glass-bg);
        backdrop-filter: blur(15px); /* Increased blur for premium feel */
        -webkit-backdrop-filter: blur(15px);
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        padding: 3rem;
    }

    .section-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--accent-blue);
        border-left: 5px solid var(--accent-blue);
        padding-left: 1rem;
        margin-bottom: 2rem;
        font-size: 1rem;
    }

    .custom-label {
        font-weight: 700;
        color: #475569;
        font-size: 0.85rem;
        margin-bottom: 0.6rem;
        display: block;
    }

    .modern-input {
        background: var(--input-bg) !important;
        border: 1px solid var(--input-border) !important;
        border-radius: 14px !important;
        padding: 0.8rem 1.2rem !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-weight: 500;
        color: #1e293b;
        width: 100%;
    }

    .modern-input:focus {
        background: #fff !important;
        border-color: var(--accent-blue) !important;
        box-shadow: 0 0 0 4px rgba(62, 109, 156, 0.1) !important;
        outline: none;
    }

    /* File Upload Styling */
    .file-upload-card {
        background: #fff;
        border: 2px dashed #cbd5e1;
        border-radius: 18px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s;
        cursor: pointer;
        position: relative;
    }

    .file-upload-card:hover { border-color: var(--accent-blue); background: #f1f7ff; }

    .file-upload-card i { font-size: 1.5rem; color: #94a3b8; margin-bottom: 0.5rem; }

    .file-name-preview { font-size: 0.75rem; color: var(--accent-blue); font-weight: 700; margin-top: 5px; }

    /* Dropdown/Multi-select Restyle */
    .combo-box { position: relative; width: 100%; }
    
    .input-container {
        min-height: 52px;
        background: var(--input-bg);
        border: 1px solid var(--input-border);
        border-radius: 14px;
        padding: 8px 45px 8px 12px;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
    }

    .input-container:hover { border-color: #cbd5e1; }
    
    .selected-tag {
        background: var(--accent-blue);
        color: white;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .selected-tag span {
        cursor: pointer;
        font-size: 1.1rem;
        line-height: 1;
        opacity: 0.8;
    }

    .selected-tag span:hover { opacity: 1; }

    #category-input, #lyricist-input, #composer-input, #arranger-input, #instrumentation-input, #ensemble_type-input {
        border: none !important;
        background: transparent !important;
        flex: 1;
        min-width: 120px;
        font-size: 0.9rem;
        outline: none !important;
        box-shadow: none !important;
    }

    .options-container {
        position: absolute;
        top: 105%;
        left: 0;
        width: 100%;
        background: white;
        border-radius: 18px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        border: 1px solid #e2e8f0;
        z-index: 1001;
        max-height: 250px;
        overflow-y: auto;
        display: none;
        padding: 10px;
    }

    .options-container.active { display: block; animation: fadeInUp 0.2s ease-out; }

    .option-item {
        padding: 8px 12px;
        border-radius: 10px;
        transition: background 0.2s;
        cursor: pointer;
    }

    .option-item:hover { background: #f8fafc; }
    
    .option-item label {
        display: flex;
        align-items: center;
        width: 100%;
        cursor: pointer;
        font-weight: 500;
        color: #475569;
        margin: 0;
    }

    .option-item input { margin-right: 12px; width: 18px; height: 18px; border-radius: 4px; }

    /* Buttons */
    .btn-premium {
        padding: 0.8rem 2rem;
        border-radius: 15px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .btn-save { background: var(--accent-blue) !important; border: none !important; color: white !important; }
    .btn-save:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(62, 109, 156, 0.3); }

    .btn-cancel { background: #f1f5f9 !important; border: 1px solid #e2e8f0 !important; color: #64748b !important; }
    .btn-cancel:hover { background: #e2e8f0 !important; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* Custom Checkbox */
    input[type="checkbox"] {
        accent-color: var(--accent-blue);
    }

    /* ===== FORM GRID UTILITIES (replaces broken Bootstrap .row/.col-md-*) ===== */
    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .form-grid-3 {
        display: grid;
        grid-template-columns: 2fr 1fr 1.5fr;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .col-full {
        grid-column: 1 / -1;
    }

    @media (max-width: 768px) {
        .form-grid-2, .form-grid-3 { grid-template-columns: 1fr; }
        .col-full { grid-column: 1; }
    }

    /* ===== REFERENCE VERSE SINGLE-ROW PICKER ===== */
    .verse-picker-row {
        display: flex;
        flex-wrap: nowrap;
        gap: 0.85rem;
        align-items: flex-end;
        margin-bottom: 1rem;
    }

    .verse-picker-row > .verse-field {
        flex: 1;
        min-width: 0;
    }

    .verse-picker-row > .verse-field-sm {
        flex: 0.7;
        min-width: 0;
    }

    .verse-picker-row > .verse-field-lg {
        flex: 1.6;
        min-width: 0;
    }

    .verse-picker-row > .verse-btn {
        flex: 0 0 auto;
    }

    .verse-fetch-status {
        font-size: 0.8rem;
        color: var(--accent-blue);
        font-weight: 600;
        margin-top: 0.4rem;
        min-height: 1.2rem;
    }

    select.modern-input:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    @media (max-width: 900px) {
        .verse-picker-row { flex-wrap: wrap; }
        .verse-picker-row > .verse-field,
        .verse-picker-row > .verse-field-sm,
        .verse-picker-row > .verse-field-lg { flex: 1 1 45%; }
    }
</style>
