@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: rgba(52, 152, 219, 0.8); color: #fff; font-size: 24px; font-weight: bold; border-bottom: none;">{{ __('Registruj se') }}</div>

                <div class="card-body" style="background-color: rgba(255, 255, 255, 0.9); border-top: none;">
                    <form id="registrationForm" method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style="font-size: 18px;">{{ __('Ime') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror custom-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="font-size: 18px;">{{ __('E-Mail adresa') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror custom-input" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style="font-size: 18px;">{{ __('Potvrdi lozinku') }}</label>

                            <div class="col-md-6 input-group">
                                <input id="password-confirm" type="password" class="form-control custom-input" name="password_confirmation" required autocomplete="new-password">
                                <div class="input-group-append" style="cursor: pointer;" onclick="togglePasswordVisibility('password-confirm')">
                                    <span class="input-group-text" style="background-color: white; border-left: none; border-right: 1px solid #ced4da; height: calc(1.5em + .75rem + 2px);">
                                        <i class="fas fa-eye" id="toggleConfirmPasswordIcon" style="height: 100%;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="registerButton" type="button" class="btn btn-primary custom-button" style="background-color: rgba(52, 152, 219, 0.8); border-color: rgba(52, 152, 219, 0.8);">
                                    {{ __('Registracija') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Forma za unos verifikacionog koda -->
                    <div id="verificationFormContainer" style="display: none;">
                        <form id="verificationForm" method="POST" action="{{ route('verify.code') }}" class="needs-validation" novalidate>
                            @csrf

                            <div class="form-group row">
                                <label for="verification_code" class="col-md-4 col-form-label text-md-right">{{ __('Verifikacioni kod') }}</label>

                                <div class="col-md-6">
                                    <input id="verification_code" type="text" class="form-control" name="verification_code" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="background-color: rgba(52, 152, 219, 0.8); border-color: rgba(52, 152, 219, 0.8);">
                                        {{ __('Potvrdi') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Kraj forme za unos verifikacionog koda -->

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
    
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('registerButton').addEventListener('click', function() {
            // Sakrijemo formu za registraciju
            document.getElementById('registrationForm').style.display = 'none';
            // Prikazemo formu za unos koda
            document.getElementById('verificationFormContainer').style.display = 'block';
            // Postavimo akciju forme za unos koda da pokazuje na odgovarajuću rutu za proveru koda
            document.getElementById('verificationForm').action = "{{ route('verify.code') }}";
            
            // Pošaljemo AJAX zahtev da pošaljemo verifikacioni kod
            fetch("{{ route('register') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    password_confirmation: document.getElementById('password-confirm').value
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Greška prilikom slanja verifikacionog koda');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('Greška:', error);
            });
        });
    });
</script>
@endsection
