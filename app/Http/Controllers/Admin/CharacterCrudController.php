<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CharacterRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Database\Factories\CharacterFactory as CharacterFactory;

/**
 * Class CharacterCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CharacterCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Character::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/character');
        CRUD::setEntityNameStrings('character', 'characters');
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', FALSE);

        $this->crud->addColumns([
            ['name' => 'img', 'label' => 'Avatar', 'type' => 'image'],
            'nickname',
            'name',
            ['name' => 'occupations', 'label' => 'Occupations', 'type' => 'array'],
            ['name' => 'birthday', 'label' => 'Birth Day', 'type' => 'date'],
            'portrayed',
            ['name' => 'episodes', 'label' => 'Episodes', 'type' => 'relationship'],
            ['name' => 'quotes', 'label' => 'Quotes', 'type' => 'relationship']
        ]);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([
            ['name' => 'img', 'label' => 'Avatar', 'type' => 'image'],
            'nickname',
            'name',
        ]);

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
        CRUD::setValidation(CharacterRequest::class);
        $this->crud->addFields([
            ['name' => 'img', 'label' => 'Avatar', 'type' => 'image'],
            'nickname',
            'name',
            [
                'name' => 'occupations',
                'label' => 'Occupations',
                'type' => 'select2_from_array',
                'options' => CharacterFactory::$occupations,
                'allows_multiple' => TRUE,
            ],
            ['name' => 'birthday', 'label' => 'Birth Day', 'type' => 'date'],
            'portrayed',
            ['name' => 'episodes', 'label' => 'Episodes', 'type' => 'relationship'],
            ['name' => 'quotes', 'label' => 'Quotes', 'type' => 'relationship']
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
        $this->setupCreateOperation();
    }
}
