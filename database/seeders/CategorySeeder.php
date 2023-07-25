<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $this->createCategory(
            'sound room',
            'It is a room used for audio work',
            'assets/img/train1.jpg',
            'assets/img/train1.jpg'
        );
        $this->createCategory(
            'Training and meetings',
            'It is a room used for Training',
            'assets/img/train1.jpg',
            'assets/img/train1.jpg'
        );

        $this->createCategory(
            'Meetings-(skype)',
            'It is a meetings(skype)',
            'assets/img/train1.jpg',
            'assets/img/train1.jpg'
        );


        $this->createCategory(
            'Single Seat-(common yard)',
            'It is a single seat (common yard)',
            'assets/img/train1.jpg',
            'assets/img/train1.jpg'
        );
        $this->createCategory(
            'Individual office',
            'It is a individual office',
            'assets/img/train1.jpg',
            'assets/img/train1.jpg'
        );
        $this->createCategory(
            'Office (2 people)',
            'It is a office (2 people)',
            'assets/img/train1.jpg',
            'assets/img/train1.jpg'
        );

        $this->createCategory(
            'Office (3 people)',
            'It is a office (3 people)',
            'assets/img/train1.jpg',
            'assets/img/train1.jpg'
        );

        $this->createCategory(
            'Office (6 people)',
            'It is a office (6 people)',
            'assets/img/train1.jpg',
            'assets/img/train1.jpg'
        );

        $this->createCategory(
            'Office (8 people)',
            'It is a office (8 people)',
            'assets/img/train1.jpg',
            'assets/img/train1.jpg'
        );


        $this->createCategory(
            'Office (5 people)',
            'It is a office (5 people)',
            'assets/img/train1.jpg',
            'assets/img/train1.jpg'
        );
    }

    public function createCategory($name, $description, $iconPath, $bannerPath)
    {
        $category = new Category();
        $category->name = $name;
        $category->description = $description;
        $category->save();
        $icon = $category->addAssetImage($iconPath, Category::CATEGORY_ICON_IMAGE_TAG);
        $banner = $category->addAssetImage($bannerPath, Category::CATEGORY_BANNER_IMAGE_TAG);
        $category->icon = $icon->id;
        $category->banner = $banner->id;
        $category->save();
    }
}
