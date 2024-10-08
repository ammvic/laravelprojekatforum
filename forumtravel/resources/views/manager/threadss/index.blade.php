@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Lista diskusija</h2>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naziv</th>
                    <th>Sadržaj</th>
                    <th>Kreiran</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
            @forelse($threads as $thread)
                <tr>
                    <td>{{ $thread->id }}</td>
                    <td>{{ $thread->title }}</td>
                    <td>{{ $thread->body }}</td>
                    <td>{{ $thread->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                        <div class="btn-group">
                        <form action="{{ route('threads.destroy', $thread->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">OBRIŠI</button>
                        </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nema dostupnih diskusija!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $threads->links() }}
    </div>
@endsection
