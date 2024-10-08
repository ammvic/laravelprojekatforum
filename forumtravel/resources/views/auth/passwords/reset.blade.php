@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: rgba(52, 152, 219, 0.8); color: #fff; font-size: 24px; font-weight: bold; border-bottom: none;">{{ __('Resetuj lozinku') }}</div>

                <div class="card-body" style="background-color: rgba(255, 255, 255, 0.9); border-top: none;">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="font-size: 18px;">{{ __('E-Mail adresa') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror custom-input" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror custom-input" name="password" required autocomplete="new-password">
                                <div class="input-group-append" style="cursor: pointer;">
                                    <span class="input-group-text" onclick="togglePasswordVisibility('password')">
                                        <i class="fas fa-eye" id="togglePasswordIcon"></i>
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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style="font-size: 18px;">{{ __('Potvrdi lozinku') }}</label>

                            <div class="col-md-6 input-group">
                                <input id="password-confirm" type="password" class="form-control custom-input" name="password_confirmation" required autocomplete="new-password">
                                <div class="input-group-append" style="cursor: pointer;">
                                    <span class="input-group-text" onclick="togglePasswordVisibility('password-confirm')">
                                        <i class="fas fa-eye" id="toggleConfirmPasswordIcon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary custom-button">
                                    {{ __('Resetuj lozinku') }}
                                </button>
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
