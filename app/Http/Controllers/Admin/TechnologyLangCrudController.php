<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\TechnologyLangRequest;
use App\Models\Langs;
use App\Models\Technology;
use App\Models\TechnologyLang;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TechnologyLangCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TechnologyLangCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
   // use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
  //  use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\TechnologyLang::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/technologylang');
        CRUD::setEntityNameStrings('technologylang', 'technology_langs');

        $this->crud->setHeading('Sections');
        $this->crud->setSubheading('section');

       // $this->crud->addButtonFromView('line', 'update-technology', 'update-technology', 'beginning');
        $this->crud->addButtonFromView('top', 'create-technology', 'create-technology', 'beginning');
        $this->crud->addButtonFromView('top', 'create2-technology', 'create2-technology', 'beginning');
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
        $lang = Helper::ENG;

       /* $tech = TechnologyLang::where('id',16)->with(['technologyUseCase' => function ($query) {
            //$query->where('entity_id',17);
            $query->with(['useCase' => function ($query2) {
                $query2->with(['useCaseLangOne' => function ($query3) {
        }]);
        }]);

        }])->first();

        dd($tech);*/

        $this->crud->addColumn(['name' => 'technology_id', 'type' => 'text', 'label' => 'Section Id']);
        $this->crud->addColumn(['name' => 'lang', 'type' => 'text', 'label' => 'Lang']);
        // $this->crud->addColumn(['name' => 'category_id', 'type' => 'text', 'label' => 'Category']);

        if(isset($_GET['type']) && $_GET['type']==1){
            $this->crud->addColumn(['name' => 'technology_id', 'type' => 'select', 'label' =>
                'Section ', 'model' => "App\Models\Technology",'attribute' => 'title','entity' => 'technologyKeyArea.keyArea.keyAreaLangOne',
                'key'=>'entValue']);
        }
        else{
            $this->crud->addColumn(['name' => 'technology_id', 'type' => 'select', 'label' =>
                'Section ', 'model' => "App\Models\Technology",'attribute' => 'title','entity' => 'technologyUseCase.useCase.useCaseLangOne',
                'key'=>'entValue']);
        }


        $this->crud->addColumn(['name' => 'technology_id', 'type' => 'select', 'label' =>
            'Section Type', 'model' => "App\Models\Technology",'attribute' => 'section_type','entity' => 'technology',
            'key'=>'sectypeValue']);

        $this->crud->addColumn(['name' => 'technology_id', 'type' => 'select', 'label' =>
            'Entity Type', 'model' => "App\Models\Technology",'attribute' => 'entity_type','entity' => 'technology',
            'key'=>'enttypeValue']);

        $this->crud->addColumn(['name' => 'technology_id', 'type' => 'select', 'label' =>
            'Position', 'model' => "App\Models\Technology",'attribute' => 'pos','entity' => 'technology',
            'key'=>'posValue']);

        $this->crud->addColumn(['name' => 'technology_id', 'type' => 'select', 'label' =>
            'Type', 'model' => "App\Models\Technology",'attribute' => 'type','entity' => 'technology',
            'key'=>'typeValue']);
        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        // $this->crud->addColumn(['name' => 'text', 'type' => 'text', 'label' => 'Text']);
        $this->crud->addColumn(['name' => 'lang', 'type' => 'text', 'label' => 'Lang']);

        //    $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);

        $this->crud->addColumn(['name' => 'technology_id', 'type' => 'select', 'label' =>
            'Status', 'model' => "App\Models\Technology",'attribute' => 'status','entity' => 'technology',
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
        CRUD::setValidation(TechnologyLangRequest::class);

        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();
        $types = Helper::$types;
        $entity_types = Helper::getEntityArray();
        $section_types = Helper::$common_section_types;
        $positions = Helper::$positions;

        if(isset($_GET['type']) && $_GET['type']==1){
            $entities = Helper::getKeyAreasArray();
            $entity_label = 'Key Area';
            $section_types_def = Helper::$common_section_types['key_area'];

        }
        else{
            $entities = Helper::getUseCasesArray();
            $entity_label = 'Use Case';
            $section_types_def = Helper::$common_section_types['use_case'];
        }


        $this->crud->addField(['name' => 'entity_id', 'label' => $entity_label,
            'type' => 'select_from_array',
            'options' => $entities,
            'allows_null' => false,
            //'default' => 1,
        ]);

        $this->crud->addField(['name' => 'section_type', 'label' => 'Section Type',
            'type' => 'select_from_array',
            'options' => $section_types,
            'allows_null' => false,
            'default' => $section_types_def,
        ]);

        $this->crud->addField(['name' => 'entity_type', 'label' => 'Entity Type',
            'type' => 'select_from_array',
            'options' => $entity_types,
            'allows_null' => false,
            //'default' => 1,
        ]);


        $this->crud->addField(['name' => 'type', 'label' => 'Type',
            'type' => 'select_from_array',
            'options' => $types,
            'allows_null' => false,
            //'default' => 1,
        ]);

        $this->crud->addField(['name' => 'pos', 'label' => 'Position',
            'type' => 'select_from_array',
            'options' => $positions,
            'allows_null' => false,
            //'default' => 1,
        ]);

        $this->crud->addField(['name' => 'title', 'type' => 'ckeditor', 'label' => 'Title','extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text','extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'technology_id', 'type' => 'hidden', 'label' => 'Key Area Id']);
        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => 1,
        ]);
        $this->crud->addField(['name' => 'image', 'type' => 'upload', 'label' => 'Image','upload'=> true
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
        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();

        $types = Helper::$types;
        $entity_types = Helper::getEntityArray();
        $section_types = Helper::$common_section_types;
        $positions = Helper::$positions;

        $id = \Route::current()->parameter('id');
        $entity = TechnologyLang::where(
            'id', '=', $id
        )->with(['technology' => function ($query) {
        }])->first();

        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => $entity->technology->status,
        ]);

        if($entity->technology->section_type=='key_area'){
            $entities = Helper::getKeyAreasArray();
            $entity_label = 'Key Area';
            $section_types_def = Helper::$common_section_types['key_area'];

        }
        else{
            $entities = Helper::getUseCasesArray();
            $entity_label = 'Use Case';
            $section_types_def = Helper::$common_section_types['use_case'];
        }


        $this->crud->addField(['name' => 'entity_id', 'label' => $entity_label,
            'type' => 'select_from_array',
            'options' => $entities,
            'allows_null' => false,
            'default' => $entity->technology->entity_id,
        ]);

       /* $this->crud->addField(['name' => 'section_type', 'label' => 'Section Type',
            'type' => 'select_from_array',
            'options' => $section_types,
            'allows_null' => false,
            'default' => $entity->technology->section_type,
        ]);*/

        $this->crud->addField(['name' => 'entity_type', 'label' => 'Entity Type',
            'type' => 'select_from_array',
            'options' => $entity_types,
            'allows_null' => false,
            'default' =>  $entity->technology->entity_type,
        ]);


        $this->crud->addField(['name' => 'type', 'label' => 'Type',
            'type' => 'select_from_array',
            'options' => $types,
            'allows_null' => false,
            'default' =>  $entity->technology->type,
        ]);

        $this->crud->addField(['name' => 'pos', 'label' => 'Position',
            'type' => 'select_from_array',
            'options' => $positions,
            'allows_null' => false,
            'default' => $entity->technology->pos,
        ]);


        $this->crud->addField(['name' => 'title', 'type' => 'ckeditor', 'label' => 'Title','extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text','extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'technology_id', 'type' => 'hidden', 'label' => 'Key Area Id']);
        $this->crud->addField(['name' => 'image', 'type' => 'upload', 'label' => 'Image','upload'=> true,'value'=>$entity->technology->image,
        ]);
        $this->crud->addField(['name' => 'alt', 'type' => 'text', 'label' => 'Alt']);
        $this->crud->addField(['name' => 'pic_title', 'type' => 'text', 'label' => 'Picture Title']);

    }

    public function store(TechnologyLangRequest $request)
    {
        $input = $request->all();

        $entity = new Technology();
        $entity->status = $input['status'];
        $entity->type = $input['type'];
        $entity->section_type = $input['section_type'];
        $entity->entity_id = $input['entity_id'];
        $entity->entity_type = $input['entity_type'];
        $entity->pos = $input['pos'];
        if(empty($input['image'])){
            $input['image']=null;
        }
        $entity->image = $input['image'];
        $entity->save();


        $entity_lang = TechnologyLang::where(
            'lang', '=', $input['lang']
        )->where('technology_id', '=', $entity->id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new TechnologyLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->text = $input['text'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->alt = $input['alt'];
        $entity_lang->pic_title = $input['pic_title'];
        $entity_lang->technology_id = $entity->id;

        $entity_lang->save();
        return redirect('admin/technologylang');
    }

    public function update(TechnologyLangRequest $request)
    {
        $response = $this->traitUpdate();
        $input = $request->all();

        $relation_id = $request->input('technology_id');

        $entity =  Technology::where('id',$relation_id)->first();

        $entity->status = $input['status'];
        if(empty($input['image'])){
            $input['image']=$entity->image;
        }
        $entity->image = $input['image'];

        $entity->type = $input['type'];
      //  $entity->section_type = $input['section_type'];
        $entity->entity_id = $input['entity_id'];
        $entity->entity_type = $input['entity_type'];
        $entity->pos = $input['pos'];

        $entity->save();

        $entity_lang = TechnologyLang::where(
            'lang', '=', $input['lang']
        )->where('technology_id', '=', $relation_id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new TechnologyLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->text = $input['text'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->alt = $input['alt'];
        $entity_lang->pic_title = $input['pic_title'];
        $entity_lang->technology_id = $relation_id;

        $entity_lang->save();
        return $response;
    }


    public function destroy($id)
    {
        /*$this->crud->hasAccessOrFail('delete');*/
        $entity_lang = TechnologyLang::where(
            'id', '=', $id
        )->with(['technology' => function ($query) {
        }])->first();

        $entity_langs = TechnologyLang::where(
            'technology_id', '=', $entity_lang->technology_id
        )->with(['technology' => function ($query) {
        }])->get();

        $count = $entity_langs->count();

        if($count>1) {
            return $this->crud->delete($id);
        }
        else{

            $entity = Technology::where(
                'id', '=', $entity_lang->technology_id
            )->first();

            if(!empty($entity)){
                $entity_lang->delete($id);
                $entity->delete();
            }
            return 1;
        }
    }
}
