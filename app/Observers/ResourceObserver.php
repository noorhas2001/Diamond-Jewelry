<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\Resource;
use App\Models\Slider;

class ResourceObserver
{
    public function deleting(Resource $resource): void
    {
        $this->deleteRelatedReservations($resource);
        $this->deleteRelatedSliders($resource);
    }

    private function deleteRelatedReservations(Resource $resource): void
    {
        if ($resource->reservations->isNotEmpty()) {
            $resource->reservations()->delete();
        }
    }

    private function deleteRelatedCourses(Resource $resource): void
    {
        if ($resource->courses->isNotEmpty()) {
            foreach ($resource->courses as $course) {
                Course::observe(CourseObserver::class);
                $course->delete();
            }
        }
    }

    private function deleteRelatedSliders(Resource $resource): void
    {
        Slider::query()->whereJsonContains('link->type', 'resource')
            ->whereJsonContains('link->id', str($resource->id))
            ->delete();
    }

}

