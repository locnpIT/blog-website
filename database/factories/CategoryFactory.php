<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Công nghệ',
            'Lập trình',
            'Du lịch',
            'Sách hay',
            'Sự nghiệp',
            'Khởi nghiệp',
            'Tư duy',
            'Đời sống',
        ];

        foreach ($categories as $name) {
            Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => "Các bài viết thuộc chủ đề {$name}.",
                ],
            );
        }
    }
}