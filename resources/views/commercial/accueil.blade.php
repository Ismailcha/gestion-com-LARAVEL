@extends('layouts.sidemenu')

@section('content')
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-md-8">
                <h4 class="text-muted"r>{{ Auth::user()->name }}</h4>
                <div class="card">

                    <h5 class="card-header text-center text-primary">Menu</h5>
                    <div class="card-body">
                        <h6 class="text-success"><u>Ajout :</u></h6>
                        <br>
                        <a href="{{ route('commercial.produit') }}" class="text-primary">Ajouter un produit</a><br><br>
                        <a href="{{ route('commercial.visite_effectuer') }}"class="text-primary">Ajouter une visite
                            effectuée</a><br><br>
                        <a href="{{ route('commercial.ajout_client') }}"class="text-primary">Ajouter un client</a><br><br>
                        <a href="{{ route('commercial.ajout_bandeCommande') }}"class="text-primary">Ajouter un bon de
                            commande</a><br><br>
                        <h6 class="text-success"><u>Listes :</u></h6>
                        <br>
                        <a href="{{ route('clients.index') }}"class="text-primary">Liste des clients</a><br><br>
                        <a href="{{ route('bandeCommande.liste') }}"class="text-primary">Liste des bons de
                            commandes</a><br><br>
                        <a href="{{ route('visite.index') }}"class="text-primary">Liste des visites</a><br><br>
                        <a href="{{ route('produit.list') }}"class="text-primary">Liste des produits</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
