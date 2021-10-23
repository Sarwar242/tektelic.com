<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\BenefitLangRequest;
use App\Models\BenefitLang;
use App\Models\Benefits;
use App\Models\KeyAres;
use App\Models\Langs;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BenefitLangCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BenefitLangCrudController extends CrudController
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
        CRUD::setModel(\App\Models\BenefitLang::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/benefitlang');
        CRUD::setEntityNameStrings('benefitlang', 'benefits_lang');

        $this->crud->setHeading('Benefits');
        $this->crud->setSubheading('Benefit');

        $this->crud->addButtonFromView('line', 'update-benefit', 'update-benefit', 'beginning');

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->addColumn(['name' => 'benefit_id', 'type' => 'text', 'label' => 'Benefit Id']);
        // $this->crud->addColumn(['name' => 'category_id', 'type' => 'text', 'label' => 'Category']);

        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);

        $this->crud->addColumn(['name' => 'benefit_id', 'type' => 'select', 'label' =>
            'Type', 'model' => "App\Models\Benefits",'attribute' => 'type','entity' => 'benefit',
            'key'=>'typeValue']);

        $this->crud->addColumn(['name' => 'benefit_id', 'type' => 'select', 'label' =>
            'Section Type', 'model' => "App\Models\Benefits",'attribute' => 'section_type','entity' => 'benefit',
            'key'=>'sectiontypeValue']);


       // $this->crud->addColumn(['name' => 'text', 'type' => 'text', 'label' => 'Text']);
        $this->crud->addColumn(['name' => 'lang', 'type' => 'text', 'label' => 'Lang']);

        //    $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);

        $this->crud->addColumn(['name' => 'benefit_id', 'type' => 'select', 'label' =>
            'Status', 'model' => "App\Models\Benefits",'attribute' => 'status','entity' => 'benefit',
            'key'=>'statusValue']);

        $this->crud->setHeading('Benefits', 'list');
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
        CRUD::setValidation(BenefitLangRequest::class);

        $statuses = Helper::$statuses;
        $types = Helper::$types;
        $langs = Langs::getLangsArray();
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
        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text','extra_plugins' => ['justify']]);



        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'benefit_id', 'type' => 'hidden', 'label' => 'Key Area Id']);
        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => 1,
        ]);
        $this->crud->addField(['name' => 'image', 'type' => 'upload', 'label' => 'Image','upload'=> true
        ]);

       /* $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image',
            'crop' => true, // set to true to allow cropping, false to disable

        ]);*/
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
       // $this->setupCreateOperation();

    }

    public function store(BenefitLangRequest $request)
    {
        $input = $request->all();

        $entity = new Benefits();
        $entity->status = $input['status'];
        $entity->type = $input['type'];
        $entity->section_type = $input['section_type'];

        if(empty($input['image'])){
            $input['image']='';
        }
        $entity->image = $input['image'];
        $entity->save();


        $entity_lang = BenefitLang::where(
            'lang', '=', $input['lang']
        )->where('benefit_id', '=', $entity->id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new BenefitLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->text = $input['text'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->benefit_id = $entity->id;

        $entity_lang->save();
        return redirect('admin/benefitlang');
    }

    public function update(BenefitLangRequest $request)
    {
        $input = $request->all();

        $relation_id = $request->input('benefit_id');
        $entity_lang = BenefitLang::where(
            'lang', '=', $input['lang']
        )->where('benefit_id', '=', $relation_id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new BenefitLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->text = $input['text'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->benefit_id = $relation_id;

        $entity_lang->save();
        return redirect('admin/benefitlang');
    }
}
