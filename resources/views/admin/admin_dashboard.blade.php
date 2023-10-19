@extends('layouts.sidemenu')
@section('content')
    <div class="container">
        <h3 class='text-success text-center'>Admin dashboard</h3>
        <div class="cardBox">
            <a href='{{ route('admin.liste_utilisateur') }}'>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $commercials }}</div>
                        <div class="cardName">Total délégués</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>
            </a>

            <a href='{{ route('visite.index') }}'>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $visite }}</div>
                        <div class="cardName">Total Visites</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="clipboard-outline"></ion-icon>
                    </div>
                </div>
            </a>

            <a href='{{ route('bandeCommande.liste') }}'>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $bonDeSortie }}</div>
                        <div class="cardName">Total Bon de commande</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="folder-open-outline"></ion-icon>
                    </div>
                </div>
            </a>


            <a href='{{ route('produit.list') }}'>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $produit }}</div>
                        <div class="cardName">Total Produits</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="file-tray-stacked-outline"></ion-icon>
                    </div>
                </div>
            </a>

            <a href='{{ route('clients.index') }}'>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $client }}</div>
                        <div class="cardName">Total Client</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>
            </a>
        </div>
        @if ($mostSoldProductData || $mostProfitableProduct)
            <hr>
            <div class="container d-flex">
                @if ($mostSoldProductData)
                    <div class="card col-3 m-4">
                        <h6 class="card-header text-center text-success">le produit le plus vendu</h6>
                        <div class="card-body">
                            <p><i class="text-primary">Nom Produit </i>: {{ $mostSoldProductData['productName'] }}</p>
                            <p><i class="text-primary">Total quantité vendue </i>:
                                {{ $mostSoldProductData['totalQuantity'] }}</p>
                        </div>
                    </div>
                @endif
                @if ($mostProfitableProduct)
                    <div class="card col-3 m-4">
                        <h6 class="card-header text-center text-success">le produit le plus rentable</h6>
                        <div class="card-body">
                            <p><i class="text-primary">Nom Produit </i>: {{ $mostProfitableProduct['productName'] }}</p>
                            <p><i class="text-primary">Total vendu </i>:
                                {{ number_format($mostProfitableProduct['totalProfit']) }} DH</p>
                        </div>
                    </div>
                @endif

            </div>
        @endif
    </div>
    </div>
@endsection
