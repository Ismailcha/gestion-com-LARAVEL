@extends('layouts.sidemenu')
@livewireStyles
@section('content')
    {{-- <h1 class="text-center">Product List</h1>
    <a href="{{route('commercial.produit')}}" class='badge bg-primary'>Ajouter un produit</a>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
 @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Reference</th>
                <th>Numserie</th>
                <th>LibProd</th>
                <th>NumFournisseur</th>
                <th>Photo</th>
                <th>CodeBarre</th>
                <th>PrixHT</th>
                <th>PrixAchatHT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Products as $Product)
            <tr>
                <td>{{ $Product->Reference }}</td>
                <td>{{ $Product->Numserie }}</td>
                <td>{{ $Product->LibProd }}</td>
                <td>{{ $Product->NumFournisseur }}</td>
                <td><img src="{{ $Product->Photo }}" alt="photoProduit" width='120px'/></td>
                <td>{{ $Product->CodeBarre }}</td>
                <td>{{ $Product->PrixHT }}</td>
                <td>{{ $Product->PrixAchatHT }}</td>
            <td>
                <a href="{{ route('produit.edit', $Product->id) }}" class="btn btn-primary">Modifier</a>
            </td>
                <td>
                <form action="{{ route('produit.delete', $Product->id) }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-1">
        {{ $Products->links('layouts.pagination') }}
    </div> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-success">
                            Liste Produit
                            </h3>
                            <livewire:produit-table />
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
@endsection
