@extends('layouts.sidemenu')

@section('content')
    <div class='container'>

        <div class="card">
            <div class="card-header text-center text-primary">
                Modifier client
            </div>
            <div class="card-body">
                <form action="{{ route('commercial.client.update', $client->NumClient) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="NomClient">Nom Client</label>
                        <input type="text" name="NomClient" class="form-control" value="{{ $client->NomClient }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Prénom">Prénom Client</label>
                        <input type="text" name="Prénom" class="form-control" value="{{ $client->Prénom }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Pharmacie">Pharmacie</label>
                        <input type="text" name="Pharmacie" class="form-control" value="{{ $client->Pharmacie }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="CodePostal">Code Postal</label>
                        <input type="text" name="CodePostal" class="form-control" value="{{ $client->CodePostal }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="Adresse">Adresse</label>
                        <input type="text" name="Adresse" class="form-control" value="{{ $client->Adresse }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Ville">Ville</label>
                        <input type="text" name="Ville" class="form-control" value="{{ $client->Ville }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Pays">Pays</label>
                        <input type="text" name="Pays" class="form-control" value="{{ $client->Pays }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Telephone">Téléphone</label>
                        <input type="text" name="Telephone" class="form-control" value="{{ $client->Telephone }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="Fax">Fax</label>
                        <input type="text" name="Fax" class="form-control" value="{{ $client->Fax }}" required>
                    </div>

                    <div class="form-group">
                        <label for="EMail">Email</label>
                        <input type="email" name="EMail" class="form-control" value="{{ $client->EMail }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Type">Type</label>
                        <input type="text" name="Type" class="form-control" value="{{ $client->Type }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Observations">Observations</label>
                        <textarea name="Observations" class="form-control" required>{{ $client->Observations }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="Plan">Plan</label>
                        <input type="text" name="Plan" class="form-control" value="{{ $client->Plan }}" required>
                    </div>

                    <button type="submit" class="btn btn-success mt-2 confirmEdit">Modifier</button>
                </form>
            </div>
        </div>

    </div>
@endsection
