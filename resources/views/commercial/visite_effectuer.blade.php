@extends('layouts.sidemenu')
@section('content')
    <div class="container card  col-6">
        <div class="row justify-content-center">
            <h5 class="card-header text-center text-primary">Ajouter une visite</h5>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="POST" action='{{ route('visite.submit') }}'>
                    {{ csrf_field() }}
                    <label>Identifiant</label>
                    <input type="text"class="form-control" name="Identifiant" /><br /><br />
                    <label>Date</label>
                    <input type="date"class="form-control" name="Date" /><br /><br />
                    <label>Durée</label>
                    <input type="number"class="form-control" name="Duree" /><br /><br />
                    <label>Client</label>
                    <select name="NumClient"class="form-control">
                        @foreach ($clients as $clt)
                            <option value="{{ $clt->NumClient }}">{{ $clt->NomClient }}</option>
                        @endforeach
                    </select><br /><br />
                    <label>Observation</label>
                    <textarea name="Observation"class="form-control"></textarea><br /><br />
                    <button type="submit" class="btn btn-success">Envoyer</button>
                </form>

            </div>
        </div>
    </div>
    <script>
        // Get Location button click event handler
        document.getElementById('getLocationButton').addEventListener('click', function() {
            // Check if Geolocation is supported by the browser
            if (navigator.geolocation) {
                // Use Geolocation API to get the current position
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Retrieve latitude and longitude from the position object
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // Set the values in the hidden input fields
                    document.getElementById('latitudeInput').value = latitude;
                    document.getElementById('longitudeInput').value = longitude;
                });
            } else {
                alert('Geolocation est pas supporter pour votre navigateur.');
            }
        });
    </script>
@endsection
