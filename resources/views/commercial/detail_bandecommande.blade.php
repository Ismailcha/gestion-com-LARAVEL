@extends('layouts.sidemenu')

@section('content')
    <div class="container">
        <div class="card justify-content-center">
            <div class="card-header">
                <h3 class="mt-4 text-center text-primary">Bon de Commande Details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Cree par</th>
                            <th>Date</th>
                            <th>TotalHT</th>
                            <th>Observations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $bonDeSortie->id }}</td>
                            <td><a
                                    href="{{ route('client.detail', ['NumClient' => $bonDeSortie->client->NumClient]) }}">{{ $bonDeSortie->client->NomClient }}</a>
                            </td>
                            <td>{{ $bonDeSortie->commercial->name }}</td>
                            <td>{{ $bonDeSortie->Date }}</td>
                            <td>{{ number_format($bonDeSortie->TotalHT) }}DH</td>
                            <td>{{ $bonDeSortie->Observations }}</td>

                        </tr>
                    </tbody>
                </table>
                <h4 class="mt-4 text-primary">Produits Associés :</h4>
                <ol>
                    @foreach ($bonDeSortie->produits as $produit)
                        <li>
                            <i><u>Nom :</u></i> {{ $produit->Reference }} <br>
                            <i><u>Libellé :</u></i> {{ $produit->LibProd }}<br>
                            <i><u>Prix/u :</u></i> {{ number_format($produit->PrixHT) }} DH
                        </li><br>
                    @endforeach
                </ol>
                <div class="m-4 text-center">
                    <a href="{{ route('generate.pdf', ['id' => $bonDeSortie->id]) }}" target="_blank"
                        class="btn btn-success text-light">
                        Imprimer
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
