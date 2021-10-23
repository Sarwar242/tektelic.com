<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\KeysRequest;
use App\Keys;
use App\KeysType;
use App\Models\Category;
use App\Models\KeysTypes;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class KeysCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class KeysCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Keys::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/keys');
        CRUD::setEntityNameStrings('keys', 'Keys');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
//        CRUD::setFromDb(); // columns

        CRUD::addColumn(['name' => 'name', 'type' => 'text']);
//        CRUD::addColumn([
//            'name' => 'type',
//            'type' => 'select',
//            'label' => 'Type',
//            'model' => "\App\Models\KeysTypes",
//            'attribute' => 'name',
//            'entity' => 'types',
//        ]);
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
        CRUD::setValidation(KeysRequest::class);
        $item = KeysTypes::all()->keyBy('id')->pluck('name', 'id')->toArray();
//        CRUD::setFromDb(); // fields
        CRUD::addField(['name' => 'name', 'type' => 'text']);
//        CRUD::addField([   // select_from_array
//            'name'        => 'type',
//            'label'       => "Type",
//            'type'        => 'select_from_array',
//            'options'     => $item,
//            'allows_null' => false,
//        ]);
//        $this->crud->addField([
//            'name'        => 'categories_id',
//            'label'       => "Category",
//            'type'        => 'select_from_array',
//            'options'     => Category::all()->keyBy('id')->pluck('name', 'id')->toArray(),
//            'allows_null' => false,
//        ]);

//
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
