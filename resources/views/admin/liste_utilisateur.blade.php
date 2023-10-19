<!-- liste_utilisateur.blade.php -->
@extends('layouts.sidemenu')
@livewireStyles
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    {{-- <div class="container">
        <h1 class="mb-4">User List</h1>

        
        <div class="row">
            <div class="col-md-8">
                <h2>Admins</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registered At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-12">
                <h2>Commerciaux</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>CIN</th>
                                <th>NumCaGrise</th>
                                <th>Poste</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commerciaux as $commercial)
                                <tr>
                                    <td>{{ $commercial->user->name }}</td>
                                    <td>{{ $commercial->user->email }}</td>
                                    <td>{{ $commercial->CIN }}</td>
                                    <td>{{ $commercial->NumCaGrise }}</td>
                                    <td>{{ $commercial->Poste }}</td>      
                                    <td>
                                        <a href="{{ route('commercial.detail', $commercial->IDDelegue) }}" class="btn btn-success">Details</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('commercial.edit', $commercial->IDDelegue) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('commercial.destroy', $commercial->IDDelegue) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>
                            Liste des délégués
                        </h3>

                        <livewire:commercial-table />

                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
@endsection
