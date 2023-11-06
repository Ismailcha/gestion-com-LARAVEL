@extends('layouts.sidemenu')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
    <div class="container">
        <div class="card">
            <h3 class="card-header text-center text-primary">Modifier Produit</h3>
            <div class="card-body">
                <form action="{{ route('commercial.produit.update', $produit->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="Photo" class="form-label">Photo</label>
                        @if ($produit->Photo)
                            <div>
                                <img src="{{ asset('storage/photos/' . $produit->Photo) }}" alt="Product Photo"
                                    class="img-thumbnail" id="productImagePreview" width="150">

                            </div>
                        @else
                            <p>Pas de photo</p>
                        @endif
                        <input type="file" name="Photo" class="form-control-file" id='productImage'>
                    </div>

                    <div class="mb-3">
                        <label for="Reference" class="form-label">Reference</label>
                        <input type="text" name="Reference" class="form-control" value="{{ $produit->Reference }}">
                    </div>

                    <div class="mb-3">
                        <label for="Numserie" class="form-label">Numserie</label>
                        <input type="text" name="Numserie" class="form-control" value="{{ $produit->Numserie }}">
                    </div>

                    <div class="mb-3">
                        <label for="LibProd" class="form-label">LibProd</label>
                        <input type="text" name="LibProd" class="form-control" value="{{ $produit->LibProd }}">
                    </div>

                    <div class="mb-3">
                        <label for="NumFournisseur" class="form-label">NumFournisseur</label>
                        <input type="text" name="NumFournisseur" class="form-control"
                            value="{{ $produit->NumFournisseur }}">
                    </div>

                    <div class="mb-3">
                        <label for="CodeBarre" class="form-label">CodeBarre</label>
                        <input type="text" name="CodeBarre" class="form-control" value="{{ $produit->CodeBarre }}">
                    </div>

                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea name="Description" class="form-control">{{ $produit->Description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="PrixHT" class="form-label">Prix hors taxe</label>
                        <input type="number" name="PrixHT" class="form-control" value="{{ $produit->PrixHT }}">
                    </div>

                    <div class="mb-3">
                        <label for="PrixAchatHT" class="form-label">Prix achat hors taxe</label>
                        <input type="number" name="PrixAchatHT" class="form-control" value="{{ $produit->PrixAchatHT }}">
                    </div>

                    <div class="mb-3">
                        <label for="PPCTTC" class="form-label">Prix vente ht</label>
                        <input type="number" name="PPCTTC" class="form-control" value="{{ $produit->PPCTTC }}">
                    </div>

                    <div class="mb-3">
                        <label for="PPHTTC" class="form-label">prix vente</label>
                        <input type="number" name="PPHTTC" class="form-control" value="{{ $produit->PPHTTC }}">
                    </div>

                    <div class="mb-3">
                        <label for="PGTTC" class="form-label">PGTTC</label>
                        <input type="number" name="PGTTC" class="form-control" value="{{ $produit->PGTTC }}">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 confirmEdit">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    $(document).ready(function() {
        $('#productImage').change(function() { // Update the ID here
            var input = this;
            var img = $('#productImagePreview')[0]; // Change the ID here too

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
