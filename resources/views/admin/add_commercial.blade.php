@extends('layouts.sidemenu')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <h3 class="card-header text-center text-primary">Ajouter un Commercial</h3>
            <div class="card-body">
                <form action="{{ route('commerciaux.store') }}" method="POST" class="row g-3">
                    @csrf
                    <input type="hidden" name="role" value="0">
                    <div class="col-md-6">
                        <label for="nomDel" class="form-label">Nom Del:</label>
                        <input type="text" class="form-control" name="nomDel" id="nomDel" required>
                    </div>
                    <div class="col-md-6">
                        <label for="CIN" class="form-label">CIN:</label>
                        <input type="text" class="form-control" name="CIN" id="CIN" required>
                    </div>
                    <div class="col-md-6">
                        <label for="CNSSDel" class="form-label">CNSS Del:</label>
                        <input type="text" class="form-control" name="CNSSDel" id="CNSSDel" required>
                    </div>
                    <div class="col-md-6">
                        <label for="AdresseDel" class="form-label">Adresse Del:</label>
                        <input type="text" class="form-control" name="AdresseDel" id="AdresseDel" required>
                    </div>
                    <div class="col-md-6">
                        <label for="NumCaGrise" class="form-label">Num Carte Grise:</label>
                        <input type="text" class="form-control" name="NumCaGrise" id="NumCaGrise" required>
                    </div>
                    <div class="col-md-6">
                        <label for="NumPC" class="form-label">Num PC:</label>
                        <input type="text" class="form-control" name="NumPC" id="NumPC" required>
                    </div>
                    <div class="col-md-6">
                        <label for="Poste" class="form-label">Poste:</label>
                        <input type="text" class="form-control" name="Poste" id="Poste" required>
                    </div>
                    <div class="col-md-6">
                        <label for="DateEmb" class="form-label">Date Emb:</label>
                        <input type="date" class="form-control" name="DateEmb" id="DateEmb" required>
                    </div>
                    <div class="col-md-6">
                        <label for="Qualié" class="form-label">Qualié:</label>
                        <input type="text" class="form-control" name="Qualié" id="Qualié" required>
                    </div>
                    <div class="col-md-6">
                        <label for="Affecaions" class="form-label">Affecaions:</label>
                        <input type="text" class="form-control" name="Affecaions" id="Affecaions" required>
                    </div>
                    <div class="col-md-12">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Cree Commerciaux</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
