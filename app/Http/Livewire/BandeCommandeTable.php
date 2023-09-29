<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\bonDeSortie;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};


final class BandeCommandeTable extends PowerGridComponent
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
     * @return Builder<\App\Models\bonDeSortie>
     */
    public function datasource(): Builder
    {
        return bonDeSortie::query();
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
            ->addColumn(
                'Client',
                fn (bonDeSortie $model) => $model->client
                    ? "<a href='" . route('client.detail', ['NumClient' => $model->client_id]) . "'>" . ($model->client->NomClient ?? '') . ' ' . ($model->client->Prénom ?? '') . "</a>"
                    : ''
            )
            ->addColumn('nomDel', function (bonDeSortie $model) {
                if ($model->commercial === null) {
                    // No related commercial, treat as admin
                    return 'Admin';
                } else {
                    // There's a related commercial, check the role
                    if ($model->commercial->role === 0) {
                        // Role 0 indicates a commercial
                        return $model->commercial->name ?? '';
                    } else {
                        // Other roles, treat as admin
                        return 'Admin';
                    }
                }
            })
            ->addColumn('DateBS_formatted', fn (bonDeSortie $model) => Carbon::parse($model->Date)->format('d/m/Y'))->addColumn('Date_formatted', fn (bonDeSortie $model) => Carbon::parse($model->Date)->format('d/m/Y'))
            ->addColumn('TotalHT', fn ($model) => number_format($model->TotalHT, 2, '.', ','))
            ->addColumn('Observations')
            ->addColumn('created_at_formatted', fn (bonDeSortie $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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

            Column::make('Nom Deleguer', 'nomDel'),

            Column::make('Client', 'Client'),
            Column::make('Date', 'Date_formatted', 'Date')
                ->sortable(),

            Column::make('Total hors taxe', 'TotalHT', 'TotalHT'),
            Column::make('Observations', 'Observations')
                ->sortable()
                ->searchable(),

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
            // Filter::datepicker('DateBS'),
            // Filter::datepicker('Date'),
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
     * PowerGrid bonDeSortie Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            // Button::make('edit', 'Edit')
            //     ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
            //     ->route('bon-de-sortie.edit', ['id' => 'id']),
            Button::make('detail', 'detail')
                ->class('btn btn-primary mt-1')
                ->route('commercial.bandecommande', ['id' => 'id']),
            Button::make('destroy', 'Supprimer')
                ->class('btn btn-danger mt-1 alertClass')
                ->route('bandeCommande.destroy', ['id' => 'id'])
                ->method('delete')
            // ->emit('deleteItem', ['id' => 'id']),
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
     * PowerGrid bonDeSortie Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($bon-de-sortie) => $bon-de-sortie->id === 1)
                ->hide(),
        ];
    }
    */
}
