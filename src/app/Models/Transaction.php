<?php

namespace Backpack\Transactions\app\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;


// FACTORY
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\Transactions\database\factories\TransactionFactory;

class Transaction extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'ak_transactions';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
      'extras' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function toArray() {
      return [
        'id' => $this->id,
        'value' => $this->value,
        'balance' => $this->balance,
        'status' => $this->status,
        'type' => $this->type,
        'description' => nl2br($this->description),
        'created_at' => $this->created_at,
      ];
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
      return TransactionFactory::new();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function transactionable() {
      return $this->morphTo();
    }

    // public function usermeta(){
    //     return $this->belongsTo('Aimix\Account\app\Models\Usermeta');
    // }

    public function owner(){
        return $this->belongsTo(config('backpack.transactions.owner_model', 'Backpack\Profile\app\Models\Profile'));
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
