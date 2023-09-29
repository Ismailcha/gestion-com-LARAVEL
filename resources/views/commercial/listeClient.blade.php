@extends('layouts.sidemenu')
@livewireStyles
@section('content')
    {{-- 
    <div class="container">
        
    <h1 class="text-center">Liste clients</h1>
    <a href="{{route('commercial.ajout_client')}}" class='badge bg-primary'>Ajouter un client</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pharmacie</th>
                    <th>Nom Client</th>
                    <th>Prénom</th>
                    <th>Ville</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->Pharmacie }}</td>
                    <td>{{ $client->NomClient }}</td>
                    <td>{{ $client->Prénom }}</td>
                    <td>{{ $client->Ville }}</td>
                    <td>{{ $client->Telephone }}</td>
                    <td>{{ $client->EMail }}</td>
                    <td>
                        <a href="{{ route('client.detail', $client->NumClient) }}" class="btn btn-success">Detail</a>
                    </td>
                    <td>
                        <a href="{{ route('commercial.edit_client', ['NumClient' => $client->NumClient]) }}" class="btn btn-primary">Modify</a>
                    </td>
                    <td>
                        <form action="{{ route('client.destroy', $client->NumClient) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-1">
            {{ $clients->links('layouts.pagination') }}
        </div>
        
        
    </div> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-success">
                            Liste Client
                        </h4>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <livewire:client-table />

                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
@endsection
