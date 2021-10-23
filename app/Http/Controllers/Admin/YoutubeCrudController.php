<?php

//sd
namespace App\Http\Controllers\Admin;


use App\Models\Youtubes;
use App\Http\Requests\YoutubeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PdfCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class YoutubeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Youtubes::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/youtube');
        $this->crud->setEntityNameStrings('youtube', 'Youtube');
        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | LIST OPERATION
        |--------------------------------------------------------------------------
        */
        $this->crud->operation('list', function () {
            $this->crud->addColumn(['name' => 'link_one', 'type' => 'text', 'label' => 'Link 1']);
            $this->crud->addColumn(['name' => 'link_two', 'type' => 'text', 'label' => 'Link 2']);
            $this->crud->addColumn(['name' => 'link_three', 'type' => 'text', 'label' => 'Link 3']);
        });

        /*
        |--------------------------------------------------------------------------
        | CREATE & UPDATE OPERATIONS
        |--------------------------------------------------------------------------
        */
        $this->crud->operation(['create', 'update'], function () {
            $this->crud->setValidation(YoutubeRequest::class);
            $this->crud->addField([
                'name' => 'link_one',
                'label' => 'Link 1',
                'type' => 'text',
                'placeholder' => 'Your link here',
            ]);
            $this->crud->addField([
                'name' => 'link_two',
                'label' => 'Link 2',
                'type' => 'text',
                'placeholder' => 'Your link here',
            ]);
            $this->crud->addField([
                'name' => 'link_three',
                'label' => 'Link 3',
                'type' => 'text',
                'placeholder' => 'Your link here',
            ]);
        });
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Category model.
     * @return JSON
     */
    public function fetchcategories()
    {
        return $this->fetch(\Backpack\NewsCRUD\app\Models\Category::class);
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Tag model.
     * @return JSON
     */
    public function fetchTags()
    {
        return $this->fetch(\Backpack\NewsCRUD\app\Models\Tag::class);
    }

    /**
     * @param ArticleRequest $request
     * @return \Backpack\CRUD\app\Http\Controllers\Operations\Response
     */
    public function update(YoutubeRequest $request)
    {
        $response = $this->traitUpdate();
        return $response;
    }

}
