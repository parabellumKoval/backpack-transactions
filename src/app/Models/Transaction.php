<?php

namespace Backpack\Transactions\app\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use CrudTrait;

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
        'created_at' => $this->created_at->format('Y-m-d H:i:s'),
      ];
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

    // public function order(){
    //     return $this->belongsTo('Aimix\Shop\app\Models\Order');
    // }
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
