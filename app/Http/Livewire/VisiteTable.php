<?php

namespace App\Http\Livewire;

use App\Models\Visite;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class VisiteTable extends PowerGridComponent
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
     * @return Builder<\App\Models\Visite>
     */
    public function datasource(): Builder
    {
        return Visite::query();
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
            ->addColumn('Identifiant')

            /** Example of custom column using a closure **/
            ->addColumn('Identifiant_lower', fn (Visite $model) => strtolower(e($model->Identifiant)))
            ->addColumn('NomClient', fn (Visite $model) => $model->client->NomClient)
            ->addColumn('PrenomClient', fn (Visite $model) => $model->client->Prénom)

            // Combine NomClient and PrenomClient columns into a single "Client" column
            ->addColumn('Client', fn (Visite $model) => "<a href='" . route('client.detail', ['NumClient' => $model->NumClient]) . "'>" . $model->client->NomClient . ' ' . $model->client->Prénom . "</a>")
            ->addColumn('nomDel', fn (Visite $model) => $model->commercial->nomDel)
            ->addColumn('Date_formatted', fn (Visite $model) => Carbon::parse($model->Date)->format('d/m/Y'))
            ->addColumn('Duree')
            ->addColumn('Observation')
            ->addColumn('created_at_formatted', fn (Visite $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('Id', 'id'),
            Column::make('Identifiant', 'Identifiant')
                ->sortable()
                ->searchable(),

            Column::make('Client', 'Client'),
            Column::make('Commercial', 'nomDel'),
            Column::make('Date', 'Date_formatted', 'Date')
                ->sortable(),

            Column::make('Duree', 'Duree'),
            Column::make('Observation', 'Observation'),

            Column::make('Created at', 'created_at_formatted', 'created_at')
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
            // Filter::inputText('Identifiant')->operators(['contains']),
            // Filter::datepicker('Date'),
            // Filter::inputText('Observation')->operators(['contains']),
            // Filter::datetimepicker('created_at'),
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
     * PowerGrid Visite Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Modifier')
                ->class('btn btn-primary')
                ->route('visite.edit', ['id' => 'id']),

            Button::make('destroy', 'Supprimer')
                ->class('btn btn-danger mt-1 alertClass')
                ->route('visite.delete', ['id' => 'id'])
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
     * PowerGrid Visite Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($visite) => $visite->id === 1)
                ->hide(),
        ];
    }
    */
}
