<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\QualityLifesLangRequest;
use App\Models\Langs;
use App\Models\QualityLife;
use App\Models\QualityLifesLang;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class QualityLifesLangCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QualityLifesLangCrudController extends CrudController
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
        CRUD::setModel(\App\Models\QualityLifesLang::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/qualitylifeslang');
        CRUD::setEntityNameStrings('qualitylifeslang', 'quality_lifes_langs');

        $this->crud->setHeading('Quality Lives');
        $this->crud->setSubheading('Quality Life');

         $this->crud->addButtonFromView('line', 'update-qualitylife', 'update-qualitylife', 'beginning');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'quality_life_id', 'type' => 'text', 'label' => 'Quality Life Id']);
        // $this->crud->addColumn(['name' => 'category_id', 'type' => 'text', 'label' => 'Category']);

        $this->crud->addColumn(['name' => 'quality_life_id', 'type' => 'select', 'label' =>
            'Section Type', 'model' => "App\Models\QualityLife",'attribute' => 'section_type','entity' => 'qualityLife',
            'key'=>'sectypeValue']);

        $this->crud->addColumn(['name' => 'quality_life_id', 'type' => 'select', 'label' =>
            'Type', 'model' => "App\Models\QualityLife",'attribute' => 'type','entity' => 'qualityLife',
            'key'=>'typeValue']);
        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        // $this->crud->addColumn(['name' => 'text', 'type' => 'text', 'label' => 'Text']);
        $this->crud->addColumn(['name' => 'lang', 'type' => 'text', 'label' => 'Lang']);

        //    $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);

        $this->crud->addColumn(['name' => 'quality_life_id', 'type' => 'select', 'label' =>
            'Status', 'model' => "App\Models\QualityLife",'attribute' => 'status','entity' => 'qualityLife',
            'key'=>'statusValue']);

        $this->crud->setHeading('Quality Life', 'list');

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
        CRUD::setValidation(QualityLifesLangRequest::class);

        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();
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

        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text','extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'quality_life_id', 'type' => 'hidden', 'label' => 'Key Area Id']);
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
       // $this->setupCreateOperation();
        CRUD::setValidation(QualityLifesLangRequest::class);

        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();
        $types = Helper::$types;

        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text',]);
        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'quality_life_id', 'type' => 'hidden', 'label' => 'Key Area Id']);
    }

    public function store(QualityLifesLangRequest $request)
    {
        $input = $request->all();

        $entity = new QualityLife();
        $entity->status = $input['status'];
        $entity->type = $input['type'];
        $entity->section_type = $input['section_type'];
        if(empty($input['image'])){
            $input['image']=null;
        }
        $entity->image = $input['image'];


        $entity->save();


        $entity_lang = QualityLifesLang::where(
            'lang', '=', $input['lang']
        )->where('quality_life_id', '=', $entity->id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new QualityLifesLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->text = $input['text'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->quality_life_id = $entity->id;

        $entity_lang->save();
        return redirect('admin/qualitylifeslang');
    }

    public function update(QualityLifesLangRequest $request)
    {
        $input = $request->all();

        $relation_id = $request->input('quality_life_id');
        $entity_lang = QualityLifesLang::where(
            'lang', '=', $input['lang']
        )->where('quality_life_id', '=', $relation_id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new QualityLifesLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->text = $input['text'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->quality_life_id = $relation_id;

        $entity_lang->save();
        return redirect('admin/qualitylifeslang');
    }
}
