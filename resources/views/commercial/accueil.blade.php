@extends('layouts.sidemenu')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header text-center text-primary">Outil de commercial</h5>
                    <div class="card-body">
                        <h6 class="text-success"><u>Ajout :</u></h6>
                        <br>
                        <a href="{{ route('commercial.produit') }}" class="text-secondary">Ajouter un produit</a><br><br>
                        <a href="{{ route('commercial.visite_effectuer') }}"class="text-secondary">Ajouter une visite
                            effectuée</a><br><br>
                        <a href="{{ route('commercial.ajout_client') }}"class="text-secondary">Ajouter un client</a><br><br>
                        <a href="{{ route('commercial.ajout_bandeCommande') }}"class="text-secondary">Ajouter une bon de
                            commandes</a><br><br>
                        <h6 class="text-success"><u>Listes :</u></h6>
                        <br>
                        <a href="{{ route('clients.index') }}"class="text-secondary">Liste des clients</a><br><br>
                        <a href="{{ route('bandeCommande.liste') }}"class="text-secondary">Liste des bons de
                            commandes</a><br><br>
                        <a href="{{ route('visite.index') }}"class="text-secondary">Liste des visites</a><br><br>
                        <a href="{{ route('produit.list') }}"class="text-secondary">Liste des produits</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
