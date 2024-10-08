@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: rgba(52, 152, 219, 0.8); color: #fff;">{{ __('Potvrdite svoju email adresu') }}</div>

                <div class="card-body" style="background-color: rgba(255, 255, 255, 0.9);">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Na vašu email adresu je poslat novi link za potvrdu') }}
                        </div>
                    @endif

                    <p style="font-size: 16px; color: #333;">{{ __('Pre nego što nastavite, molimo vas da proverite svoj email za link za potvrdu.') }}</p>
                    <p style="font-size: 16px; color: #333;">{{ __('Ako niste primili email') }},</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline" style="font-size: 16px; color: rgba(52, 152, 219, 0.8);">{{ __('kliknite ovde da biste zatražili još jedan.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
