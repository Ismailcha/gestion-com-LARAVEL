@extends('layouts.sidemenu')
@livewireStyles

@section('content')
    {{-- <h1 class="text-center">Liste des Visites</h1>
    <a href="{{route('commercial.visite_effectuer')}}" class='badge bg-primary'>Ajouter une visite</a> --}}

    {{-- @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
 @endif --}}
    {{-- <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Date</th>
                    <th>Duree</th>
                    <th>NumClient</th>
                    <th>Observation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visites as $visite)
                    <tr>
                        <td>{{ $visite->Identifiant }}</td>
                        <td>{{ $visite->Date }}</td>
                        <td>{{ $visite->Duree }}</td>
                        <td>{{ $visite->NumClient }}</td>
                        <td>{{ $visite->Observation }}</td>
                        <td>
                            <a href="{{ route('visite.edit', ['id' => $visite->id]) }}" class="btn btn-primary">Modify</a>
                            <form action="{{ route('visite.delete', ['id' => $visite->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $visites->links() }}
        </div>
    </div> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-success">
                            Liste Visite
                        </h4>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <livewire:visite-table />
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
@endsection
