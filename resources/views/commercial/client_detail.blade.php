@extends('layouts.sidemenu')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $client->NomClient }} {{ $client->Prénom }}</h3>
                        <p class="card-text"><b>Pharmacie:</b> {{ $client->Pharmacie }}</p>
                        <p class="card-text"><b>Code Postal:</b> {{ $client->CodePostal }}</p>
                        <p class="card-text"><b>Adresse:</b> {{ $client->Adresse }}</p>
                        <p class="card-text"><b>Ville:</b> {{ $client->Ville }}</p>
                        <p class="card-text"><b>Pays:</b> {{ $client->Pays }}</p>
                        <p class="card-text"><b>Téléphone:</b> {{ $client->Telephone }}</p>
                        <p class="card-text"><b>Fax:</b> {{ $client->Fax }}</p>
                        <p class="card-text"><b>Email:</b> {{ $client->EMail }}</p>
                        <p class="card-text"><b>Type:</b> {{ $client->Type }}</p>
                        <p class="card-text"><b>Observations:</b> {{ $client->Observations }}</p>
                        <p class="card-text"><b>Plan:</b> {{ $client->Plan }}</p>

                        <div class="d-flex mt-3">
                            <form action="{{ route('client.destroy', ['NumClient' => $client->NumClient]) }}"
                                method="POST" class="mr-2">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger alertClass">Supprimer</button>
                            </form>
                            <a href="{{ route('commercial.edit_client', ['NumClient' => $client->NumClient]) }}"
                                class="btn btn-primary" style="margin-left: 5px;">Modifier</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
