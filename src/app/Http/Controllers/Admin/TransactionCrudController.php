<?php

namespace Backpack\Transactions\app\Http\Controllers\Admin;

use Backpack\Transactions\app\Models\Transaction;

use Backpack\Transactions\app\Http\Requests\TransactionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TransactionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransactionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    private $types;
    private $usermetas;

    public function setup()
    {
        $this->crud->setModel('Backpack\Transactions\app\Models\Transaction');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/transaction');
        $this->crud->setEntityNameStrings('транзакция', 'транзакции');

        $this->types = array_unique(Transaction::pluck('type', 'type')->toArray());
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addFilter([
            'name' => 'type',
            'label' => 'Type',
            'type' => 'select2'
          ], function(){
            return $this->types;
          }, function($value){
            $this->crud->addClause('where', 'type', $value);
          });

        $this->crud->addColumn([
            'name' => 'id',
            'label' => 'ID',
        ]);

        $this->crud->addColumn([
            'name' => 'value',
            'label' => 'Сумма',
            'prefix' => '$'
        ]);

        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Статус',
        ]);
        
        $this->crud->addColumn([
            'name' => 'type',
            'label' => 'Type'
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TransactionRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
        
        // $this->crud->addField([
        //     'name' => 'usermeta_id',
        //     'label' => 'User',
        //     'entity' => 'usermeta',
        //     'attribute' => 'firstname', 
        //     'model' => 'Aimix\Account\app\Models\Usermeta',
        //     'type' => 'select2',
        // ]);
        
        // $this->crud->addField([
        //     'name' => 'type',
        //     'label' => 'Type',
        //     'type' => 'select2_from_array',
        //     'options' => [
        //       'bonus' => 'bonus',
        //       'cashback' => 'cashback',
        //       'review' => 'review',
        //       'withdraw' => 'withdraw',
        //     ]
        // ]);
        
        $this->crud->addField([
          'name' => 'value',
          'label' => 'Сумма',
          'type' => 'number',
          'attributes' => [
            'readonly' => true
          ]
        ]);
        
        $this->crud->addField([
          'name' => 'balance',
          'label' => 'Баланс',
          'type' => 'number',
          'attributes' => [
            'readonly' => true
          ]
        ]);
        
        $this->crud->addField([
          'name' => 'status',
          'label' => 'Статус',
          'attributes' => [
            'readonly' => true
          ]
        ]);
        
        $this->crud->addField([
          'name' => 'type',
          'label' => 'Тип',
          'attributes' => [
            'readonly' => true
          ]
        ]);
        
        $this->crud->addField([
          'name' => 'description',
          'label' => 'Description',
          'type' => 'textarea',
          'attributes' => [
            'rows' => 8
          ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
    
    protected function setupShowOperation()
    {
      $this->setupListOperation();
    }
}
