<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{

    public function run(): void
    {
        $this->createResource(
            name: 'Training Room 1',
            description: 'The room contains 50 seat',
            added_by: 1,
            category_id: 1,
            number_seats: 50,
            price_by_hour: 5,
            price_by_day: 10,
            price_by_weak: 20,
            price_by_month: 30,
            published: 1,
            imagePath: 'assets/img/train1.jpg',
        );

        $this->createResource(
            name: 'Training Room 2',
            description: 'The room contains 40 seat',
            added_by: 1,
            category_id: 1,
            number_seats: 40,
            price_by_hour: 5,
            price_by_day: 10,
            price_by_weak: 20,
            price_by_month: 30,
            published: 1,
            imagePath: 'assets/img/train1.jpg',
        );

        $this->createResource(
            name: 'Training Room 3',
            description: 'The room contains 40 seat',
            added_by: 1,
            category_id: 1,
            number_seats: 40,
            price_by_hour: 5,
            price_by_day: 10,
            price_by_weak: 20,
            price_by_month: 30,
            published: 1,
            imagePath: 'assets/img/train1.jpg',
        );

        $this->createResource(
            name: 'Training Room 4',
            description: 'The room contains 35 seat',
            added_by: 1,
            category_id: 1,
            number_seats: 35,
            price_by_hour: 10,
            price_by_day: 50,
            price_by_weak: 150,
            price_by_month: 500,
            published: 1,
            imagePath: 'assets/img/train1.jpg',
        );

        $this->createResource(
            name: 'Training Room 5',
            description: 'The room contains 10 seat',
            added_by: 1,
            category_id: 1,
            number_seats: 10,
            price_by_hour: 4,
            price_by_day: 9,
            price_by_weak: 30,
            price_by_month: 100,
            published: 1,
            imagePath: 'assets/img/train1.jpg',
        );

        $this->createResource(
            name: 'Training Room 6',
            description: 'The room contains 1 seat',
            added_by: 1,
            category_id: 1,
            number_seats: 1,
            price_by_hour: 2,
            price_by_day: 5,
            price_by_weak: 20,
            price_by_month: 50,
            published: 1,
            imagePath: 'assets/img/train1.jpg',
        );
    }

    public function createResource(
        $name,
        $description,
        $added_by,
        $category_id,
        $number_seats,
        $price_by_hour,
        $price_by_day,
        $price_by_weak,
        $price_by_month,
        $published,
        $imagePath
    ) {
        $resource = new Resource();
        $resource->name = $name;
        $resource->added_by = $added_by;
        $resource->description = $description;
        $resource->category_id = $category_id;
        $resource->number_seats = $number_seats;
        $resource->price_by_hour = $price_by_hour;
        $resource->price_by_day = $price_by_day;
        $resource->price_by_weak = $price_by_weak;
        $resource->price_by_month = $price_by_month;
        $resource->published = $published;
        $resource->save();

        $image = $resource->addAssetImage($imagePath, Resource::RESOURCE_IMAGE_TAG);

        $resource->thumbnail_img = $image->id;
        $resource->save();
    }
}
