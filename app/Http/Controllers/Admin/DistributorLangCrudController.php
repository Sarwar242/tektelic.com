<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\DistributorLangRequest;
use App\Models\Distributor;
use App\Models\DistributorLang;
use App\Models\Langs;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DistributorLangCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DistributorLangCrudController extends CrudController
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
        CRUD::setModel(\App\Models\DistributorLang::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/distributorlang');
        CRUD::setEntityNameStrings('distributorlang', 'distributor_langs');

        $this->crud->setHeading('Distributors');
        $this->crud->setSubheading('Distributor');

        //$this->crud->addButtonFromView('line', 'update-distributor', 'update-distributor', 'beginning');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'distributor_id', 'type' => 'text', 'label' => 'Distributor Id']);
        // $this->crud->addColumn(['name' => 'category_id', 'type' => 'text', 'label' => 'Category']);
        $this->crud->addColumn(['name' => 'distributor_id', 'type' => 'select',
            'label' => 'Country', 'model' => "App\Models\Distributor",'attribute' => 'title','entity' => 'distributor.country',
            'key'=>'categoryName']);
        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);

        $this->crud->addColumn(['name' => 'lang', 'type' => 'text', 'label' => 'Lang']);

        //    $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);

        $this->crud->addColumn(['name' => 'distributor_id', 'type' => 'select', 'label' =>
            'Status', 'model' => "App\Models\Distributor",'attribute' => 'status','entity' => 'distributor',
            'key'=>'statusValue']);

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
        CRUD::setValidation(DistributorLangRequest::class);

        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();

        $countries = Helper::getCountriesArray();

        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);

        $this->crud->addField(['name' => 'country_id', 'label' => 'Country',
            'type' => 'select_from_array',
            'options' => $countries,
            'allows_null' => false,
            //'default' => 1,

        ]);

        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'link', 'type' => 'text', 'label' => 'Link']);

        $this->crud->addField(['name' => 'distributor_id', 'type' => 'hidden', 'label' => 'Use Case Id']);
        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => 1,
        ]);


        $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image',
            'crop' => true, // set to true to allow cropping, false to disable
            //  'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);

        $this->crud->addField(['name' => 'alt', 'type' => 'text', 'label' => 'Alt']);
        $this->crud->addField(['name' => 'pic_title', 'type' => 'text', 'label' => 'Picture Title']);

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
        CRUD::setValidation(DistributorLangRequest::class);

        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();
        $countries = Helper::getCountriesArray();

        $id = \Route::current()->parameter('id');
        $entity = DistributorLang::where(
            'id', '=', $id
        )->with(['distributor' => function ($query) {
        }])->first();

        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => $entity->distributor->status,
        ]);

        $this->crud->addField(['name' => 'country_id', 'label' => 'Country',
            'type' => 'select_from_array',
            'options' => $countries,
            'allows_null' => false,
            'default' => $entity->distributor->country_id,

        ]);


        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'link', 'type' => 'text', 'label' => 'Link', 'value'=>$entity->distributor->link]);

        $this->crud->addField(['name' => 'distributor_id', 'type' => 'hidden', 'label' => 'Use Case Id']);
        $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image','value'=>$entity->distributor->image,
            'crop' => true, // set to true to allow cropping, false to disable
            // 'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);
        $this->crud->addField(['name' => 'alt', 'type' => 'text', 'label' => 'Alt']);
        $this->crud->addField(['name' => 'pic_title', 'type' => 'text', 'label' => 'Picture Title']);

    }


    public function store(DistributorLangRequest $request)
    {
        $input = $request->all();

        $entity = new Distributor();

        $entity->title = $input['title'];
        $entity->country_id = $input['country_id'];
        $entity->status = $input['status'];
        $entity->link = $input['link'];
        $entity->image = $input['image'];
        $entity->save();


        $entity_lang = DistributorLang::where(
            'lang', '=', $input['lang']
        )->where('distributor_id', '=', $entity->id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new DistributorLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->alt = $input['alt'];
        $entity_lang->pic_title = $input['pic_title'];
        $entity_lang->distributor_id = $entity->id;

        $entity_lang->save();
        return redirect('admin/distributorlang');
    }

    public function update(DistributorLangRequest $request)
    {
        $input = $request->all();

        $relation_id = $request->input('distributor_id');

        $entity =  Distributor::where('id',$relation_id)->first();
        $entity->status = $input['status'];
        $entity->country_id = $input['country_id'];
        $entity->link = $input['link'];
        if(empty($input['image'])){
            $input['image']=$entity->image;
        }
        $entity->image = $input['image'];
        $entity->save();

        $entity_lang = DistributorLang::where(
            'lang', '=', $input['lang']
        )->where('distributor_id', '=', $relation_id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new DistributorLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->alt = $input['alt'];
        $entity_lang->pic_title = $input['pic_title'];
        $entity_lang->distributor_id = $relation_id;

        $entity_lang->save();
        return redirect('admin/distributorlang');
    }


    public function destroy($id)
    {
        /*$this->crud->hasAccessOrFail('delete');*/
        $entity_lang = DistributorLang::where(
            'id', '=', $id
        )->with(['distributor' => function ($query) {
        }])->first();

        $entity_langs = DistributorLang::where(
            'distributor_id', '=', $entity_lang->distributor_id
        )->with(['distributor' => function ($query) {
        }])->get();

        $count = $entity_langs->count();

        if($count>1) {
            return $this->crud->delete($id);
        }
        else{

            $entity = Distributor::where(
                'id', '=', $entity_lang->distributor_id
            )->first();

            if(!empty($entity)){
                $entity_lang->delete($id);
                $entity->delete();
            }
            return 1;
        }
    }


}
