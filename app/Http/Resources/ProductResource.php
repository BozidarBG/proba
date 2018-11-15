<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
//transformer description ide klijentu a kod nas je details
        return [
            'name'=>$this->name,
            'description'=>$this->details,
            'price'=>$this->price,
            'stock'=>$this->stock== 0 ? 'Out of stock' :$this->stock,
            'discount'=>$this->discount,
            'totalPrice'=>round((1-$this->discount/100)*$this->price, 2),
            'rating'=>$this->reviews->count() > 0 ?
                round($this->reviews->sum('star')/$this->reviews->count())
                : 'No rating',
            'href'=>[
                'reviews'=>route('reviews.index', $this->id)
            ]
        ];
    }
}
