<x-guest-layout>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

  body {
    font-family: 'Inter', sans-serif;
  }

  .login-bg-container {
    background: linear-gradient(to bottom, #64B5D6 0%, #3E6D9C 100%) !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    background-attachment: fixed !important;
    min-height: 100vh !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 20px;
  }

  /* Clean White Card */
  .center-glass-card {
    max-width: 480px;
    width: 100%;
    padding: 60px 40px; 
    background: #ffffff !important;
    border-radius: 24px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1) !important;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    overflow: hidden;
  }

  /* Title Styling */
  .login-title {
    color: #1e3a8a; /* Deep Navy Blue */
    font-weight: 800;
    font-size: 42px;
    margin-bottom: 35px;
    letter-spacing: -1px;
  }

  /* Input Fields */
  .input-container {
    width: 100%;
    position: relative;
    margin-bottom: 25px;
  }

  .input-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    z-index: 10;
  }

  input.custom-input {
    width: 100%;
    padding: 14px 15px 14px 45px !important;
    background: #f9fafb !important;
    border: 1px solid #e5e7eb !important; /* Light gray border */
    border-radius: 12px !important;
    color: #111827 !important;
    transition: all 0.2s ease-in-out;
  }

  input.custom-input::placeholder {
    color: #9ca3af;
  }

  input.custom-input:focus {
    background: #ffffff !important;
    border-color: #3b82f6 !important;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    outline: none;
  }

  /* Labels */
  .custom-label {
    color: #374151 !important;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    font-size: 14px;
    padding-left: 2px;
  }

  /* Gradient Action Button */
  .login-btn {
    width: 100%;
    padding: 16px !important;
    background: linear-gradient(135deg, #64B5D6, #3E6D9C) !important;
    border: none !important;
    border-radius: 12px !important;
    color: white !important;
    font-weight: 700 !important;
    font-size: 15px !important;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease !important;
  }

  .login-btn:hover {
    background: #1e40af !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
  }

  /* Footer Attribution */
  .footer-attr {
    margin-top: 40px;
    color: #6b7280;
    font-size: 12px;
  }

  @media (max-width: 480px) {
    .center-glass-card {
      padding: 40px 25px;
    }
    .login-title {
      font-size: 34px;
    }
  }

  .logo-hover {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    margin-bottom: 20px;
  }
  .logo-hover:hover {
    transform: scale(1.05);
  }
</style>

<div class="center-glass-card">
  <!-- Logo Section -->
  <div class="mb-6 logo-hover">
    <img src="{{ asset('images/logo.png') }}" alt="INC Hymns Logo" width="120" height="120">
  </div>

  <h1 class="login-title">INC Hymns</h1>

  <form method="POST" action="{{ route('login') }}" class="w-full">
    @csrf

    <!-- Username -->
    <div class="input-container">
      <label for="username" class="custom-label">{{ __('Username') }}</label>
      <span class="input-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
      </span>
      <input id="username" class="custom-input" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" placeholder="Enter your username" />
      <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-600" />
    </div>

    <!-- Password -->
    <div class="input-container">
      <label for="password" class="custom-label">{{ __('Password') }}</label>
      <span class="input-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
      </span>
      <input id="password" class="custom-input" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
      <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
    </div>

    <div class="mt-8">
      <button type="submit" class="login-btn">
        {{ __('Log in') }}
      </button>
    </div>
  </form>

  <div class="footer-attr">
    Developed by <span style="font-weight: 700; color: #1e3a8a;">PMD-IT</span>
  </div>
</div>

<script>
  window.onload = function() {
    document.getElementById('username').value = '';
    document.getElementById('password').value = '';
  }
</script>
</x-guest-layout>