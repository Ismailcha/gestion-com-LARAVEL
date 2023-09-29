<?php

namespace App\Http\Livewire;

use App\Models\Commercials;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class CommercialTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public string $primaryKey = 'IDDelegue';
    public string $sortField = 'IDDelegue';
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
     * @return Builder<\App\Models\Commercials>
     */
    public function datasource(): Builder
    {
        return Commercials::query();
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
            ->addColumn('IDDelegue')
            ->addColumn('nomDel', fn (Commercials $model) => "<a href='" . route('commercial.detail', ['id' => $model->IDDelegue]) . "'>" . $model->nomDel . "</a>")

            /** Example of custom column using a closure **/
            ->addColumn('nomDel_lower', fn (Commercials $model) => strtolower(e($model->nomDel)))

            ->addColumn('CIN')
            ->addColumn('CNSSDel')
            ->addColumn('AdresseDel')
            ->addColumn('NumCaGrise')
            ->addColumn('NumPC')
            ->addColumn('Poste')
            ->addColumn('DateEmb_formatted', fn (Commercials $model) => Carbon::parse($model->DateEmb)->format('d/m/Y'))
            ->addColumn('Qualié')
            ->addColumn('Affecaions')
            ->addColumn('user_id')
            ->addColumn('created_at_formatted', fn (Commercials $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'IDDelegue'),
            Column::make('Nom', 'nomDel')
                ->sortable()
                ->searchable(),

            Column::make('CIN', 'CIN')
                ->sortable()
                ->searchable(),

            Column::make('CNSS delegue', 'CNSSDel')
                ->sortable()
                ->searchable(),

            Column::make('Adresse delegue', 'AdresseDel')
                ->sortable()
                ->searchable(),

            Column::make('Num carte grise', 'NumCaGrise')
                ->sortable()
                ->searchable(),

            Column::make('NumPC', 'NumPC')
                ->sortable(),

            Column::make('Poste', 'Poste')
                ->sortable(),

            Column::make('Date embauche', 'DateEmb_formatted', 'DateEmb')
                ->sortable(),

            Column::make('Qualié', 'Qualié'),

            Column::make('Affecaions', 'Affecaions')
                ->searchable(),

            Column::make('User id', 'user_id'),
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
            // Filter::inputText('nomDel')->operators(['contains']),
            // Filter::inputText('CIN')->operators(['contains']),
            // Filter::inputText('CNSSDel')->operators(['contains']),
            // Filter::inputText('AdresseDel')->operators(['contains']),
            // Filter::inputText('NumCaGrise')->operators(['contains']),
            // Filter::inputText('NumPC')->operators(['contains']),
            // Filter::inputText('Poste')->operators(['contains']),
            // Filter::datepicker('DateEmb'),
            // Filter::inputText('Qualié')->operators(['contains']),
            // Filter::inputText('Affecaions')->operators(['contains']),
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
     * PowerGrid Commercials Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Modifier')
                ->class('btn btn-primary')
                ->route('commercial.edit', ['IDDelegue', 'IDDelegue']),
            Button::make('destroy', 'Supprimer')
                ->class('btn btn-danger mt-1 alertClass')
                ->route('commercial.destroy', ['IDDelegue', 'IDDelegue'])
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
     * PowerGrid Commercials Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($commercials) => $commercials->id === 1)
                ->hide(),
        ];
    }
    */
}
