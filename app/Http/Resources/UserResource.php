<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at ? $this->created_at->toDateString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->toDateString() : null,
            'deleted_at' => $this->deleted_at ? $this->deleted_at->toDateString() : null,
            'created_by' => $this->createdBy ? $this->createdBy->name : null,
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : null,
            'deleted_by' => $this->deletedBy ? $this->deletedBy->name : null,
        ];
    }
}
