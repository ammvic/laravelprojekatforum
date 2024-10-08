@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-12">
      <h2> Uredi diskusiju </h2> <hr>
    </div>
    <div class="col-12">
    <form action="{{ route('threads.edit', $thread->slug) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="form-group">
        <label for="title"> Naslov diskusije: </label>
        <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $thread->title }}">
          @error('title') 
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-group">
        <label for="body"> Sadržaj diskusije: </label>
        <textarea id="body" name="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{ $thread->body }}</textarea>
          @error('body') 
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <button type="submit" class="btn btn-large btn-success">Ažuriraj</button>
      </form>
    </div>
  </div>
@endsection
