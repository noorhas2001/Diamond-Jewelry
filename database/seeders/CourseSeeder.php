<?php

namespace Database\Seeders;

use App\Models\Course;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    public function run(): void
    {
        $this->createCourse(
            'Course Graphic Design',
            1,
            'assets/img/train1.jpg',
            1,
            55,
            60,
            60,
            16,
            'Graphic Design-(60 hours)',
            ['monday', 'wednesday'],
            $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d H:i:s')
        );

        $this->createCourse(
            'E-marketing Course',
            1,
            'assets/img/train1.jpg',
            1,
            70,
            81,
            60,
            16,
            'E-marketing (81 hours)',
            ['monday', 'wednesday'],
            $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d H:i:s')
        );

        $this->createCourse(
            'E-marketing Course',
            1,
            'assets/img/train1.jpg',
            1,
            70,
            81,
            60,
            16,
            'E-marketing (81 hours)',
            ['monday', 'wednesday'],
            $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d H:i:s')
        );

        $this->createCourse(
            'AI',
            1,
            'assets/img/train1.jpg',
            1,
            70,
            39,
            60,
            16,
            'AI (39 hours)',
            ['monday', 'wednesday'],
            $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d H:i:s')
        );

        $this->createCourse(
            'Front end',
            1,
            'assets/img/train1.jpg',
            1,
            110,
            72,
            60,
            16,
            'Front end (72 hours)',
            ['monday', 'wednesday'],
            $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d H:i:s')
        );

        $this->createCourse(
            'voice over',
            1,
            'assets/img/train1.jpg',
            1,
            51,
            21,
            60,
            16,
            'voice over (21 hours)',
            ['monday', 'wednesday'],
            $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d H:i:s')
        );

        $this->createCourse(
            'montage video',
            1,
            'assets/img/train1.jpg',
            1,
            90,
            36,
            60,
            16,
            'montage video (21 hours)',
            ['monday', 'wednesday'],
            $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d H:i:s')
        );
    }

    public function createCourse(
        $name,
        $active,
        $image,
        $added_by,
        $price,
        $hours,
        $lecture_hours,
        $number_seats,
        $description,
        $course_days,
        $start_date
    ) {
        $course = new Course();
        $course->name = $name;
        $course->active = $active;
        $course->added_by = $added_by;
        $course->price = $price;
        $course->hours = $hours;
        $course->lecture_hours = $lecture_hours;
        $course->number_seats = $number_seats;
        $course->description = $description;
        $course->course_days = json_encode($course_days);
        $course->start_date = $start_date;

        $course->save();
        $image = $course->addAssetImage($image, Course::COURSE_IMAGE_TAG);
        $course->image = $image->id;
        $course->save();
    }
}
