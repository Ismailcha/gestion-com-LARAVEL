@extends('layouts.sidemenu')

@section('content')
    <div class="container card  col-6">
        <div class="row justify-content-center">
            <h5 class="card-header text-center text-primary">Ajouter un produit</h5>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method='post' action='{{ route('produit.submit') }}' enctype="multipart/form-data" runat="server">
                {{ csrf_field() }}
                <label>Reference</label>
                <input type="text"class="form-control" name="Reference" /><br /><br />
                <label>Numserie</label>
                <input type="number"class="form-control" name="Numserie" /><br /><br />
                <label>LibProd</label>
                <input type="text"class="form-control" name="LibProd" /><br /><br />
                <label>NumFournisseur</label>
                <input type="number"class="form-control" name="NumFournisseur" /><br /><br />
                <label>CodeBarre</label>
                <input type="text"class="form-control" name="CodeBarre" /><br /><br />

                <label>Photo</label>
                <input accept="image/*" type='file' id="imgInp" class="form-control" name="Photo" />

                <img id="blah" src="#" alt='image de votre produit' width="90px" />

                <br /><br />

                <label>Prix HT</label>
                <input type="text"class="form-control" name="PrixHT" /><br /><br />
                <label>Prix Achat HT</label>
                <input type="text"class="form-control" name="PrixAchatHT" /><br /><br />
                <label>Prix vente ht</label>
                <input type="text"class="form-control" name="PPCTTC" /><br /><br />
                <label>Prix vente</label>
                <input type="text"class="form-control" name="PPHTTC" /><br /><br />
                <label>PGTTC</label>
                <input type="text"class="form-control" name="PGTTC" /><br /><br />
                <button type="submit" class="btn btn-success"> Envoyer </button>
            </form>
        </div>
    </div>
@endsection
<script>
    // Wait for the document to fully load
    document.addEventListener("DOMContentLoaded", function() {
        var imgInp = document.querySelector('#imgInp');
        var blah = document.querySelector('#blah');

        imgInp.onchange = function(evt) {
            const [file] = imgInp.files;
            if (file) {
                blah.src = URL.createObjectURL(file);
            }
        };
    });
</script>
