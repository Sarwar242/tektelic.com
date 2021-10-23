<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\UseCaseTechnologyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UseCaseTechnologyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UseCaseTechnologyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\UseCaseTechnology::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/usecasetechnology');
        CRUD::setEntityNameStrings('usecasetechnology', 'use_case_technologies');

        $this->crud->setHeading('technologies for use cases');
        $this->crud->setSubheading('technology');

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns

        $this->crud->addColumn(['name' => 'use_cases_id', 'type' => 'select',
            'label' => 'Use Case', 'model' => "App\Models\UseCases",'attribute' => 'title','entity' => 'useCase.useCaseLangForBenefit',
            'key'=>'usecaseName']);

        $this->crud->addColumn(['name' => 'technology_id', 'type' => 'select',
            'label' => 'Technology', 'model' => "App\Models\Technology",'attribute' => 'title','entity' => 'technology.technologyLangOne',
            'key'=>'benefitName']);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UseCaseTechnologyRequest::class);

        $use_cases = Helper::getUseCasesArray();
        $benefits = Helper::getTechnologyArray();

        $this->crud->addField(['name' => 'use_cases_id', 'label' => 'Use Case',
            'type' => 'select_from_array',
            'options' => $use_cases,
            'allows_null' => false,
            //'default' => 1,
        ]);

        $this->crud->addField(['name' => 'technology_id', 'label' => 'Technology',
            'type' => 'select_from_array',
            'options' => $benefits,
            'allows_null' => false,
            //'default' => 1,
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
