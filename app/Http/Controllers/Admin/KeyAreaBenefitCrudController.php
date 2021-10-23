<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\KeyAreaBenefitRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class KeyAreaBenefitCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class KeyAreaBenefitCrudController extends CrudController
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
        CRUD::setModel(\App\Models\KeyAreaBenefit::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/keyareabenefit');
        CRUD::setEntityNameStrings('keyareabenefit', 'key_area_benefits');

        $this->crud->setHeading('Benefits for key area');
        $this->crud->setSubheading('Benefit');

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'key_area_id', 'type' => 'select',
            'label' => 'Key Area', 'model' => "App\Models\KeyAres",'attribute' => 'title','entity' => 'keyArea.keyAreaLangOne',
            'key'=>'usecaseName']);

        $this->crud->addColumn(['name' => 'benefit_id', 'type' => 'select',
            'label' => 'Benefit', 'model' => "App\Models\Benefits",'attribute' => 'title','entity' => 'benefit.benefitLang',
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
        CRUD::setValidation(KeyAreaBenefitRequest::class);

        $key_areas = Helper::getKeyAreasArray();
        $benefits = Helper::getBenefitsArray();

        $this->crud->addField(['name' => 'key_area_id', 'label' => 'Key Area',
            'type' => 'select_from_array',
            'options' => $key_areas,
            'allows_null' => false,
            //'default' => 1,
        ]);

        $this->crud->addField(['name' => 'benefit_id', 'label' => 'Benefit',
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
