<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeEbikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $return = [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'e_bike_id' => $this->e_bike_id,
            'date_from' => $this->date_drom,
            'date_to' =>$this->date_to,
        ];
        return $return;
    }
}
