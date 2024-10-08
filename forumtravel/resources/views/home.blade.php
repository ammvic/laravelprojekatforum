@extends('layouts.app')

@section('content')
<style>
    /* Stil za sakrivanje navbar-a */
    nav {
        display: none !important;
    }
    /* Stilizacija kontejnera */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80%;
    }

    /* Stilizacija kartice */
    .card {
        width: 80%;
        background-color: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 40px;
    }

    /* Stilizacija naslova */
    .card-header {
        background-color: #3498db;
        color: #fff;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        border-radius: 10px;
        padding: 20px;
    }

    /* Stilizacija paragrafa */
    .card-body p {
        font-size: 1.2rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    /* Stilizacija liste */
    .card-body ul {
        margin-bottom: 10px;
        padding: 0;
    }

    /* Stilizacija linkova */
    .card-body a {
        color: #3498db;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    /* Stilizacija linkova na hover */
    .card-body a:hover {
        color: #1e87cc;
    }
</style>
<body style="background-image: url('/images/blog-6.jpg'); background-size: cover;">
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Osnovne informacije o Travel Forumu') }}</div>

        <div class="card-body">
            <p>Dobrodošli na naš Travel Forum, zajednicu za ljubitelje putovanja gde možete deliti svoja iskustva, savete i preporuke!</p>
            <p>Učlanite se kako biste uživali u svim prednostima foruma:</p>
            <ul>
                <li>Postavljajte pitanja i delite iskustva sa drugim putnicima.</li>
                <li>Otkrijte nove destinacije i dobijte korisne savete za putovanja.</li>
                <li>Povežite se sa istomišljenicima i pronađite putne partnere.</li>
            </ul>
            <p>Molimo vas <a href="{{ route('login') }}">prijavite se</a> ili se <a href="{{ route('register') }}">registrujte</a> i započnite svoje putovanje zajedno sa nama!</p>
            <p>Naš forum nudi raznolike teme vezane za putovanja, uključujući:</p>
            <ul>
                <li>Saveti za solo putovanja.</li>
                <li>Iskustva sa putovanja sa porodicom.</li>
                <li>Preporuke za avanturistička putovanja.</li>
                <li>Kulturna otkrića i gastronomske avanture.</li>
            </ul>
        </div>
    </div>
</div>
</body>
@endsection
