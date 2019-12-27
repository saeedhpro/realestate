<?php

namespace App\Http\Resources;

use App\Advertise;
use Illuminate\Http\Resources\Json\JsonResource;
//use Illuminate\Http\Resources\Json\Resource;

class AdvertiseResource extends JsonResource
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
            'title' => $this->title,
            'address' => $this->address,
            'thumbnail' => $this->thumbnail,
            'room' => $this->room,
            'area' => $this->area,
            'advertise_type' => $this->advertise_type,
            'sell' => $this->sell,
            'rent' => $this->rent,
            're_name' => $this->real_estate->name,
            'status' => Advertise::normalPrice($this->sell / $this->area, $this->area, $this->age, 1, $this->in_floor, $this->floor, $this->unit * $this->floor, $this->has_elevator == true, $this->has_parking == true)
        ];
    }
}
