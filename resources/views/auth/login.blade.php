<x-guest-layout>
<style>
  /* Add responsive background image */
  .bg-gray-100 {
    /* background-image: url("{{ asset('images/login_bg.jpg') }}"); */
    
  background: linear-gradient(to bottom, #5eb8d3, #4975b4);
    background-size: 100% 100vh; /* Set background size to 100% width and 100vh height */
  background-position: center;
    background-repeat: no-repeat;
    height: 100vh; /* Set height to 100vh for full-screen background */
  }

  .bg-white{
    background-color: transparent; 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.0); /* Add subtle shadow for better depth */

  }
 /* Add responsive styles for form and layout */
 .left-aligned-div {
  max-width: 500px; /* Adjust max-width to 500px */
  margin: 40px auto; /* Add margin for better spacing */
  padding: 20px; /* Add padding for better spacing */
  background-color: #fff; /* Add white background for better contrast */
  border: 1px solid #ddd; /* Add border for better definition */
  border-radius: 10px; /* Add rounded corners for better aesthetics */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add subtle shadow for better depth */
  display: flex; /* Add flexbox to center elements */
  flex-direction: column; /* Set flex direction to column */
  align-items: center; /* Center elements horizontally */
  display: flex;
  justify-content: left; /* Add this to left-align the container */
}
  /* Add responsive styles for form elements */
  .block {
    width: 100%; /* Set width to 100% for full-width form elements */
  }

  /* Add responsive styles for buttons */
  .x-primary-button {
  background-color: #007bff; /* Update the primary button background color */
  color: #fff; /* Update the primary button text color */
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
  /* Add media queries for different screen sizes */
  @media only screen and (max-width: 768px) {
    .left-aligned-div {
      max-width: 400px; /* Adjust max-width for smaller screens */
    }
  }

  @media only screen and (max-width: 480px) {
    .left-aligned-div {
      max-width: 250px; /* Adjust max-width for even smaller screens */
    }
  }

  /* Add media queries for iPhone sizes */
  @media only screen and (max-width: 414px) { /* iPhone 11, 11 Pro, XS, XS Max */
    .left-aligned-div {
      max-width: 350px; /* Adjust max-width for iPhone 11, 11 Pro, XS, XS Max */
    }
  }

  @media only screen and (max-width: 390px) { /* iPhone 12, 12 Pro, 12 Pro Max */
    .left-aligned-div {
      max-width: 320px; /* Adjust max-width for iPhone 12, 12 Pro, 12 Pro Max */
    }
  }

  @media only screen and (max-width: 428px) { /* iPhone 13, 13 Pro, 13 Pro Max */
    .left-aligned-div {
      max-width: 360px; /* Adjust max-width for iPhone 13, 13 Pro, 13 Pro Max */
    }
  }

  @media only screen and (max-width: 458px) { /* iPhone 14, 14 Pro, 14 Pro Max */
    .left-aligned-div {
      max-width: 380px; /* Adjust max-width for iPhone 14, 14 Pro, 14 Pro Max */
    }
  }

  @media only screen and (max-width: 492px) { /* iPhone 16, 16 Pro, 16 Pro Max */
    .left-aligned-div {
      max-width: 400px; /* Adjust max-width for iPhone 16, 16 Pro, 16 Pro Max */
    }
  }
  
.fixed-bottom-right {
  position: fixed;
  bottom: 10px;
  right: 10px;
  color: #fff;
  padding: 10px;
  border-radius: 5px;
  font-size: 9px;
  font-weight: normal;
  z-index: 100;
  font-family: Arial; /* corrected from font-style to font-family */
}
</style>

<!-- Session Status -->
<div class="flex justify-center mb-1"> <!-- Add a container for the logo and h2 -->
  <img src="{{ asset('images/logo.png') }}" alt="INC Hymns Logo" width="100" height="100" class="mr-4"> <!-- Add the logo image -->

</div>

<div class="left-aligned-div">
<h2 style="background: linear-gradient(to right, #475b9a, #6aa8c4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: bold;font-size:30px;">INC Hymns</h2>
  <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Username -->
    <div>
      <x-input-label for="username" :value="__('Username')" />
      <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
      <x-input-error :messages="$errors->get('username')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password" class="block mt-1 w-full"
                      type="password"
                      name="password"
                      required autocomplete="current-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Forgot Password Link -->
    <!-- <div class="mt-2">
      <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline-none">Forgot Password?</a>
    </div> -->
    <div class="flex items-center justify-center mt-4">
        <x-primary-button style="background-color: #007bff;">
            {{ __('Log in') }}
        </x-primary-button>
    </div>

  </form>

    <!-- Fixed Bottom Right Div -->
  <div class="fixed-bottom-right">
      Developed by PMD-IT
  </div>
</div>

<script>
  function clearLoginForm() {
    document.getElementById('username').value = ''; // Clear username field
    document.getElementById('password').value = ''; // Clear password field
  }
</script>
</x-guest-layout>