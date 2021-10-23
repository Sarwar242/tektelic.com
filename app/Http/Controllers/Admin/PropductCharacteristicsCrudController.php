<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\PropductCharacteristicsRequest;
use App\Models\ProductCharacteristics;
use App\Models\ProductTypeItemFilter;
use App\ProductCharacteristicsBlock;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PropductCharacteristicsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PropductCharacteristicsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ProductCharacteristics::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/propductcharacteristics');
        CRUD::setEntityNameStrings('propductcharacteristics', 'propduct_characteristics');
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
        $this->crud->addColumn('name');
//        $this->crud->addColumn('value');
        $this->crud->addColumn('parent_id');

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
        CRUD::setValidation(PropductCharacteristicsRequest::class);

//        CRUD::setFromDb(); // fields
        CRUD::addField(['name' => 'name', 'type' => 'text']);
//        CRUD::addField(['name' => 'value', 'type' => 'text']);
//        $this->crud->addField([
//            'name' => 'checked',
//            'label' => 'Checked item value',
//            'type' => 'checkbox',
//            'default' => 0,
//        ]);
        $this->crud->addField([
            'name' => 'set_to_filter',
            'label' => 'Set item for filter',
            'type' => 'checkbox',
            'default' => 0,
            'tab' => 'Option for filter'
        ]);
        $this->crud->addField([
            'label' => 'Filter type item2',
            'name' => 'type_filter',
            'type' => 'select_from_array',
            'options' => ProductCharacteristics::getListItemType(),
            'allows_null' => true,
            'attribute' => 'name', // foreign key attribute that is shown to user
            'tab' => 'Option for filter'
        ]);
        $this->crud->addField([
            'name'        => 'type',
            'label'       => "Type",
            'type'        => 'select_from_array',
            'options'     => Helper::$type_characteristic,
            'allows_null' => true,
            'default' => 1,
        ]);
        $this->crud->addField([
            'name' => 'parent_id',
            'label' => 'Parent block',
            'type' => 'select_from_array',
            'options' => ProductCharacteristicsBlock::getListBlock(),
            'allows_null' => true,
            'default' => 0,
        ]);
//        $this->crud->addField([
//            'name' => 'is_main',
//            'label' => 'is Main',
//            'type' => 'checkbox',
//            'default' => 0,
//        ]);
//        $this->crud->addField([
//            'name' => 'pir',
//            'label' => 'Base',
//            'type' => 'checkbox',
//            'default' => 0,
//        ]);
//        $this->crud->addField([
//            'name' => 'base',
//            'label' => 'PIR',
//            'type' => 'checkbox',
//            'default' => 0,
//        ]);
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
