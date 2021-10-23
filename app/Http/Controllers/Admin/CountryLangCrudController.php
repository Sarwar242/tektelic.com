<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CountryLangRequest;
use App\Models\Country;
use App\Models\CountryLang;
use App\Models\Langs;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CountryLangCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CountryLangCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CountryLang::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/countrylang');
        CRUD::setEntityNameStrings('countrylang', 'country_langs');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
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
        CRUD::setValidation(CountryLangRequest::class);

        $langs = Langs::getLangsArray();

        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'country_id', 'type' => 'hidden', 'label' => 'country_id']);
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


    public function store(CountryLangRequest $request)
    {
        $input = $request->all();

        $entity = new Country();

        $entity->title = $input['title'];
        $entity->status = 1;


        $entity->save();


        $entity_lang = CountryLang::where(
            'lang', '=', $input['lang']
        )->where('country_id', '=', $entity->id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new CountryLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->country_id = $entity->id;

        $entity_lang->save();
        return redirect('admin/countrylang');
    }

    public function update(CountryLangRequest $request)
    {
        $input = $request->all();

        $relation_id = $request->input('country_id');
        $entity_lang = CountryLang::where(
            'lang', '=', $input['lang']
        )->where('country_id', '=', $relation_id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new CountryLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->country_id = $relation_id;

        $entity_lang->save();
        return redirect('admin/countrylang');
    }

    public function destroy($id)
    {
        /*$this->crud->hasAccessOrFail('delete');*/
        $entity_lang = CountryLang::where(
            'id', '=', $id
        )->with(['country' => function ($query) {
        }])->first();

        $entity_langs = CountryLang::where(
            'country_id', '=', $entity_lang->country_id
        )->with(['country' => function ($query) {
        }])->get();

        $count = $entity_langs->count();

        if($count>1) {
            return $this->crud->delete($id);
        }
        else{

            $entity = Country::where(
                'id', '=', $entity_lang->country_id
            )->first();

            if(!empty($entity)){
                $entity_lang->delete($id);
                $entity->delete();
            }
            return 1;
        }
    }
}
