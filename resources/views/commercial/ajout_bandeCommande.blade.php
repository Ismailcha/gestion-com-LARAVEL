@extends('layouts.sidemenu')

@section('content')
    <div class="container card col-6">
        <div class="row justify-content-center">
            <h5 class="card-header text-center text-primary">Bon de commande</h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('bandeCommande.store') }}" method="POST">
                @csrf

                <input type="hidden" class="form-control" inputmode="numeric" pattern="\d*" name="commercial_id"
                    value="{{ auth()->user()->id }}" readonly />

                <label for="client_id">Client</label>
                <select name="client_id" class="form-control">
                    <option value="">Choisir un client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->NumClient }}">{{ $client->NomClient }}</option>
                    @endforeach
                </select><br /><br />


                <label for='Date'>Date</label>
                <input type="date" class="form-control" name="Date" /><br /><br />

                <label for="products">Produits:</label><br />
                <div id="product-container">
                    <table class="table table-bordered table-hover" id="dynamic_field_1">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Numserie</th>
                                <th>Prix</th>
                                <th>Quantite</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="products[0][product_id]" class="form-control product-select">
                                        <option value="">Choisir un produit</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-numserie="{{ $product->Numserie }}"
                                                data-prixht="{{ $product->PrixHT }}">{{ $product->Reference }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="products[0][Numserie]" class="form-control" readonly /></td>
                                <td><input type="text" name="products[0][PrixHT]" class="form-control" readonly /></td>
                                <td><input type="number" name="products[0][quantity]" class="form-control quantity-input"
                                        min="1" value="1" /></td>
                                <td><button type="button" name="add_1" class="btn btn-primary add-product"><ion-icon
                                            name="add-outline"></ion-icon></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br>
                <label for='TotalHT'>Total</label>
                <input type="text" class="form-control" name="TotalHT" class="form-control" readonly /><br /><br />

                <label for='Observations'>Observations</label><br />
                <textarea name="Observations" class="form-control"></textarea><br /><br />
                <input type="submit" class="btn btn-success" name="submit" id="submit" value="Envoyer">
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var productCount = 1;

            $(document).on("click", ".add-product", function() {
                var template = `
                    <tr>
                        <td>
                            <select name="products[${productCount}][product_id]" class="form-control product-select">
                                <option value="">Choisir un produit</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-numserie="{{ $product->Numserie }}" data-PrixHT="{{ $product->PrixHT }}">{{ $product->Reference }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="products[${productCount}][Numserie]" class="form-control" readonly /></td>
                        <td><input type="number" name="products[${productCount}][PrixHT]" class="form-control" readonly /></td>
                        <td><input type="number" name="products[${productCount}][quantity]" class="form-control quantity-input" min="1" value="1" /></td>
                        <td><button type="button" name="remove" class="btn btn-danger remove-product"><ion-icon name="remove-outline"></ion-icon></button></td>
                    </tr>
                `;
                $("tbody").append(template);

                productCount++;
            });

            $(document).on("click", ".remove-product", function() {
                $(this).closest("tr").remove();
                updateTotalHT();
            });

            $(document).on("change", ".product-select", function() {
                var productRow = $(this).closest("tr");
                var productId = $(this).val();

                productRow.find("input[name='products[" + productRow.index() + "][Numserie]']").val("");
                productRow.find("input[name='products[" + productRow.index() + "][PrixHT]']").val("");

                if (productId) {
                    var numserie = $(this).find("option:selected").data("numserie");
                    var PrixHT = $(this).find("option:selected").data("prixht");

                    productRow.find("input[name='products[" + productRow.index() + "][Numserie]']").val(
                        numserie);
                    productRow.find("input[name='products[" + productRow.index() + "][PrixHT]']").val(
                        PrixHT);
                }


                updateTotalHT();
            });

            function updateTotalHT() {
                var totalHT = 0;
                $("tbody tr").each(function() {
                    var quantity = $(this).find(".quantity-input").val();
                    var price = $(this).find("[name$='[PrixHT]']").val();
                    var subtotal = quantity * price;
                    totalHT += subtotal;
                });

                var formattedTotalHT = totalHT.toLocaleString("fr-FR", {
                    style: "currency",
                    currency: "mad"
                });
                $("input[name='TotalHT']").val(formattedTotalHT);
            }


            $(document).on("change", ".quantity-input", function() {
                updateTotalHT();
            });
        });
    </script>
@endsection
