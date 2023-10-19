@extends('layouts.sidemenu')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">{{ __('Page d\'accueil') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (auth()->user()->isAdmin())
                            <!-- Content only visible to admin -->
                            <p>Bonjour, {{ auth()->user()->name }}!</p>

                            <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a><br><br>
                            <a href="{{ url('commercial/accueil') }}">Menu pour les délégués</a><br><br>
                            <a href="{{ route('register') }}">Ajouter un admin</a><br><br>
                            <a href="{{ route('ajouter_commerciaux') }}">Ajouter un délégué</a>
                        @else
                            <!-- Content for non-admin users -->
                            <p>Bonjour, {{ auth()->user()->name }}!</p>
                            <a href="{{ url('commercial/accueil') }}">Deleguer Dashboard</a>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
