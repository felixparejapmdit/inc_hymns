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

  /* Glassmorphism Card */
  .center-glass-card {
    max-width: 480px;
    width: 100%;
    padding: 50px 40px; 
    background: rgba(255, 255, 255, 0.1) !important;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 20px;
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3) !important;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    overflow: hidden;
  }

  /* Title Styling */
  .login-title {
    color: #FFD700; /* Gold color sampled from logo */
    font-weight: 700;
    font-size: 38px;
    margin-bottom: 30px; /* Increased margin */
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    letter-spacing: 1.5px;
  }

  /* Input Fields */
  .input-container {
    width: 100%;
    position: relative;
    margin-bottom: 25px; /* Increased spacing */
  }

  .input-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.7);
    z-index: 10;
  }

  input.custom-input {
    width: 100%;
    padding: 14px 15px 14px 45px !important; /* Slightly larger padding */
    background: rgba(255, 255, 255, 0.9) !important; /* Higher opacity for readability */
    border: 1px solid rgba(173, 216, 230, 0.3) !important; /* Thin light-blue border */
    border-radius: 12px !important;
    color: #000000 !important; /* Forced black text */
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  input.custom-input::placeholder {
    color: rgba(0, 0, 0, 0.4);
  }

  input.custom-input:focus {
    background: #ffffff !important;
    border-color: #FFD700 !important; /* Gold border on focus */
    box-shadow: 0 0 15px rgba(255, 215, 0, 0.3) !important;
    outline: none;
    color: #000000 !important;
  }

  /* Labels */
  .custom-label {
    color: rgba(255, 255, 255, 0.85) !important;
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
    font-size: 14px;
    padding-left: 5px;
  }

  /* Button Styling */
  .login-btn {
    width: 100%;
    padding: 16px !important;
    background: linear-gradient(135deg, #64B5D6, #3E6D9C) !important; /* Matching background gradient */
    border: none !important;
    border-radius: 15px !important; /* Rounded corners as requested */
    color: white !important;
    font-weight: 700 !important;
    font-size: 16px !important;
    text-transform: uppercase;
    letter-spacing: 2px;
    cursor: pointer;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
  }

  .login-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(30, 60, 114, 0.5) !important;
    filter: brightness(1.1);
  }

  .login-btn:active {
    transform: translateY(-1px);
  }

  /* Footer Attribution */
  .footer-attr {
    margin-top: 40px;
    color: rgba(255, 255, 255, 0.4);
    font-size: 11px;
    letter-spacing: 0.5px;
  }

  /* Responsive Adjustments */
  @media (max-width: 480px) {
    .left-aligned-div {
      padding: 40px 25px;
    }
    .login-title {
      font-size: 30px;
    }
  }

  .logo-hover {
    transition: all 0.5s ease;
    margin-bottom: 25px;
  }
  .logo-hover:hover {
    transform: scale(1.1) rotate(5deg);
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
      <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-300" />
    </div>

    <!-- Password -->
    <div class="input-container">
      <label for="password" class="custom-label">{{ __('Password') }}</label>
      <span class="input-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
      </span>
      <input id="password" class="custom-input" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
      <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
    </div>

    <div class="mt-8">
      <button type="submit" class="login-btn">
        {{ __('Log in') }}
      </button>
    </div>
  </form>

  <div class="footer-attr">
    Developed by <span style="font-weight: 600; color: rgba(255, 255, 255, 0.8);">PMD-IT</span>
  </div>
</div>

<script>
  window.onload = function() {
    document.getElementById('username').value = '';
    document.getElementById('password').value = '';
  }
</script>
</x-guest-layout>