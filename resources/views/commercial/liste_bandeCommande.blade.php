@extends('layouts.sidemenu')
@livewireStyles
@section('content')
    {{-- <div class="container">
        <h1 class="text-center">Liste des bon de Sortie</h1>
        <a href="{{route('commercial.ajout_bandeCommande')}}" class='badge bg-primary'>Ajouter un bon de sortie</a>
        <table class="table">
            <thead>
                <tr>
                    <th>NumBS</th>
                    <th>DateBS</th>
                    <th>Date</th>
                    <th>TotalHT</th>
                    <th>Observations</th>
                    <th>Associated Products</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bandeSorties as $bandeSortie)
                    <tr>
                        <td>{{ $bandeSortie->NumBS }}</td>
                        <td>{{ $bandeSortie->DateBS }}</td>
                        <td>{{ $bandeSortie->Date }}</td>
                        <td>{{ $bandeSortie->TotalHT }} MAD</td>
                        <td>{{ $bandeSortie->Observations }}</td>
                        <td>
                            <ul>
                                @foreach ($bandeSortie->produits as $produit)
                                    <li>{{ $produit->Reference }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <form action="{{ route('bandeCommande.destroy', $bandeSortie->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('etes vous sur de supprimer ce bon de sortie ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-success">
                            Liste des bons des commandes
                        </h4>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <livewire:bande-commande-table />
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
@endsection
