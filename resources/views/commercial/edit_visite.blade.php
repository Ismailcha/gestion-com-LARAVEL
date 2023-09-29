@extends('layouts.sidemenu')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-center text-primary">Edit Visite</h3>
            </div>
            <div class="card-body">

                <form action="{{ route('visite.update', $visite->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="identifiant" class="form-label">Identifiant</label>
                        <input type="text" name="identifiant" id="identifiant" value="{{ $visite->Identifiant }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="client_id" class="form-label">Client</label>
                        <select name="client_id" id="client_id" class="form-control">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ $client->id == $visite->client_id ? 'selected' : '' }}>
                                    {{ $client->NomClient }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="text" name="date" id="date" value="{{ $visite->Date }}"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="duree" class="form-label">Duration</label>
                        <input type="text" name="duree" id="duree" value="{{ $visite->Duree }}"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="observation" class="form-label">Observation</label>
                        <textarea name="observation" id="observation" class="form-control">{{ $visite->Observation }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary confirmEdit">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
