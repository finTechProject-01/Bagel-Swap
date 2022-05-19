<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class SettingResource extends JsonResource
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'total_invested'=>$this->total_invested,
            'cost'=>$this->cost,
            'opening_date'=>$this->opening_date,
        ];
    }
}
