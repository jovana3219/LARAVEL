<?php

namespace App\Http\Resources;

use App\Models\Tip;
use App\Models\Ukus;
use Illuminate\Http\Resources\Json\JsonResource;

class ProizvodResurs extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $ukus = Ukus::find($this->ukusId);
        $tip = Tip::find($this->tipId);
        return [
            'id' => $this->id,
            'tip' => $tip->tip,
            'naziv' => $this->naziv,
            'ukus' => $ukus->ukus,
            'cena' => $this->cena
        ];
    }
}
