@extends('layouts.app')

<style>
    /* Stil za listu diskusija */
    .list-group {
        background-color: #99ff99; /* boja pozadine */
        border-radius: 5px; /* zaobljeni rubovi */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* senka */
    }

    /* Stil za pojedinačnu stavku diskusije */
    .list-group-item {
        border: none; /* uklanja ivicu */
        padding: 20px; /* dodajemo padding */
        background-color: #a6ff4d !important; /* dodajemo boju pozadine */
        transition: all 0.3s ease; /* animacija pri promjeni */
    }

    .list-group-item:hover {
        background-color: #b3e6b3 !important; /* boja pozadine na hover */
    }

    .list-group-item h5 {
        margin-bottom: 5px; /* dodajemo razmak ispod naslova */
    }

    .list-group-item small {
        color: #6c757d; /* boja teksta */
    }

    .list-group-item .badge {
        margin-left: 10px; /* dodajemo razmak između badge-a i ostatka sadržaja */
    }

    /* Stil za dugme "Stvori novu diskusiju" */
    .btn-primary {
        background-color: #007bff; /* boja pozadine */
        border-color: #007bff; /* boja ivice */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* boja pozadine na hover */
        border-color: #0056b3; /* boja ivice na hover */
    }

    /* Stil za modal */
    #cookie-modal {
        display: none; /* Početno sakrivanje modala */
        position: fixed; /* Fiksni položaj */
        z-index: 9999; /* Visoki z-index da prekrije ostatak stranice */
        left: 0;
        bottom: 0; /* Prikazuje modalni prozor na dnu stranice */
        width: 100%;
        height: auto; /* Visina se automatski prilagođava sadržaju */
        background-color: rgba(0, 0, 0, 0.5); /* Poluprozirna pozadina */
        padding: 20px; /* Dodajemo malo prostora oko sadržaja */
        box-sizing: border-box; /* Uključujemo padding u širinu i visinu */
    }

    /* Stil za modalni sadržaj */
    .modal-content {
        background-color:#e6ffcc; /* Boja pozadine */
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Senka */
    }

    /* Stil za dugmad u modalnom prozoru */
    .modal-buttons {
        text-align: center; /* Centriranje sadržaja */
        margin-top: 20px; /* Margina iznad dugmadi */
    }

    .modal-buttons button {
        margin: 0 10px; /* Margine između dugmadi */
        padding: 10px 20px; /* Dimenzije dugmadi */
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Stil za dugme "Prihvatam" */
    #accept-cookies {
        background-color: #28a745; /* Zelena boja */
        color: white; /* Bela boja teksta */
    }

    /* Stil za dugme "Ne prihvatam" */
    #reject-cookies {
        background-color: #dc3545; /* Crvena boja */
        color: white; /* Bela boja teksta */
    }
</style>

@section('content')
<div class="row">
    <div class="col-12">
        <h2> Diskusije </h2>
        <hr>
    </div>
    <div class="col-12">
        @auth
            @if (Auth::user()->role_id == '7')
                <a href="{{ route('threads.create') }}" class="btn btn-primary mb-3">Stvori novu diskusiju</a>
            @endif
        @endauth

        @forelse($threads as $thread)
        <div class="list-group my-3">
            <!-- Dodali smo my-3 za razmak između diskusija -->
            <a href="{{ route('threads.show', $thread->slug) }}"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <h5> {{ $thread->title }} </h5>
                    <small> Kreirao: <b>{{ $thread->user->name }}</b> pre:
                        {{ $thread->created_at->diffForHumans() }}</small>
                    <span class="badge badge-primary"> {{ $thread->channel->name }} </span>
                </div>
                <span class="badge badge-warning badge-pill"> {{ $thread->replies->count() }} </span>
            </a>
        </div>
        @empty
        <div class="alert alert-warning">
            Nema pronađenih diskusija!
        </div>
        @endforelse

        {{ $threads->links() }}
    </div>
</div>


<!-- Modal za prihvatanje kolačića -->
@if (Auth::check())
<div id="cookie-modal" class="modal fixed-bottom" tabindex="-1" role="dialog">
        <div class="modal-dialog"  style="backgorund-color:#e6ffcc" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Prihvatanje kolačića</h5>
                    <button type="button" class="close" id="close-modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="backgorund-color:#e6ffcc">
                    <p>Ovaj sajt koristi kolačiće kako bi vam pružio bolje korisničko iskustvo. Da li prihvatate korišćenje
                        kolačića?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="accept-cookies" class="btn btn-success">Prihvatam</button>
                    <button type="button" id="reject-cookies" class="btn btn-danger">Ne prihvatam</button>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    // Prikazivanje modalnog prozora nakon 10 sekundi
    setTimeout(function() {
        var modal = document.getElementById('cookie-modal');
        modal.style.display = 'block';
    }, 5000); // 4 sekundi

    document.getElementById('accept-cookies').onclick = function() {
        console.log("Kliknuto na Prihvati kolačiće");
        localStorage.setItem('cookiesAccepted', true);
        var modal = document.getElementById('cookie-modal');
        modal.style.display = 'none';
    };

    document.getElementById('reject-cookies').onclick = function() {
        console.log("Kliknuto na Odbij kolačiće");
        var modal = document.getElementById('cookie-modal');
        modal.style.display = 'none';
    };
    document.getElementById('close-modal').onclick = function() {
            var modal = document.getElementById('cookie-modal');
            modal.style.display = 'none';
        };
</script>
@endsection
