<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\ReservationTime;
use App\Models\Slider;

class CourseObserver
{
    public function deleting(Course $course): void
    {
        $this->deleteRelatedSliders($course);
        $this->deleteRelatedSubscriptions($course);
        $this->deleteRelatedReservations($course);
    }

    private function deleteRelatedSubscriptions(Course $course): void
    {
        if ($course->subscriptions->isNotEmpty()) {
            $course->subscriptions()->delete();
        }
    }

    private function deleteRelatedSliders(Course $course): void
    {
        Slider::query()->whereJsonContains('link->type', 'course')
            ->whereJsonContains('link->id', (string) $course->id)
            ->delete();
    }

    private function deleteRelatedReservations(Course $course): void
    {
        foreach ($course->reservations as $reservation) {
            $reservation->delete();
        }
    }
}

