<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => 'admin123']
        );

        $defaultCategories = [
            ['name' => 'Laravel', 'description' => 'Kinh nghiệm phát triển với Laravel'],
            ['name' => 'Frontend', 'description' => 'Giao diện và trải nghiệm người dùng'],
            ['name' => 'Career', 'description' => 'Phát triển nghề nghiệp trong ngành IT'],
            ['name' => 'Productivity', 'description' => 'Tối ưu hiệu suất làm việc cá nhân'],
        ];

        foreach ($defaultCategories as $category) {
            Category::firstOrCreate(['slug' => \Illuminate\Support\Str::slug($category['name'])], $category);
        }

        Category::factory(4)->make()->each(function (Category $category): void {
            Category::firstOrCreate(
                ['slug' => $category->slug],
                [
                    'name' => $category->name,
                    'description' => $category->description,
                ]
            );
        });

        Post::factory(20)->create()->each(function (Post $post): void {
            if ($post->status === 'draft') {
                $post->update(['published_at' => null]);
            }
        });

        $settings = [
            'site_title' => 'PhuocLocBlog',
            'author_name' => 'Phuoc Loc',
            'author_bio' => 'Blog chia sẻ kiến thức Laravel, hệ thống web và kinh nghiệm kỹ thuật thực chiến.',
            'social_facebook' => 'https://facebook.com/',
            'social_instagram' => 'https://instagram.com/',
            'social_linkedin' => 'https://linkedin.com/',
            'social_github' => 'https://github.com/',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Profile::query()->firstOrCreate([], [
            'full_name' => 'Phuoc Loc',
            'headline' => 'Backend Developer | Laravel',
            'email' => 'admin@gmail.com',
            'phone' => '0123 456 789',
            'address' => 'Ho Chi Minh City, Vietnam',
            'summary' => 'Lập trình viên tập trung vào xây dựng hệ thống web ổn định, bảo mật và dễ mở rộng.',
            'skills' => "Laravel\nPHP\nMySQL\nRESTful API\nClean Architecture",
            'experience' => "Công ty A | Backend Developer | 2022 - Nay\n- Xây dựng hệ thống quản trị nội dung và tối ưu truy vấn dữ liệu.",
            'education' => "Đại học CNTT | Kỹ sư phần mềm",
            'projects' => "PhuocLocBlog CMS\nRecruitment Platform\nInternal Admin Dashboard",
        ]);
    }
}
