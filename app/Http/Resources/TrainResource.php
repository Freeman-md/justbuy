<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainResource extends JsonResource
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
            'id' => $this->resource['train_num'],
            'name' => $this->resource['name'],
            'from' => $this->resource['train_from'],
            'to' => $this->resource['train_to']
        ];
    }
}
