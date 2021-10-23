<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\TechnologyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TechnologyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TechnologyCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Technology::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/technology');
        CRUD::setEntityNameStrings('technology', 'technologies');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->removeButton('create');

        $this->crud->addColumn(['name' => 'id', 'type' => 'text', 'label' => 'Id']);

        $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);
        $this->crud->addColumn(['name' => 'image', 'type' => 'image', 'label' => 'Image']);

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
        CRUD::setValidation(TechnologyRequest::class);

        $statuses = Helper::$statuses;
        $types = Helper::$types;

        $section_types = Helper::$common_section_types;

        $this->crud->addField(['name' => 'section_type', 'label' => 'Section Type',
            'type' => 'select_from_array',
            'options' => $section_types,
            'allows_null' => false,
            //'default' => 1,
        ]);

        $this->crud->addField(['name' => 'type', 'label' => 'Type',
            'type' => 'select_from_array',
            'options' => $types,
            'allows_null' => false,
            //'default' => 1,

        ]);

        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => 1,
        ]);
        $this->crud->addField(['name' => 'image', 'type' => 'upload', 'label' => 'Image','upload'=> true
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
