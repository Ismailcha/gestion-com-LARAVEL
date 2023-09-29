<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class ClientTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;
    public string $primaryKey = 'NumClient';
    public string $sortField = 'NumClient';
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
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
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
     * @return Builder<\App\Models\Client>
     */
    public function datasource(): Builder
    {
        return Client::query();
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
            ->addColumn('NumClient')
            ->addColumn('Pharmacie')

            /** Example of custom column using a closure **/
            ->addColumn('Pharmacie_lower', fn (Client $model) => strtolower(e($model->Pharmacie)))

            ->addColumn('CodePostal')
            ->addColumn('NomClient')
            ->addColumn('Prénom')
            ->addColumn('Adresse')
            ->addColumn('Ville')
            ->addColumn('Pays')
            ->addColumn('Telephone')
            ->addColumn('Fax')
            ->addColumn('EMail')
            ->addColumn('Type')
            ->addColumn('Observations')
            ->addColumn('Plan')
            ->addColumn('created_at_formatted', fn (Client $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('Numero Client', 'NumClient')
                ->sortable(),
            Column::make('Pharmacie', 'Pharmacie')
                ->sortable()
                ->searchable(),

            Column::make('Nom', 'NomClient')
                ->sortable()
                ->searchable(),

            Column::make('Prénom', 'Prénom')
                ->sortable()
                ->searchable(),

            Column::make('Adresse', 'Adresse'),

            Column::make('Ville', 'Ville')
                ->sortable()
                ->searchable(),

            Column::make('Pays', 'Pays')
                ->sortable()
                ->searchable(),

            Column::make('Code Postal', 'CodePostal'),
            Column::make('Telephone', 'Telephone'),
            Column::make('Fax', 'Fax'),
            Column::make('Email', 'EMail')
                ->sortable()
                ->searchable(),

            Column::make('Type', 'Type')
                ->sortable()
                ->searchable(),

            Column::make('Observations', 'Observations'),

            Column::make('Plan', 'Plan')
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
            Filter::inputText('Pharmacie')->operators(['contains']),
            Filter::inputText('NomClient')->operators(['contains']),
            Filter::inputText('Prénom')->operators(['contains']),
            Filter::inputText('Adresse')->operators(['contains']),
            Filter::inputText('Ville')->operators(['contains']),
            Filter::inputText('Pays')->operators(['contains']),
            Filter::inputText('EMail')->operators(['contains']),
            Filter::inputText('Type')->operators(['contains']),
            Filter::inputText('Observations')->operators(['contains']),
            Filter::inputText('Plan')->operators(['contains']),
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
     * PowerGrid Client Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Modifier')
                ->class('btn btn-primary')
                ->route('commercial.edit_client', ['NumClient' => 'NumClient']),

            Button::make('destroy', 'Supprimer')
                ->class('btn btn-danger mt-1 alertClass')
                ->route('client.destroy', ['NumClient' => 'NumClient'])
                ->method('delete')
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
     * PowerGrid Client Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($client) => $client->id === 1)
                ->hide(),
        ];
    }
    */
}
