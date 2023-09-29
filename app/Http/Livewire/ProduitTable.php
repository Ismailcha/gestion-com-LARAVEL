<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};
use PowerComponents\LivewirePowerGrid\Responsive;

final class ProduitTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Product>
     */
    public function datasource(): Builder
    {
        return Product::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('Reference')

            /** Example of custom column using a closure **/
            ->addColumn('Reference_lower', fn (Product $model) => strtolower(e($model->Reference)))

            ->addColumn('Numserie')
            ->addColumn('LibProd')
            ->addColumn('NumFournisseur')
            ->addColumn('Photo', function (Product $model) {
                if ($model->Photo) {
                    return '<img src="' . asset('storage/photos/' . $model->Photo) . '" alt="Photo produit" width="90">';
                } else {
                    return 'No photo';
                }
            })->addColumn('CodeBarre')
            ->addColumn('PrixHT')
            ->addColumn('PrixAchatHT')
            ->addColumn('PPCTTC')
            ->addColumn('PPHTTC')
            ->addColumn('PGTTC')
            ->addColumn('created_at_formatted', fn (Product $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),
            Column::make('Reference', 'Reference')
                ->sortable()
                ->searchable(),

            Column::make('Numero de serie', 'Numserie'),
            Column::make('Photo', 'Photo'),
            Column::make('libellé Produit', 'LibProd')
                ->sortable()
                ->searchable(),

            Column::make('Numero fournisseur', 'NumFournisseur')
                ->sortable()
                ->searchable(),

            Column::make('Code barre', 'CodeBarre')
                ->sortable()
                ->searchable(),

            Column::make('Prix hors taxe', 'PrixHT')
                ->sortable(),
            Column::make('Date creation', 'created_at_formatted', 'created_at')
                ->sortable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('Reference')->operators(['contains']),
            Filter::inputText('LibProd')->operators(['contains']),
            Filter::inputText('Photo')->operators(['contains']),
            Filter::inputText('CodeBarre')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Product Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Modifier')
                ->class('btn btn-primary')
                ->route('produit.edit', ['produit' => 'id']),

            Button::make('destroy', 'Supprimer')
                ->class('btn btn-danger mt-1 alertClass')
                ->route('produit.delete', ['id' => 'id'])
                ->method('delete'),


        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Product Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($product) => $product->id === 1)
                ->hide(),
        ];
    }
    */
}
