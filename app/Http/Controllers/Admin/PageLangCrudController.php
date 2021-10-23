<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\PageLangRequest;
use App\Models\Langs;
use App\Models\Page;
use App\Models\PageLang;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PageLangCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PageLangCrudController extends CrudController
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
        CRUD::setModel(\App\Models\PageLang::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/pagelang');
        CRUD::setEntityNameStrings('pagelang', 'page_langs');

        $this->crud->setHeading('Pages');
        $this->crud->setSubheading('Page');

        //$this->crud->addButtonFromView('line', 'update-page', 'update-page', 'beginning');
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
        $this->crud->removeButton('delete');
        $this->crud->addColumn(['name' => 'page_id', 'type' => 'text', 'label' => 'Page Id']);

        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);

        $this->crud->addColumn(['name' => 'slug', 'type' => 'text', 'label' => 'Slug']);
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
        CRUD::setValidation(PageLangRequest::class);

        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();


        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'sub_title', 'type' => 'text', 'label' => 'Sub Title']);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text',]);
        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'page_id', 'type' => 'hidden', 'label' => 'Key Area Id']);
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

        $this->crud->addField(['name' => 'seo_title', 'type' => 'text', 'label' => 'Seo Title',]);
        $this->crud->addField(['name' => 'seo_description', 'type' => 'ckeditor', 'label' => 'Seo Description',]);

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
        CRUD::setValidation(PageLangRequest::class);

        $statuses = Helper::$statuses;
        $langs = Langs::getLangsArray();

        $id = \Route::current()->parameter('id');
        $entity = PageLang::where(
            'id', '=', $id
        )->with(['page' => function ($query) {
        }])->first();


        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => $entity->page->status,
        ]);
        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
      //  $this->crud->addField(['name' => 'slug', 'type' => 'text', 'label' => 'Slug']);
        $this->crud->addField(['name' => 'sub_title', 'type' => 'text', 'label' => 'Sub Title']);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text',]);
        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);
        $this->crud->addField(['name' => 'page_id', 'type' => 'hidden', 'label' => 'Key Area Id']);

        $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image','value'=>$entity->page->image,
            'crop' => true, // set to true to allow cropping, false to disable
            // 'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);

        $this->crud->addField(['name' => 'alt', 'type' => 'text', 'label' => 'Alt']);
        $this->crud->addField(['name' => 'pic_title', 'type' => 'text', 'label' => 'Picture Title']);

        $this->crud->addField(['name' => 'seo_title', 'type' => 'text', 'label' => 'Seo Title',]);
        $this->crud->addField(['name' => 'seo_description', 'type' => 'ckeditor', 'label' => 'Seo Description',]);
    }

    public function update(PageLangRequest $request)
    {
        $input = $request->all();

        $relation_id = $request->input('page_id');

        $entity =  Page::where('id',$relation_id)->first();
        $entity->status = $input['status'];

        if(empty($input['image'])){
            $input['image']=$entity->image;
        }
        $entity->image = $input['image'];
        $entity->save();

        $entity_lang = PageLang::where(
            'lang', '=', $input['lang']
        )->where('page_id', '=', $relation_id)->first();

        if (empty($entity_lang)) {
            $entity_lang = new PageLang();
        }
        $entity_lang->title = $input['title'];
        $entity_lang->sub_title = $input['sub_title'];
        $entity_lang->text = $input['text'];
        $entity_lang->lang = $input['lang'];
        $entity_lang->page_id = $relation_id;
        $entity_lang->seo_title = $input['seo_title'];
        $entity_lang->seo_description = $input['seo_description'];

        $entity_lang->alt = $input['alt'];
        $entity_lang->pic_title = $input['pic_title'];

        $entity_lang->save();
        return redirect('admin/pagelang');
    }

    public function destroy($id)
    {
        /*$this->crud->hasAccessOrFail('delete');*/
        $entity_lang = PageLang::where(
            'id', '=', $id
        )->with(['page' => function ($query) {
        }])->first();

        $entity_langs = PageLang::where(
            'page_id', '=', $entity_lang->page_id
        )->with(['page' => function ($query) {
        }])->get();

        $count = $entity_langs->count();

        if($count>1) {
            return $this->crud->delete($id);
        }
        else{

            $entity = Page::where(
                'id', '=', $entity_lang->page_id
            )->first();

            if(!empty($entity)){
                $entity_lang->delete($id);
                $entity->delete();
            }
            return 1;
        }
    }

}
