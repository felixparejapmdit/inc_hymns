<x-guest-layout>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

  :root {
    --login-blue-1: #64b5d6;
    --login-blue-2: #3e6d9c;
    --login-blue-3: #2f5780;
    --login-card: rgba(255, 255, 255, 0.76);
    --login-card-border: rgba(255, 255, 255, 0.36);
    --login-input: rgba(255, 255, 255, 0.84);
    --login-text: #15304f;
    --login-muted: #74839a;
  }

  html, body {
    height: 100%;
    width: 100%;
    margin: 0;
    overflow: hidden;
  }

  body {
    font-family: 'Inter', sans-serif;
    overscroll-behavior: none;
  }

  .login-bg-container {
    position: fixed;
    inset: 0;
    min-height: 100dvh !important;
    width: 100vw !important;
    height: 100dvh !important;
    margin: 0 !important;
    padding: clamp(12px, 2vw, 24px);
    box-sizing: border-box;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    overflow: hidden;
    background:
      radial-gradient(circle at 18% 18%, rgba(255, 255, 255, 0.16), transparent 26%),
      radial-gradient(circle at 82% 78%, rgba(255, 255, 255, 0.10), transparent 22%),
      linear-gradient(to bottom, var(--login-blue-1) 0%, var(--login-blue-2) 60%, #4b7eab 100%) !important;
    background-attachment: scroll !important;
  }

  .login-bg-container::before,
  .login-bg-container::after {
    content: '';
    position: absolute;
    inset: auto;
    border-radius: 999px;
    pointer-events: none;
    filter: blur(4px);
  }

  .login-bg-container::before {
    width: 420px;
    height: 420px;
    left: -120px;
    top: -120px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.18), transparent 68%);
  }

  .login-bg-container::after {
    width: 500px;
    height: 500px;
    right: -160px;
    bottom: -180px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.12), transparent 70%);
  }

  .login-shell {
    position: relative;
    z-index: 1;
    width: min(100%, 460px);
    display: flex;
    justify-content: center;
  }

  .login-shell::before {
    content: '';
    position: absolute;
    inset: 18px 18px auto 18px;
    height: 100%;
    border-radius: 30px;
    background: rgba(255, 255, 255, 0.16);
    filter: blur(22px);
    z-index: -1;
    transform: translateY(18px);
  }

  @keyframes loginRise {
    from {
      opacity: 0;
      transform: translateY(24px) scale(0.98);
    }
    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }

  .center-glass-card {
    position: relative;
    width: 100%;
    padding: clamp(30px, 5vw, 46px) clamp(22px, 5vw, 40px) clamp(28px, 5vw, 36px);
    border-radius: 28px;
    background:
      linear-gradient(180deg, rgba(255, 255, 255, 0.82) 0%, rgba(247, 250, 255, 0.74) 100%);
    border: 1px solid var(--login-card-border);
    box-shadow:
      0 28px 70px rgba(18, 54, 88, 0.24),
      inset 0 1px 0 rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    overflow: hidden;
    animation: loginRise 0.85s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .center-glass-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.95));
  }

  .center-glass-card::after {
    content: '';
    position: absolute;
    width: 260px;
    height: 260px;
    right: -120px;
    top: -140px;
    background: radial-gradient(circle, rgba(62, 109, 156, 0.12), transparent 65%);
    pointer-events: none;
  }

  .card-ribbon {
    position: absolute;
    inset: auto 0 0 0;
    height: 74px;
    background: linear-gradient(180deg, transparent 0%, rgba(62, 109, 156, 0.04) 100%);
    pointer-events: none;
  }

  .logo-hover {
    position: relative;
    width: 128px;
    height: 128px;
    margin: 0 auto 14px;
    display: grid;
    place-items: center;
    border-radius: 50%;
    background:
      radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.92), rgba(255, 255, 255, 0.58)),
      linear-gradient(135deg, rgba(100, 181, 214, 0.45), rgba(62, 109, 156, 0.18));
    box-shadow:
      0 16px 34px rgba(23, 50, 79, 0.14),
      inset 0 1px 0 rgba(255, 255, 255, 0.9);
    transition: transform 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.35s ease;
  }

  .logo-hover::before {
    content: '';
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.42);
    opacity: 0.8;
  }

  .logo-hover:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow:
      0 20px 42px rgba(23, 50, 79, 0.18),
      inset 0 1px 0 rgba(255, 255, 255, 0.9);
  }

  .logo-hover img {
    width: 84px;
    height: 84px;
    object-fit: contain;
    display: block;
    filter: drop-shadow(0 8px 18px rgba(0, 0, 0, 0.08));
  }

  .login-title {
    color: #2a4a8b;
    font-weight: 900;
    font-size: clamp(30px, 5.6vw, 46px);
    margin: 8px 0 28px;
    letter-spacing: -0.05em;
    text-align: center;
    line-height: 1.08;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.25);
  }

  .input-container {
    width: 100%;
    position: relative;
    margin-bottom: 18px;
  }

  .input-container::after {
    content: '';
    position: absolute;
    inset: auto 14px -5px 14px;
    height: 14px;
    border-radius: 999px;
    background: rgba(62, 109, 156, 0.08);
    filter: blur(8px);
    z-index: 0;
  }

  .input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    width: 34px;
    height: 34px;
    display: grid;
    place-items: center;
    color: #98a6bb;
    z-index: 2;
    pointer-events: none;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.7);
    border: 1px solid rgba(148, 163, 184, 0.12);
    transition: color 0.25s ease, transform 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
  }

  .input-container:focus-within .input-icon {
    color: #3e6d9c;
    background: rgba(255, 255, 255, 0.95);
    transform: translateY(-50%) scale(1.04);
    box-shadow: 0 8px 18px rgba(62, 109, 156, 0.12);
  }

  .custom-input {
    position: relative;
    z-index: 1;
    width: 100%;
    height: 56px;
    padding: 14px 18px 14px 60px !important;
    background: var(--login-input) !important;
    border: 1px solid rgba(148, 163, 184, 0.18) !important;
    border-radius: 16px !important;
    color: var(--login-text) !important;
    font-size: 0.98rem;
    font-weight: 600;
    transition: border-color 0.24s ease, box-shadow 0.24s ease, transform 0.24s ease, background 0.24s ease;
    box-shadow:
      0 8px 20px rgba(15, 23, 42, 0.05),
      inset 0 1px 0 rgba(255, 255, 255, 0.75);
  }

  .custom-input::placeholder {
    color: var(--login-muted);
    font-weight: 500;
  }

  .custom-input:focus {
    background: #ffffff !important;
    border-color: rgba(62, 109, 156, 0.78) !important;
    box-shadow:
      0 0 0 5px rgba(62, 109, 156, 0.12),
      0 14px 28px rgba(15, 23, 42, 0.08) !important;
    outline: none;
    transform: translateY(-1px);
  }

  .custom-label {
    color: #36485d !important;
    font-weight: 700;
    margin-bottom: 8px;
    display: block;
    font-size: 13px;
    padding-left: 2px;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }

  .login-btn {
    width: 100%;
    height: 54px;
    padding: 0 18px !important;
    background: linear-gradient(135deg, var(--login-blue-1), var(--login-blue-2)) !important;
    border: none !important;
    border-radius: 16px !important;
    color: white !important;
    font-weight: 800 !important;
    font-size: 15px !important;
    text-transform: uppercase;
    letter-spacing: 0.14em;
    cursor: pointer;
    transition: transform 0.25s ease, box-shadow 0.25s ease, filter 0.25s ease !important;
    box-shadow:
      0 16px 30px rgba(62, 109, 156, 0.28),
      inset 0 1px 0 rgba(255, 255, 255, 0.2);
  }

  .login-btn:hover {
    filter: brightness(1.05);
    transform: translateY(-2px);
    box-shadow:
      0 20px 34px rgba(62, 109, 156, 0.34),
      inset 0 1px 0 rgba(255, 255, 255, 0.22) !important;
  }

  .login-btn:active {
    transform: translateY(0);
  }

  .footer-attr {
    margin-top: 28px;
    color: #6b7280;
    font-size: 12px;
    text-align: center;
    position: relative;
    z-index: 1;
  }

  .footer-attr span {
    font-weight: 700;
    color: #1e3a8a;
  }

  .field-stack {
    margin-bottom: 8px;
  }

  @media (max-width: 640px) {
    .login-bg-container {
      padding: 18px;
    }

    .center-glass-card {
      border-radius: 24px;
      padding: 28px 18px 24px;
    }

    .login-title {
      margin-bottom: 22px;
    }

    .logo-hover {
      width: 112px;
      height: 112px;
    }

    .logo-hover img {
      width: 74px;
      height: 74px;
    }

    .custom-input {
      height: 54px;
    }

    .login-btn {
      height: 52px;
      font-size: 14px !important;
    }
  }

  @media (max-width: 380px) {
    .login-bg-container {
      padding: 12px;
    }

    .center-glass-card {
      border-radius: 20px;
      padding: 24px 16px 20px;
    }

    .login-title {
      font-size: 26px;
    }

    .custom-input {
      padding-left: 56px !important;
      font-size: 14px;
    }
  }
</style>

<div class="login-bg-container">
  <div class="login-shell">
    <div class="center-glass-card">
      <div class="card-ribbon"></div>
      <div class="mb-6 logo-hover">
        <img src="{{ asset('images/logo.png') }}" alt="INC Hymns Logo" width="120" height="120">
      </div>

      <h1 class="login-title">INC Hymns</h1>

      <form method="POST" action="{{ route('login') }}" class="w-full">
        @csrf

        <div class="field-stack">
          <div class="input-container">
            <span class="input-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </span>
            <input id="username" class="custom-input" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" placeholder="Enter your username" />
          </div>
          <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-600" />
        </div>

        <div class="field-stack">
          <div class="input-container">
            <span class="input-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            </span>
            <input id="password" class="custom-input" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
          </div>
          <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <div class="mt-7">
          <button type="submit" class="login-btn">
            {{ __('Log in') }}
          </button>
        </div>
      </form>

      <div class="footer-attr">
        Developed by <span>PMD-IT</span>
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = function() {
    document.getElementById('username').value = '';
    document.getElementById('password').value = '';
  }
</script>
</x-guest-layout>
