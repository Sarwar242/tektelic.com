<?php

namespace App\Http\Controllers\Admin;

use App\BindItems;
use App\Helpers\Helper;
use App\Http\Requests\UseCaseLangRequest;
use App\ItemKey;
use App\Models\Langs;
use App\Models\UseCaseLang;
use App\Models\UseCases;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UseCaseLangCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UseCaseLangCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\UseCaseLang::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/usecaselang');
        CRUD::setEntityNameStrings('usecaselang', 'use_cases_lang');

        $this->crud->setHeading('Use Cases');
        $this->crud->setSubheading('Use Case');

       // $this->crud->addButtonFromView('line', 'update-usecase', 'update-usecase', 'beginning');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'use_cases_id', 'type' => 'text', 'label' => 'Use Case Id']);
        // $this->crud->addColumn(['name' => 'category_id', 'type' => 'text', 'label' => 'Category']);
//        $this->crud->addColumn(['name' => 'use_cases_id', 'type' => 'select',
//            'label' => 'Category', 'model' => "App\Categories",'attribute' => 'name','entity' => 'useCase.category',
//            'key'=>'categoryName']);
        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addColumn(['name' => 'text', 'type' => 'text', 'label' => 'Text']);
        $this->crud->addColumn([
            'name' => 'featured',
            'label' => 'Featured',
            'type' => 'check',
        ]);

        //    $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);

        $this->crud->addColumn(['name' => 'use_cases_id', 'type' => 'select', 'label' =>
            'Status', 'model' => "App\Models\UseCases",'attribute' => 'status','entity' => 'useCase',
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
        CRUD::setValidation(UseCaseLangRequest::class);

        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();

       /* $this->crud->addField(['name' => 'category_id', 'type' => 'select', 'label' => 'Category',
            'entity' => 'categories',
            'model' => "App\Categories", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
        ]);*/
        $this->crud->addField([
            'name' => 'featured',
            'label' => 'Featured item',
            'type' => 'checkbox',
        ]);
        $this->crud->addField([
            'name' => 'position',
            'label' => 'Position',
            'type' => 'text',
        ]);
        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title (H1 Title)']);
        $this->crud->addField(['name' => 'bg_text', 'type' => 'text', 'label' => 'BG Text']);
        $this->crud->addField(['name' => 'sub_title', 'type' => 'text', 'label' => 'Sub Title (H2 Subtitle)']);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text','extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'use_cases_id', 'type' => 'hidden', 'label' => 'Use Case Id']);
        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => 1,
        ]);

       /* $this->crud->addField([
            'label' => 'Benefits',
            'type' => 'relationship',
            'name' => 'benefits', // the method that defines the relationship in your Model
            'entity' => 'benefits', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'inline_create' => ['entity' => 'benefitlang'],
            'ajax' => true,
        ]);*/

        $this->crud->addField(['name' => 'use_case_text', 'type' => 'ckeditor', 'label' => 'Use Case Text','extra_plugins' => ['justify']]);

        $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image',
            'crop' => true, // set to true to allow cropping, false to disable
          //  'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);

        $this->crud->addField(['name' => 'alt', 'type' => 'text', 'label' => 'Alt']);
        $this->crud->addField(['name' => 'pic_title', 'type' => 'text', 'label' => 'Picture Title']);

        $this->crud->addField(['name' => 'seo_title', 'type' => 'text', 'label' => 'Seo Title']);
        $this->crud->addField(['name' => 'seo_description', 'type' => 'ckeditor', 'label' => 'Seo Description','extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'search_field', 'type' => 'ckeditor', 'label' => 'Search Field','extra_plugins' => ['justify']]);
        $this->crud->setHeading('Use Case', 'create');

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
        CRUD::setValidation(UseCaseLangRequest::class);

        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();

        $id = \Route::current()->parameter('id');
        $entity = UseCaseLang::where(
            'id', '=', $id
        )->with(['useCase' => function ($query) {
        }])->first();
        $this->crud->addField([
            'name' => 'featured',
            'label' => 'Featured item',
            'type' => 'checkbox',
        ]);
        $this->crud->addField([
            'name' => 'position',
            'label' => 'Position',
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'key_id',
            'label' => 'Keys',
            'type' => 'select2_key',

            // optional
            'model'     => "App\Models\Keys", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'select_all' => true, // show Select All and Clear buttons?
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'name' => 'binds',
            'label' => 'Bind items',
            'type' => 'select2_grouped_custom',
            'attribute' => 'name',
            'model'     => "App\Binds",
            'type_resources' => ItemKey::TYPE_USE,
        ]);

        /*$this->crud->addField(['name' => 'category_id', 'type' => 'select', 'label' => 'Category',
            'entity' => 'categories',
            'model' => "App\Categories", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'default' => $entity->useCase->category_id,
        ]);*/

        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'bg_text', 'type' => 'text', 'label' => 'BG Text']);
        $this->crud->addField(['name' => 'sub_title', 'type' => 'text', 'label' => 'Sub Title']);
        $this->crud->addField(['name' => 'slug', 'type' => 'text', 'label' => 'Slug']);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text','extra_plugins' => ['justify']]);
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
            'default' => $entity->useCase->status,
        ]);

        $this->crud->addField(['name' => 'use_cases_id', 'type' => 'hidden', 'label' => 'Use Case Id']);

        $this->crud->addField(['name' => 'use_case_text', 'type' => 'ckeditor', 'label' => 'Use Case Text','extra_plugins' => ['justify']]);

        $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image','value'=>$entity->useCase->image,
            'crop' => true, // set to true to allow cropping, false to disable
            // 'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);

        $this->crud->addField(['name' => 'alt', 'type' => 'text', 'label' => 'Alt']);
        $this->crud->addField(['name' => 'pic_title', 'type' => 'text', 'label' => 'Picture Title']);

        $this->crud->addField(['name' => 'seo_title', 'type' => 'text', 'label' => 'Seo Title']);
        $this->crud->addField(['name' => 'seo_description', 'type' => 'ckeditor', 'label' => 'Seo Description','extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'search_field', 'type' => 'ckeditor', 'label' => 'Search Field','extra_plugins' => ['justify']]);
        $this->crud->setHeading('Use Case', 'update');
    }

    public function store(UseCaseLangRequest $request)
    {
        $input = $request->all();

        $entity = new UseCases();
//        $entity->category_id = $input['category_id'];
        $entity->status = $input['status'];
        $entity->image = $input['image'];
        $entity->save();


        $entity_lang = UseCaseLang::where(
            'lang', '=', $input['lang']
        )->where('use_cases_id', '=', $entity->id)->first();

        if (empty($portfolio_lang)) {
            $entity_lang = new UseCaseLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->bg_text = $input['bg_text'];
        $entity_lang->sub_title = $input['sub_title'];
        $entity_lang->text = $input['text'];
        $entity_lang->use_case_text = $input['use_case_text'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->search_field = $input['search_field'];
        $entity_lang->seo_title = $input['seo_title'];
        $entity_lang->seo_description = $input['seo_description'];
        $entity_lang->featured = $input['featured'];
        $entity_lang->position = $input['position'];
        $entity_lang->alt = $input['alt'];
        $entity_lang->pic_title = $input['pic_title'];

        $entity_lang->use_cases_id = $entity->id;

        $entity_lang->save();
        return redirect('admin/usecaselang');
    }

    public function update(UseCaseLangRequest $request)
    {
        $response = $this->traitUpdate();
        $input = $request->all();
        (new ItemKey())->setKeyAndItem($request,ItemKey::TYPE_USE);
        (new BindItems())->bind($request);
        $relation_id = $request->input('use_cases_id');

        $entity =  UseCases::where('id',$relation_id)->first();
//        $entity->category_id = $input['category_id'];
        $entity->status = $input['status'];

        if(empty($input['image'])){
            $input['image']=$entity->image;
        }
        $entity->image = $input['image'];
        $entity->save();

        $entity_lang = UseCaseLang::where(
            'lang', '=', $input['lang']
        )->where('use_cases_id', '=', $relation_id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new UseCaseLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->bg_text = $input['bg_text'];
        $entity_lang->sub_title = $input['sub_title'];
        $entity_lang->text = $input['text'];
        $entity_lang->use_case_text = $input['use_case_text'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->use_cases_id = $relation_id;
        $entity_lang->search_field = $input['search_field'];
        $entity_lang->seo_title = $input['seo_title'];
        $entity_lang->seo_description = $input['seo_description'];
        $entity_lang->slug = $input['slug'];
        $entity_lang->featured = $input['featured'];
        $entity_lang->position = $input['position'];
        $entity_lang->alt = $input['alt'];
        $entity_lang->pic_title = $input['pic_title'];
        $entity_lang->save();
        return $response;
    }


    // custom

    public function destroy($id)
    {
        /*$this->crud->hasAccessOrFail('delete');*/
        $entity_lang = UseCaseLang::where(
            'id', '=', $id
        )->with(['useCase' => function ($query) {
        }])->first();

        $entity_langs = UseCaseLang::where(
            'use_cases_id', '=', $entity_lang->use_cases_id
        )->with(['useCase' => function ($query) {
        }])->get();

        $count = $entity_langs->count();

        if($count>1) {
            return $this->crud->delete($id);
        }
        else{

            $entity = UseCases::where(
                'id', '=', $entity_lang->use_cases_id
            )->first();

            if(!empty($entity)){
                $entity_lang->delete($id);
                $entity->delete();
            }
            return 1;
        }
    }

}
