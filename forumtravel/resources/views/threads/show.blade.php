@extends('layouts.app')

<style>
    /* Stil za karticu diskusije */
    .card {
        background-color: #a6ff4d !important; /* Promenjena boja pozadine */
        border: 1px solid #dee2e6;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .card-header {
        background-color:#e6ffcc !important; /* Promenjena boja pozadine zaglavlja */
        color: #1a1a1a;
        border-bottom: none;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-header small {
        font-weight: bold;
    }

    .card-body {
        padding: 20px;
    }

    .card-footer {
        background-color: #e6ffcc !important;
        border-top: 1px solid #dee2e6;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    /* Stil za odgovore */
    .reply-card {
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .reply-card .card-body {
        padding: 15px;
    }

    .reply-card .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .reply-card .card-footer small {
        font-weight: bold;
    }
    .reply-card img {
        width: 100%; /* Postavljamo širinu slike na 100% roditeljskog elementa */
        height: 200px; /* Postavljamo fiksnu visinu slike */
        object-fit: cover; /* Ovo će osigurati da slika zauzima celu visinu, bez obzira na odnos širine i visine */
        border-radius: 10px; /* Dodajemo zaobljeni ivičnjak slici */
    }
</style>


@section('content')
<div class="row">
    <div class="col-12">
        <h2>{{ $thread->title }}</h2>
        @if(auth()->check() && auth()->user()->role_id == '6')
        <form action="{{ route('threads.follow', $thread) }}" method="post" class="mb-3">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary float-right">
                @if(auth()->user()->following($thread))
                    Otpratite diskusiju 😞
                @else
                    Zapratite diskusiju 😊
                @endif
            </button>
        </form>
        @endif
        <hr>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <small>Kreirao: <b>{{ $thread->user->name }}</b> pre: <b> {{ $thread->created_at->diffForHumans() }} </b> </small>
            </div>
            <div class="card-body">
                {{ $thread->body }}
            </div>
            <div class="card-footer">
                @can('update', $thread)
                <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.querySelector('form.thread-rm').submit();"> Ukloni </a>
                <form action="{{ route('threads.destroy1', $thread->slug) }}" class="thread-rm" method="post">
                    @csrf
                    @method('DELETE')
                </form>
                @endcan
            </div>
        </div>
        <hr>
    </div>
    <div class="col-12">
    @if($thread->replies->count())
    <div class="col-12">
        <h5>Odgovori:</h5>
        <hr>
        @foreach($thread->replies as $reply)
            <div class="card mb-3">
                <div class="card-body">
                    <p>{{ $reply->reply }}</p>
                    @if($reply->image)
                    <img src="{{ asset('storage/reply-images/' . $reply->image) }}" alt="Odgovor slika" class="img-fluid" style="max-width: 100%; height: 200px;">
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div>
                        <small>Odgovorio: {{ $reply->user->name }} pre: {{ $reply->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="reaction-buttons">
                        <!-- Dugmad za lajkovanje i dislajkovanje, prikazuju se samo prijavljenim korisnicima -->
                        @auth
                            <form action="{{ route('replies.like', $reply->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success mr-1" id="like-btn-{{ $reply->id }}" onclick="toggleLike({{ $reply->id }})">
                                    <span id="like-icon-{{ $reply->id }}">❤️</span>
                                    <span id="like-count-{{ $reply->id }}" class="ml-1">{{ $reply->reactions->where('type', 'like')->count() }}</span>
                                </button>
                            </form>
                            <form action="{{ route('replies.dislike', $reply->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger mr-1" id="dislike-btn-{{ $reply->id }}" onclick="toggleDislike({{ $reply->id }})">👎</button>
                                <span id="dislike-count-{{ $reply->id }}">{{ $reply->reactions->where('type', 'dislike')->count() }}</span>
                            </form>
                        @endauth
                        <!-- Kraj dugmadi -->
                        @if(auth()->check() && auth()->user()->id === $reply->user_id)
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteReply({{ $reply->id }})">Obriši odgovor</button>
                            <form id="delete-reply-form-{{ $reply->id }}" action="{{ route('replies.destroy', $reply->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <hr>
    </div>
    @endif
</div>

<div class="col-12">
    @auth
    <form action="{{ route('replies.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="hidden" name="thread_id" value="{{ $thread->id }}">
            <label for="reply">Odgovor:</label>
            <textarea name="reply" id="reply" cols="30" rows="3" class="form-control @error('reply') is-invalid @enderror">{{ old('reply') }}</textarea>
            @error('reply')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Izaberite sliku:</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" onchange="updateFileName()">
                    <label class="custom-file-label" for="image" id="image-label"><i class="fas fa-image"></i> Odaberite sliku</label>
                </div>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-sm btn-success" style="margin-top: 20px;">Odgovori</button>
    </form>
    @else
    <div class="col-12 text-center">
        <small>Morate biti prijavljeni da biste odgovorili na diskusiju ili ostavili reakciju na odgovore diskusije</small>
    </div>
    @endauth
</div>

</div>

<style>
    @keyframes heartBeat {
        0% {
            transform: scale(1);
        }
        25% {
            transform: scale(1.3);
        }
        50% {
            transform: scale(1);
        }
        75% {
            transform: scale(1.3);
        }
        100% {
            transform: scale(1);
        }
    }

    .heart-beat {
        animation: heartBeat 0.5s ease-in-out;
    }

    .reaction-buttons {
        display: flex;
        align-items: center;
    }

    .reaction-buttons form {
        display: flex;
        align-items: center;
    }

    .reaction-buttons form .btn {
        margin-right: 5px;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script>
    // Funkcija koja se poziva prilikom klika na dugme "Ukloni"
    function deleteReply(replyId) {
        // Pronalaženje forme za brisanje odgovora
        var form = document.getElementById('delete-reply-form-' + replyId);
        // Slanje zahteva za brisanje odgovora
        form.submit();
    }

    // Funkcija za promenu ikone srca i animaciju
    function toggleLike(replyId) {
        var likeButton = document.getElementById('like-btn-' + replyId);
        var likeIcon = document.getElementById('like-icon-' + replyId);
        
        // Dodajemo klasu za animaciju
        likeIcon.classList.add('heart-beat');

        // Simulacija animacije - nakon 0.5 sekundi uklanjamo klasu za animaciju
        setTimeout(function() {
            likeIcon.classList.remove('heart-beat');
        }, 500);
    }

    // Funkcija za promenu ikone dislajka
    function toggleDislike(replyId) {
        var dislikeButton = document.getElementById('dislike-btn-' + replyId);
        // Simulacija animacije - ikona dislajka menja boju
        dislikeButton.style.color = 'blue';
    }

    // Funkcija za ažuriranje oznake fajla nakon izbora slike
    function updateFileName() {
        var input = document.getElementById('image');
        var label = document.getElementById('image-label');
        var fileName = input.files[0].name;
        label.innerHTML = '<i class="fas fa-image"></i> ' + fileName;
    }
</script>

@endsection
