@extends('layouts.sidemenu')

@section('content')
    <div class="container card col-6">
        <div class="row justify-content-center">
            <h5 class="card-header text-center text-primary">Ajouter un client</h5>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('client.store') }}" method="POST">
                @csrf

                <label for="Pharmacie">Pharmacie</label>
                <input type="text"class="form-control" name="Pharmacie" id="Pharmacie" required><br><br>

                <label for="CodePostal">Code Postal</label>
                <input type="number"class="form-control" name="CodePostal" id="CodePostal" required><br><br>

                <label for="NomClient">Nom Client</label>
                <input type="text"class="form-control" name="NomClient" id="NomClient" required><br><br>

                <label for="Prénom">Prénom</label>
                <input type="text"class="form-control" name="Prénom" id="Prénom" required><br><br>

                <label for="Adresse">Adresse</label>
                <input type="text"class="form-control" name="Adresse" id="Adresse" required><br><br>

                <label for="Ville">Ville</label>
                <input type="text"class="form-control" name="Ville" id="Ville" required><br><br>

                <label for="Pays">Pays</label>
                <input type="text"class="form-control" name="Pays" id="Pays" required><br><br>

                <label for="Telephone">Telephone</label>
                <input type="tel"class="form-control" name="Telephone" id="Telephone" required><br><br>

                <label for="Fax">Fax</label>
                <input type="tel"class="form-control" name="Fax" id="Fax" required><br><br>

                <label for="EMail">E-mail</label>
                <input type="email"class="form-control" name="EMail" id="EMail" required><br><br>

                <label for="Type">Type</label>
                <input type="text"class="form-control" name="Type" id="Type" required><br><br>

                <label for="Observations">Observations</label>
                <textarea name="Observations"class="form-control" id="Observations"></textarea><br><br>

                <label for="Plan">Plan</label>
                <input type="text"class="form-control" name="Plan" id="Plan" required><br><br>

                <button type="submit" class="btn btn-success">Envoyer</button>
            </form>
        </div>
    </div>
@endsection
