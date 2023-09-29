@extends('layouts.sidemenu')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css">
@section('content')
    <div class="container">
        <h1 class="mt-4">{{ $commercial->nomDel }}</h1>

        <div class="row">
            <div class="col-md-6">
                <p class="mt-3"><strong>User ID:</strong> {{ $commercial->user_id }}</p>
                <p><strong>CIN:</strong> {{ $commercial->CIN }}</p>
                <p><strong>CNSSDel:</strong> {{ $commercial->CNSSDel }}</p>
                <p><strong>Email:</strong> {{ $commercial->user->email }}</p>
                <p><strong>AdresseDel:</strong> {{ $commercial->AdresseDel }}</p>
                <p><strong>NumCaGrise:</strong> {{ $commercial->NumCaGrise }}</p>
            </div>
            <div class="col-md-6">
                <p class="mt-3"><strong>NumPC:</strong> {{ $commercial->NumPC }}</p>
                <p><strong>Poste:</strong> {{ $commercial->Poste }}</p>
                <p><strong>DateEmb:</strong> {{ $commercial->DateEmb }}</p>
                <p><strong>Qualié:</strong> {{ $commercial->Qualié }}</p>
                <p><strong>Affecaions:</strong> {{ $commercial->Affecaions }}</p>
            </div>
        </div>
        <td>
            <a href="{{ route('commercial.edit', $commercial->IDDelegue) }}" class="btn btn-primary">Modifier</a>
        </td>
        <td>
            <form action="{{ route('commercial.destroy', $commercial->IDDelegue) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger alertClass">Supprimer</button>
            </form>
        </td>
        <hr class="my-4">

        <!-- Display map with positions -->
        <div id="map" class="mt-4 p-3 border border-primary" style="height: 300px;"></div>
    </div>
    <!-- Include Leaflet library -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-numbered-markers/0.9.0/leaflet.numbereddivicon.min.js">
    </script>
    <!-- Load map and show positions -->
    <script>
        const positions = {!! json_encode($userLocations) !!};
    </script>
    <script src="{{ asset('js/map.js') }}"></script>
@endsection
