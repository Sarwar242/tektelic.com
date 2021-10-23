<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\UseCaseItemLangRequest;
use App\Models\Langs;
use App\Models\UseCaseItem;
use App\Models\UseCaseItemLang;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UseCaseItemLangCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UseCaseItemLangCrudController extends CrudController
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
        CRUD::setModel(\App\Models\UseCaseItemLang::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/usecaseitemlang');
        CRUD::setEntityNameStrings('usecaseitemlang', 'use_case_item_langs');

        $this->crud->setHeading('Use Cases Items');
        $this->crud->setSubheading('Use Cases Item');

        $this->crud->addButtonFromView('line', 'update-usecaseitem', 'update-usecaseitem', 'beginning');
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

        $this->crud->addColumn(['name' => 'use_cases_id', 'type' => 'select',
            'label' => 'Use Case', 'model' => "App\Models\UseCaseItem",'attribute' => 'title','entity' => 'useCaseItem.useCase.useCaseLangForBenefit',
            'key'=>'usecaseName']);

        $this->crud->addColumn(['name' => 'use_cases_items_id', 'type' => 'select', 'label' =>
            'Status', 'model' => "App\Models\UseCaseItem",'attribute' => 'status','entity' => 'useCaseItem',
            'key'=>'statusValue']);

        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addColumn(['name' => 'lang', 'type' => 'text', 'label' => 'Lang']);
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
        CRUD::setValidation(UseCaseItemLangRequest::class);

       // CRUD::setFromDb(); // fields

        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();
        $use_cases_lang = Helper::getUseCaseArray();

        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,
        ]);


        $this->crud->addField(['name' => 'use_cases_id', 'label' => 'Use Case',
            'type' => 'select_from_array',
            'options' => $use_cases_lang,
            'allows_null' => false,
            //'default' => 1,
        ]);


        $this->crud->addField(['name' => 'use_cases_items_id', 'type' => 'hidden', 'label' => 'Key Area Id']);

        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => 1,
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


    public function store(UseCaseItemLangRequest $request)
    {
        $input = $request->all();

        $entity = new UseCaseItem();
        $entity->status = $input['status'];
        $entity->use_cases_id = $input['use_cases_id'];
        $entity->title =  $input['title'];

        $entity->icon = 'icon';
        $entity->save();


        $entity_lang = UseCaseItemLang::where(
            'lang', '=', $input['lang']
        )->where('use_cases_items_id', '=', $entity->id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new UseCaseItemLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->text = 'text';
        $entity_lang->lang = $input['lang'];
        $entity_lang->use_cases_items_id = $entity->id;

        $entity_lang->save();
        return redirect('admin/usecaseitemlang');
    }
}
