<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TaskResource extends JsonResource
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
            'user_id'=>Auth::user()->id,
            'work_type'=>$this->work_type,
            'work_hours'=>$this->work_hours,
            'date'=>$this->date,
            'color'=>$this->work_hours >= Auth::user()->settings->max_hours ? 'green' : 'red',
        ];
    }
}
