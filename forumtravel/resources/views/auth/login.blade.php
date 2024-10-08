@extends('layouts.app')

@section('content')
<div class="container-fluid login-container" style="background-image: url('putanja/do/slike.jpg');">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: rgba(52, 152, 219, 0.8); color: #fff; font-size: 24px; font-weight: bold; border-bottom: none;">{{ __('Prijavi se') }}</div>

                <div class="card-body" style="background-color: rgba(255, 255, 255, 0.9); border-top: none;">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="font-size: 18px;">{{ __('E-Mail adresa') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror custom-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="font-size: 18px;">{{ __('Lozinka') }}</label>

                            <div class="col-md-6 input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror custom-input" name="password" required autocomplete="current-password">
                                <div class="input-group-append" style="cursor: pointer;" onclick="togglePasswordVisibility('password')">
                                    <span class="input-group-text" style="background-color: white; border-left: none; border-right: 1px solid #ced4da; height: calc(1.5em + .75rem + 2px);">
                                        <i class="fas fa-eye" id="togglePasswordIcon" style="height: 100%;"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
    <div class="col-md-6 offset-md-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember" style="font-size: 16px; color: rgba(52, 152, 219, 0.8);">
                {{ __('Zapamti me') }}
            </label>
        </div>
    </div>
</div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary custom-button">
                                    {{ __('Prijava') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="color: rgba(52, 152, 219, 0.8); font-size: 16px;">
                                        {{ __('Zaboravio/la si lozinku?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<script>
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        var toggleIconId = inputId === 'password' ? 'togglePasswordIcon' : 'toggleConfirmPasswordIcon';
        var toggleIcon = document.getElementById(toggleIconId);
        
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endsection
