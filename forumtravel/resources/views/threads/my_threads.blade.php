@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Moje diskusije</h2>
            <hr>
            @if ($threads->count() > 0)
                <ul class="list-group">
                    @foreach ($threads as $thread)
                        <li class="list-group-item" style="background-color: #a6ff4d; border: 1px solid #dee2e6; border-radius: 10px; margin-bottom: 10px;">
                            <a href="{{ route('threads.show', $thread->slug) }}" style="text-decoration: none; color: #1a1a1a; font-weight: bold;">{{ $thread->title }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-3">
                    {{ $threads->links() }}
                </div>
            @else
                <p style="background-color: #a6ff4d; border: 1px solid #dee2e6; border-radius: 10px; padding: 10px;">Nemate zapraćenih diskusija.</p>
            @endif
        </div>
    </div>
@endsection
