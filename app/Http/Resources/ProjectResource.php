<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $links = [
            [
                'url' => $this->github,
                'icon' => 'fab fa-github-alt'
            ],
            [
                'url' => $this->live,
                'icon' => 'fas fa-external-link-alt'
            ]
        ];

        $technologies = explode(',', $this->stacks);
        $technologies = array_map(function($technology) {
            return trim($technology);
        }, $technologies);

        return [
            'title' => $this->title,
            'content' => $this->description,
            'links' => $links,
            'technologies' => $technologies,
            'starred' => $this->star === 1
        ];
    }
}
