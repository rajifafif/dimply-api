<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        $data = array_merge($data, [
            'tenant' => array_merge($this->tenant->toArray(), [
                'distance_m' => 100,
                'banner_url' => $this->files->first()->file_url ?? ''
            ]),
            'banner_url' => $this->files->first()->file_url ?? ''
        ]);

        return $data;
        return parent::toArray($request);
    }
}
