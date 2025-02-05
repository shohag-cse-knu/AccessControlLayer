<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'designation' => $this->designation,
            'role_name' => $this->role ? $this->role->name : '',
            'menus_count' => $this->role ? $this->role->menus->count() : 0,
            'created_at' => $this->created_at->format('d-m-Y h:i A'),
            'created_by' => $this->createdBy ? $this->createdBy->name : '',
        ];
    }
}
