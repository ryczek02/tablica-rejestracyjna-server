<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneratedPlateTest extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'unique_name' => $this->unique_name,
            'graph' => route('generateImage', ['img' => $this->unique_name])
        ];
    }
}
