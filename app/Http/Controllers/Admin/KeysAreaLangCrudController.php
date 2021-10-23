<?php

namespace App\Http\Controllers\Admin;

use App\BindItems;
use App\Helpers\Helper;
use App\Http\Requests\KeysAreaLangRequest;
use App\ItemKey;
use App\Models\KeyAres;
use App\Models\Keys;
use App\Models\KeysAreaLang;
use App\Models\Langs;
use App\Models\UseCaseLang;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class KeysAreaLangCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class KeysAreaLangCrudController extends CrudController
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
        CRUD::setModel(\App\Models\KeysAreaLang::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/keysarealang');
        CRUD::setEntityNameStrings('keysarealang', 'keys_area_lang');

        $this->crud->setHeading('Key Areas');
        $this->crud->setSubheading('Key Area');

      //  $this->crud->addButtonFromView('line', 'update-keyarea', 'update-keyarea', 'beginning');
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
        $this->crud->addColumn(['name' => 'key_ares_id', 'type' => 'text', 'label' => 'Key Area Id']);
       // $this->crud->addColumn(['name' => 'category_id', 'type' => 'text', 'label' => 'Category']);

       /* $this->crud->addColumn(['name' => 'key_ares_id', 'type' => 'select',
            'label' => 'Category', 'model' => "App\Categories",'attribute' => 'name','entity' => 'keyArea.category',
            'key'=>'categoryName']);*/

        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);

        $this->crud->addColumn(['name' => 'text', 'type' => 'text', 'label' => 'Text']);
        $this->crud->addColumn([
            'name' => 'featured',
            'label' => 'Featured',
            'type' => 'check',
        ]);

      //  $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);

        $this->crud->addColumn(['name' => 'key_ares_id', 'type' => 'select', 'label' =>
            'Status', 'model' => "App\Models\KeyAres",'attribute' => 'status','entity' => 'keyArea',
            'key'=>'statusValue']);

        $this->crud->setHeading('Key Areas', 'list');
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
        CRUD::setValidation(KeysAreaLangRequest::class);

      //  CRUD::setFromDb(); // fields
        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();

        /*$this->crud->addField(['name' => 'category_id', 'type' => 'select', 'label' => 'Category',
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
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text', 'extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'key_ares_id', 'type' => 'hidden', 'label' => 'Key Area Id']);
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

        $this->crud->addField(['name' => 'seo_title', 'type' => 'text', 'label' => 'Seo Title']);
        $this->crud->addField(['name' => 'seo_description', 'type' => 'ckeditor', 'label' => 'Seo Description']);

        $this->crud->addField(['name' => 'search_field', 'type' => 'ckeditor', 'label' => 'Search Field']);

        $this->crud->setHeading('Key Area', 'create');

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
        CRUD::setValidation(KeysAreaLangRequest::class);

        //  CRUD::setFromDb(); // fields
        $statuses = KeyAres::$statuses;
        $langs = Langs::getLangsArray();


        /*$this->crud->addField([
            'name'        => 'key_id',
            'label'       => "Type",
            'type'        => 'select_from_array',
            'options'     => Keys::all()->keyBy('id')->pluck('name', 'id')->toArray(),
            'allows_null' => false,
        ]);*/
        $this->crud->addField([
            'name' => 'key_id',
            'label' => 'Keys',
            'type' => 'select2_key',
            'model'     => "App\Models\Keys", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'select_all' => true, // show Select All and Clear buttons?
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $id = \Route::current()->parameter('id');
        $entity = KeysAreaLang::where(
            'id', '=', $id
        )->with(['keyArea' => function ($query) {
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
        /*$this->crud->addField(['name' => 'category_id', 'type' => 'select', 'label' => 'Category',
            'entity' => 'categories',
            'model' => "App\Categories", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'default' => $entity->keyArea->category_id,
        ]);*/
        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => $entity->keyArea->status,
        ]);


        $this->crud->addField([
            'name' => 'key_id',
            'label' => 'Keys',
            'type' => 'select2_key',

            // optional
            'model'     => "App\Models\Keys", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'select_all' => true, // show Select All and Clear buttons?
            'pivot' => false,
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
            'type_resources' => ItemKey::TYPE_AREA,
        ]);


        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title (H1 Title)']);
        $this->crud->addField(['name' => 'bg_text', 'type' => 'text', 'label' => 'BG Text']);
        $this->crud->addField(['name' => 'sub_title', 'type' => 'text', 'label' => 'Sub Title (H2 Subtitle)']);
        $this->crud->addField(['name' => 'slug', 'type' => 'text', 'label' => 'Slug']);
        $this->crud->addField([
            'name' => 'text',
            'type' => 'ckeditor',
            'label' => 'Text',
            'extra_plugins' => ['justify'],
            ]);
        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'key_ares_id', 'type' => 'hidden', 'label' => 'Key Area Id']);

        $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image','value'=>$entity->keyArea->image,
            'crop' => true, // set to true to allow cropping, false to disable
            // 'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);

        $this->crud->addField(['name' => 'alt', 'type' => 'text', 'label' => 'Alt']);
        $this->crud->addField(['name' => 'pic_title', 'type' => 'text', 'label' => 'Picture Title']);

        $this->crud->addField(['name' => 'seo_title', 'type' => 'text', 'label' => 'Seo Title']);
        $this->crud->addField(['name' => 'seo_description', 'type' => 'ckeditor', 'label' => 'Seo Description']);
        $this->crud->addField(['name' => 'search_field', 'type' => 'ckeditor', 'label' => 'Search Field']);
        $this->crud->setHeading('Key Area', 'update');
    }

    public function store(KeysAreaLangRequest $request)
    {
        $input = $request->all();

        $entity = new KeyAres();
//        $entity->category_id = $input['category_id'];
        $entity->status = $input['status'];
        $entity->image = $input['image'];
        if(!empty($input['key_id'])) {
            $entity->key_id = $input['key_id'];
        }
        else{
            $entity->key_id =0;
        }
        $entity->save();


        $entity_lang = KeysAreaLang::where(
            'lang', '=', $input['lang']
        )->where('key_ares_id', '=', $entity->id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new KeysAreaLang();
        }

        if (empty($entity_main)) {
            $entity_main = new KeyAres();
        }


        $entity_lang->title = $input['title'];
        $entity_lang->bg_text = $input['bg_text'];
        $entity_lang->sub_title = $input['sub_title'];
        $entity_lang->text = $input['text'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->featured = $input['featured'];
        $entity_lang->position = $input['position'];

        $entity_lang->alt = $input['alt'];
        $entity_lang->pic_title = $input['pic_title'];

        $entity_lang->seo_title = $input['seo_title'];
        $entity_lang->seo_description = $input['seo_description'];
        $entity_lang->search_field = $input['search_field'];
        $entity_lang->key_ares_id = $entity->id;

        $entity_lang->save();
        return redirect('admin/keysarealang');
    }

    public function update(KeysAreaLangRequest $request)
    {
        $response = $this->traitUpdate();
        $input = $request->all();
        (new ItemKey())->setKeyAndItem($request,ItemKey::TYPE_AREA);
        (new BindItems())->bind($request);
        $relation_id = $request->input('key_ares_id');

        $entity =  KeyAres::where('id',$relation_id)->first();
//        $entity->category_id = $input['category_id'] ?? ;
        $entity->status = $input['status'];
        if(empty($input['image'])){
            $input['image']=$entity->image;
        }
        $entity->image = $input['image'];
        $entity->save();

        $entity_lang = KeysAreaLang::where(
            'lang', '=', $input['lang']
        )->where('key_ares_id', '=', $relation_id)->first();


        $entity_main = KeyAres::where('id','=',$relation_id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new KeysAreaLang();
        }

        if (empty($entity_main)) {
            $entity_main = new KeyAres();
        }
        $entity_main->save();

        $entity_lang->title = $input['title'];
        $entity_lang->bg_text = $input['bg_text'];
        $entity_lang->sub_title = $input['sub_title'];
        $entity_lang->text = $input['text'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->search_field = $input['search_field'];
        $entity_lang->slug = $input['slug'];
        $entity_lang->seo_title = $input['seo_title'];
        $entity_lang->seo_description = $input['seo_description'];
        $entity_lang->featured = $input['featured'];
        $entity_lang->position = $input['position'];

        $entity_lang->alt = $input['alt'];
        $entity_lang->pic_title = $input['pic_title'];

        $entity_lang->key_ares_id = $relation_id;

        $entity_lang->save();
        return $response;
    }

    public function destroy($id)
    {
        /*$this->crud->hasAccessOrFail('delete');*/
        $entity_lang = KeysAreaLang::where(
            'id', '=', $id
        )->with(['keyArea' => function ($query) {
        }])->first();

        $entity_langs = KeysAreaLang::where(
            'key_ares_id', '=', $entity_lang->key_ares_id
        )->with(['keyArea' => function ($query) {
        }])->get();

        $count = $entity_langs->count();

        if($count>1) {
            return $this->crud->delete($id);
        }
        else{

            $entity = KeyAres::where(
                'id', '=', $entity_lang->key_ares_id
            )->first();

            if(!empty($entity)){
                $entity_lang->delete($id);
                $entity->delete();
            }
            return 1;
        }
    }

}
