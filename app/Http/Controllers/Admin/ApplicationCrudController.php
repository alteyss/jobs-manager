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
        CRUD::setEntityNameStrings('application', 'applications');

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
        CRUD::column('name');
        CRUD::column('email');
        CRUD::addColumn([
            'label'     => 'Targets',
            'type'      => 'select_multiple',
            'name'      => 'targets',
            'entity'    => 'targets',
            'attribute' => 'name',
            'model'     => 'App\Models\Target',
        ]);
        // CRUD::column('created_at');
        // CRUD::column('updated_at');

        $this->crud->addButtonFromView('line', 'copy', 'copy', 'end');

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
        $this->autoSetupShowOperation();

        CRUD::removeColumn('resume');
        CRUD::removeColumn('documents');

        CRUD::addColumn([
            'name'    => 'resume',
            'label'   => 'CV',
            'type'    => 'upload_multiple',
            'disk'    => 'local'
        ]);

        CRUD::addColumn([
            'name'    => 'documents',
            'label'   => 'Documents',
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

        // CRUD::field('id');
        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('comment');
        CRUD::addField([
            'label'     => 'State',
            'type'      => 'select',
            'name'      => 'state_id', 
            'entity'    => 'state', 
            'attribute' => 'name',
            'model'     => "App\Models\State",
        ]);
        CRUD::addField([
            'label'     => 'Degree',
            'type'      => 'select',
            'name'      => 'degree_id', 
            'entity'    => 'degree', 
            'attribute' => 'name',
            'model'     => "App\Models\Degree",
        ]);
        CRUD::addField([
            'label'     => 'Field',
            'type'      => 'select',
            'name'      => 'field_id', 
            'entity'    => 'field', 
            'attribute' => 'name',
            'model'     => "App\Models\Field",
        ]);
        CRUD::addField([
            'label'     => 'Job',
            'type'      => 'select',
            'name'      => 'job_id', 
            'entity'    => 'job', 
            'attribute' => 'name',
            'model'     => "App\Models\Job",
        ]);
        CRUD::addField([
            'label'     => 'Region',
            'type'      => 'select',
            'name'      => 'region_id', 
            'entity'    => 'region', 
            'attribute' => 'name',
            'model'     => "App\Models\Region",
        ]);
        CRUD::addField([
            'label'     => 'Department',
            'type'      => 'select',
            'name'      => 'department_id', 
            'entity'    => 'department', 
            'attribute' => 'name',
            'model'     => "App\Models\Department",
        ]);
        CRUD::addField([
            'label'     => 'Targets',
            'type'      => 'select_multiple',
            'name'      => 'targets', 
            'entity'    => 'targets',
            'model'     => "App\Models\Target", 
            'attribute' => 'name',
            'pivot'     => true,
        ]);
        CRUD::addField([
            'name'      => 'resume',
            'label'     => 'CV',
            'type'      => 'upload_multiple',
            'upload'    => true,
            'disk'      => 'local'
        ]);
        CRUD::addField([
            'name'      => 'documents',
            'label'     => 'Documents',
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
