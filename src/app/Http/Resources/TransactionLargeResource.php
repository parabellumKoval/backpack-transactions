<?php

namespace Backpack\Transactions\app\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionLargeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
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
}
