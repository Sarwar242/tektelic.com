<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RequestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RequestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RequestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Request::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/request');
        CRUD::setEntityNameStrings('request', 'requests');
        $this->crud->enableExportButtons();
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       // CRUD::setFromDb(); // columns

       /* $this->crud->addColumn(['name' => 'country_id', 'type' => 'select',
            'label' => 'Country', 'model' => "App\Models\Request",'attribute' => 'title','entity' => 'country',
            'key'=>'countryName']);*/

        if(!empty($_GET['type'])) {
            $this->crud->addClause('where', 'type', $_GET['type']);
        }

        if(!empty($_GET['type']) && $_GET['type'] == 'get-in-touch')
        {
            $this->crud->addColumn(['name' => 'email', 'type' => 'text', 'label' => 'Email']);
            $this->crud->addColumn(['name' => 'type', 'type' => 'text', 'label' => 'Type']);
            $this->crud->addColumn(['name' => 'created_at', 'type' => 'text', 'label' => 'Create At']);
            $this->crud->addColumn(['label' => 'Country', 'type' => 'select', 'name' => 'country_id', 'entity' => 'country', 'attribute' => 'title']);
        }
        else
        {

            $this->crud->addColumn(['name' => 'email', 'type' => 'text', 'label' => 'Email']);
            $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
            $this->crud->addColumn(['name' => 'type', 'type' => 'text', 'label' => 'Type']);
            $this->crud->addColumn(['name' => 'created_at', 'type' => 'text', 'label' => 'Create At']);
            $this->crud->addColumn(['name' => 'phone', 'type' => 'text', 'label' => 'Phone']);
            //$this->crud->addColumn(['name' => 'body', 'type' => 'text', 'label' => 'Body']);
            $this->crud->addColumn(['name' => 'message', 'type' => 'text', 'label' => 'Message']);
            $this->crud->addColumn(['name' => 'lastname', 'type' => 'text', 'label' => 'Last Name']);
            $this->crud->addColumn(['name' => 'company', 'type' => 'text', 'label' => 'Company']);
            $this->crud->addColumn(['name' => 'linkedin', 'type' => 'text', 'label' => 'Linkedin or email,phone']);
            $this->crud->addColumn(['label' => 'Country', 'type' => 'select', 'name' => 'country_id', 'entity' => 'country', 'attribute' => 'title']);

            $this->crud->removeButton('create');
            $this->crud->removeButton('update');
        }
       /* $this->crud->addColumn([
            'label' => 'Country',
            'type' => 'select',
            'name' => 'country_id',
            'entity' => 'country',
            'attribute' => 'title',

        ]);*/

        
       // $this->crud->removeButton('show');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumn([
            'label' => 'Country',
            'type' => 'select',
            'name' => 'country_id',
            'entity' => 'country',
            'attribute' => 'title',

        ]);


        $this->crud->addColumn(['name' => 'email', 'type' => 'text', 'label' => 'Email']);
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'lastname', 'type' => 'text', 'label' => 'Last Name']);
        $this->crud->addColumn(['name' => 'phone', 'type' => 'text', 'label' => 'Phone']);
        $this->crud->addColumn(['name' => 'company', 'type' => 'text', 'label' => 'Company']);
        $this->crud->addColumn(['name' => 'message', 'type' => 'text', 'label' => 'Message']);

        //$this->crud->addColumn(['name' => 'body', 'type' => 'text', 'label' => 'Body']);
        $this->crud->addColumn(['name' => 'linkedin', 'type' => 'text', 'label' => 'Linkedin or email,phone']);
        // $this->crud->addColumn(['name' => 'manager_email', 'type' => 'text', 'label' => 'Manager Email']);
        $this->crud->addColumn(['name' => 'type', 'type' => 'text', 'label' => 'Type']);
       
        $this->crud->addColumn(['name' => 'type', 'type' => 'text', 'label' => 'Type']);

        


        $this->crud->removeButton('update');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RequestRequest::class);

        CRUD::setFromDb(); // fields

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

    /*public function index()
    {
        // if view_table_permission is false, abort
        $this->crud->hasAccessOrFail('list');

        $this->crud->addClause('where', 'type', 'footer'); // <---- this is where it's different from CrudController::index()
        $this->data['entries'] = $this->crud->getEntries();
        $this->data['crud'] = $this->crud;
        //$this->data['title'] = ucfirst($this->crud->entity_name_plural);
        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('crud::list', $this->data);
    }*/
}
