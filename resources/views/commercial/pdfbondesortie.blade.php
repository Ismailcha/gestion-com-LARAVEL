<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container">
    <div class=" justify-content-center">
        <div class="">
            <h5 class="mt-4 text-center text-primary">Bon de Commande </h5>
        </div>
        <div class="">
            <div class="row mt-4">
                <div class="col-md-6">
                    <h6><i>ID :</i> {{ $bonDeSortie->id }}</h6>
                    <h6><i>Client :</i> {{ $bonDeSortie->client->Prénom }}{{ $bonDeSortie->client->NomClient }}</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h6><i>Cree par : </i>{{ $bonDeSortie->commercial->name }}</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <h6><i>Adresse : </i>{{ $bonDeSortie->client->Adresse }} {{ $bonDeSortie->client->ville }}</h6>
                    <h6><i>Date : </i>{{ $bonDeSortie->Date }}</h6>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h6><i>Observations : </i>{{ $bonDeSortie->Observations }}</h6>
                </div>

            </div>
            <h4 class="mt-4 text-primary">Produits Associés :</h4>
            <table class="table table-bordered">
                <tr>
                    <th><i><u>Nom :</u></i> </th>
                    <th><i><u>Libellé :</u></i> </th>
                    <th><i><u>Prix :</u></i> </th>
                </tr>
                @foreach ($bonDeSortie->produits as $produit)
                    <tr>
                        <td>{{ $produit->Reference }}</td>
                        <td>{{ $produit->LibProd }}</td>
                        <td>{{ number_format($produit->PrixHT) }} MAD</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="2" class="text-right">THT</td>
                    <td>
                        <p>{{ number_format($bonDeSortie->TotalHT) }} MAD</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">TVA</td>
                    <td>
                        <p>20%</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">TTC</td>
                    <td>
                        <p>@php
                            $totalAfterDiscount = $bonDeSortie->TotalHT - $bonDeSortie->TotalHT * 0.2;
                        @endphp

                            {{ number_format($totalAfterDiscount) }} MAD
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <h6 class='text-center text-secondary'><u>Tous droits réservés Gestion délégué 2022-2023</u></h6>
</div>
