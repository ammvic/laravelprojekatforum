@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Izmeni korisnika</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Ime i prezime</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Npr.: Pregled Teme" value="{{ $user->name }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Lozinka</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Potvrdi lozinku</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>

                <div class="form-group">
                    <label>Uloge</label>
                    <select name="role" class="form-control">
                        <option value="">Izaberi ulogu korisnika</option>

                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" @if($user->role()->count() && $user->role->id == $role->id) selected @endif>{{ $role->name }}</option>
                        @endforeach

                    </select>
                </div>


                <div class="form-group">
                    <button class="btn btn-success">Ažuriraj korisnika</button>
                </div>
            </form>
        </div>
    </div>

@endsection
