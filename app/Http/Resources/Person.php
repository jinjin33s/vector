<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Person extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //eturn parent::toArray($request);

        // detail for showing results
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'email' => $this->email,
            "interests" => $this->interests->pluck('name'),
            "admission_date" => $this->admission_date,
            "admission_time" => $this->admission_time,
            "is_active" => $this->is_active
        ];
    }
}
