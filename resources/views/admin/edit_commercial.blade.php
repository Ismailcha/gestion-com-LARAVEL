@extends('layouts.sidemenu')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class=" mt-4 row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3 class="card-header text-center text-primary">Edit Delegue</h3>
                    <div class="card-body">
                        <form action="{{ route('commercial.update', $commercial->IDDelegue) }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="role" value="0">

                            <div class="col-md-6">
                                <label for="nomDel" class="form-label">Nom Delegue:</label>
                                <input type="text" class="form-control" name="nomDel" id="nomDel"
                                    value="{{ $commercial->nomDel }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="CIN" class="form-label">CIN:</label>
                                <input type="text" class="form-control" name="CIN" id="CIN"
                                    value="{{ $commercial->CIN }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="CNSSDel" class="form-label">CNSS Delegue:</label>
                                <input type="text" class="form-control" name="CNSSDel" id="CNSSDel"
                                    value="{{ $commercial->CNSSDel }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="AdresseDel" class="form-label">Adresse Delegue:</label>
                                <input type="text" class="form-control" name="AdresseDel" id="AdresseDel"
                                    value="{{ $commercial->AdresseDel }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="NumCaGrise" class="form-label">Numero Carte Grise:</label>
                                <input type="text" class="form-control" name="NumCaGrise" id="NumCaGrise"
                                    value="{{ $commercial->NumCaGrise }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="NumPC" class="form-label">Numero PC:</label>
                                <input type="text" class="form-control" name="NumPC" id="NumPC"
                                    value="{{ $commercial->NumPC }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="Poste" class="form-label">Poste:</label>
                                <input type="text" class="form-control" name="Poste" id="Poste"
                                    value="{{ $commercial->Poste }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="DateEmb" class="form-label">Date Emb:</label>
                                <input type="date" class="form-control" name="DateEmb" id="DateEmb"
                                    value="{{ $commercial->DateEmb }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="Qualié" class="form-label">Qualité:</label>
                                <input type="text" class="form-control" name="Qualié" id="Qualié"
                                    value="{{ $commercial->Qualié }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="Affecaions" class="form-label">Affectations:</label>
                                <input type="text" class="form-control" name="Affecaions" id="Affecaions"
                                    value="{{ $commercial->Affecaions }}" required>
                            </div>

                            <div class="col-md-12">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $commercial->user->email }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation"
                                    class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success confirmEdit">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
