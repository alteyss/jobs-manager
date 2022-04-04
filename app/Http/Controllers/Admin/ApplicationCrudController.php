<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ApplicationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ApplicationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ApplicationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Application::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/application');
        CRUD::setEntityNameStrings(trans('base.application'), trans('base.applications'));

        $is_admin = backpack_user()->hasRole('Admin');
        CRUD::addClause('where', 'user_id', '=', $is_admin ? null : backpack_user()->id);
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');

        CRUD::addColumn([
            'label'     => trans('base.name'),
            'type'      => 'text',
            'name'      => 'name',
        ]);

        CRUD::addColumn([
            'label'     => trans('base.email'),
            'type'      => 'text',
            'name'      => 'email',
        ]);

        CRUD::addColumn([
            'label'     => trans('base.state'),
            'type'      => 'select',
            'name'      => 'state',
            'entity'    => 'state',
            'attribute' => 'name',
            'model'     => 'App\Models\State',
        ]);

        CRUD::addColumn([
            'label'     => trans('base.targets'),
            'type'      => 'select_multiple',
            'name'      => 'targets',
            'entity'    => 'targets',
            'attribute' => 'name',
            'model'     => 'App\Models\Target',
        ]);
       
        // CRUD::column('created_at');
        // CRUD::column('updated_at');

        $this->crud->addButtonFromView('line', 'copy', 'copy', 'end');

        if (backpack_user()->hasRole('Client')) {
            $this->crud->removeButton('create');
        }

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Show operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupShowOperation()
    {
        // $this->autoSetupShowOperation();

        $this->setupListOperation();

        // CRUD::removeColumn('resume');
        // CRUD::removeColumn('documents');

        CRUD::addColumn([
            'label'     => trans('base.degree'),
            'type'      => 'select',
            'name'      => 'degree',
            'entity'    => 'degree',
            'attribute' => 'name',
            'model'     => 'App\Models\Degree',
        ]);

        CRUD::addColumn([
            'label'     => trans('base.field'),
            'type'      => 'select',
            'name'      => 'field',
            'entity'    => 'field',
            'attribute' => 'name',
            'model'     => 'App\Models\Field',
        ]);

        CRUD::addColumn([
            'label'     => trans('base.job'),
            'type'      => 'select',
            'name'      => 'job',
            'entity'    => 'job',
            'attribute' => 'name',
            'model'     => 'App\Models\Job',
        ]);

        CRUD::addColumn([
            'label'     => trans('base.region'),
            'type'      => 'select',
            'name'      => 'region',
            'entity'    => 'region',
            'attribute' => 'name',
            'model'     => 'App\Models\Region',
        ]);

        CRUD::addColumn([
            'label'     => trans('base.department'),
            'type'      => 'select',
            'name'      => 'department',
            'entity'    => 'department',
            'attribute' => 'name',
            'model'     => 'App\Models\Department',
        ]);

        CRUD::addColumn([
            'name'    => 'resume',
            'label'   => trans('base.resume'),
            'type'    => 'upload_multiple',
            'disk'    => 'local'
        ]);

        CRUD::addColumn([
            'name'    => 'documents',
            'label'   => trans('base.documents'),
            'type'    => 'upload_multiple',
            'disk'    => 'local'
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ApplicationRequest::class);

        if (backpack_user()->hasRole('Client')) {
            CRUD::addField([
                'label'     => trans('base.name'),
                'type'      => 'text',
                'name'      => 'name', 
                'attributes' => [
                    'readonly' => 'readonly',
                ],
            ]);

            CRUD::addField([
                'label'     => trans('base.email'),
                'type'      => 'text',
                'name'      => 'email', 
                'attributes' => [
                    'readonly' => 'readonly',
                ]
            ]);

            CRUD::field('comment');

            CRUD::addField([
                'label'     => trans('base.state'),
                'type'      => 'select',
                'name'      => 'state_id', 
                'entity'    => 'state', 
                'attribute' => 'name',
                'model'     => "App\Models\State",
            ]);

            return;
        } 

        // CRUD::field('id');

        CRUD::addField([
            'label'     => trans('base.name'),
            'type'      => 'text',
            'name'      => 'name', 
        ]);

        CRUD::addField([
            'label'     => trans('base.email'),
            'type'      => 'text',
            'name'      => 'email', 
        ]);

        CRUD::addField([
            'label'     => trans('base.comment'),
            'type'      => 'text',
            'name'      => 'comment', 
        ]);

        CRUD::addField([
            'label'     => trans('base.state'),
            'type'      => 'select',
            'name'      => 'state_id', 
            'entity'    => 'state', 
            'attribute' => 'name',
            'model'     => "App\Models\State",
        ]);

        CRUD::addField([
            'label'     => trans('base.degree'),
            'type'      => 'select',
            'name'      => 'degree_id', 
            'entity'    => 'degree', 
            'attribute' => 'name',
            'model'     => "App\Models\Degree",
        ]);

        CRUD::addField([
            'label'     => trans('base.field'),
            'type'      => 'select',
            'name'      => 'field_id', 
            'entity'    => 'field', 
            'attribute' => 'name',
            'model'     => "App\Models\Field",
        ]);

        CRUD::addField([
            'label'     => trans('base.job'),
            'type'      => 'select',
            'name'      => 'job_id', 
            'entity'    => 'job', 
            'attribute' => 'name',
            'model'     => "App\Models\Job",
        ]);

        CRUD::addField([
            'label'     => trans('base.region'),
            'type'      => 'select',
            'name'      => 'region_id', 
            'entity'    => 'region', 
            'attribute' => 'name',
            'model'     => "App\Models\Region",
        ]);

        CRUD::addField([
            'label'     => trans('base.department'),
            'type'      => 'select',
            'name'      => 'department_id', 
            'entity'    => 'department', 
            'attribute' => 'name',
            'model'     => "App\Models\Department",
        ]);

        CRUD::addField([
            'label'     => trans('base.targets'),
            'type'      => 'select_multiple',
            'name'      => 'targets', 
            'entity'    => 'targets',
            'model'     => "App\Models\Target", 
            'attribute' => 'name',
            'pivot'     => true,
        ]);

        CRUD::addField([
            'name'      => 'resume',
            'label'     => trans('base.resume'),
            'type'      => 'upload_multiple',
            'upload'    => true,
            'disk'      => 'local'
        ]);
        
        CRUD::addField([
            'name'      => 'documents',
            'label'     => trans('base.documents'),
            'type'      => 'upload_multiple',
            'upload'    => true,
            'disk'      => 'local'
        ]);
        
        // CRUD::field('created_at');
        // CRUD::field('updated_at');

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
}
