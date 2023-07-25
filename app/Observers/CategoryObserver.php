<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Resource;
use App\Models\Slider;

class CategoryObserver
{
    public function deleting(Category $category): void
    {

        $this->deleteRelatedResources($category);
        $this->deleteRelatedSliders($category);
    }

    private function deleteRelatedResources(Category $category): void
    {
        if ($category->resources->isNotEmpty()) {
            foreach ($category->resources as $resource) {
                Resource::observe(ResourceObserver::class);
                $resource->delete();
            }
        }
    }

    private function deleteRelatedSliders(Category $category): void
    {
        Slider::query()->whereJsonContains('link->type', 'category')
            ->whereJsonContains('link->id', str($category->id))
            ->delete();
    }
}
