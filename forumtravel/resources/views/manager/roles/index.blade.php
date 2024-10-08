@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 d-flex justify-content-between align-items-center">
            <h2>Uloge korisnika</h2>
            <a href="{{ route('roles.create') }}" class="btn btn-success">Kreiraj ulogu</a>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ime</th>
                    <th>Kreirano</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
            @forelse($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}: <span class="badge badge-danger">{{ $role->role }}</span></td>
                    <td>{{ $role->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">IZMENI</a>
                            <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">UKLONI</button>
                            </form>
                            <a href="{{ route('roles.resources', $role->id) }}" class="btn btn-sm btn-dark">Dodaj Resurse</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nema kreiranih uloga!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $roles->links() }}
    </div>

@endsection
