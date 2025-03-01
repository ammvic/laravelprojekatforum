@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #3498db; color: #fff;">{{ __('Potvrdi registraciju') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('verifye', ['code' => $code]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="verification_code" class="col-md-4 col-form-label text-md-right">{{ __('Verifikacioni kod') }}</label>

                            <div class="col-md-6">
                                <input id="verification_code" type="text" class="form-control @error('verification_code') is-invalid @enderror" name="verification_code" required autofocus>

                                @error('verification_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #3498db; border-color: #3498db;">
                                    {{ __('Potvrdi registraciju') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
