<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => 'admin123']
        );

        $defaultCategories = [
            ['name' => 'Java', 'description' => 'Kinh nghiệm phát triển với Java và Spring Boot'],
            ['name' => 'Frontend', 'description' => 'Giao diện và trải nghiệm người dùng'],
            ['name' => 'Career', 'description' => 'Phát triển nghề nghiệp trong ngành IT'],
            ['name' => 'Productivity', 'description' => 'Tối ưu hiệu suất làm việc cá nhân'],
        ];

        foreach ($defaultCategories as $category) {
            Category::firstOrCreate(['slug' => Str::slug($category['name'])], $category);
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

        $categoryIds = Category::query()->pluck('id', 'slug');

        $samplePosts = [
            [
                'title' => 'Tối ưu trang blog Laravel để tải nhanh hơn',
                'slug' => 'toi-uu-trang-blog-laravel-de-tai-nhanh-hon',
                'excerpt' => 'Cách giảm độ nặng giao diện, tối ưu card bài viết và giữ trải nghiệm mượt trên mobile.',
                'category_slug' => 'frontend',
                'thumbnail' => url('/images/HeroBannerForWork.png'),
                'content' => '<h2>Mục tiêu</h2><p>Bài viết này dùng để test layout thẻ bài viết, ảnh thumbnail và phần nội dung chi tiết.</p><h2>Cách làm</h2><p>Giảm padding không cần thiết, giữ typography rõ ràng, và ưu tiên dữ liệu ngắn gọn cho phần preview.</p><ul><li>Giữ title ngắn</li><li>Preview nội dung rõ</li><li>Kiểm tra hiển thị card và detail</li></ul><p>Nội dung này có đủ heading, list và paragraph để kiểm tra giao diện bài viết.</p>',
            ],
            [
                'title' => 'Bộ khung nội dung cho một landing page cá nhân',
                'slug' => 'bo-khung-noi-dung-cho-mot-landing-page-ca-nhan',
                'excerpt' => 'Mẫu nội dung để xem hero, CTA và khoảng trắng trên màn hình lớn lẫn điện thoại.',
                'category_slug' => 'productivity',
                'thumbnail' => null,
                'content' => '<h2>Hero</h2><p>Đây là bài mẫu để kiểm tra cảm giác phân cấp chữ và nhịp điệu giữa các block.</p><h3>CTA</h3><p>Phần kêu gọi hành động cần rõ ràng, vừa đủ nổi bật nhưng không quá gắt.</p><blockquote>Testing content is still content.</blockquote><p>Bạn có thể dùng bài này để xác nhận lưới danh sách và phần sidebar.</p>',
            ],
            [
                'title' => 'Làm sao chọn cấu trúc category cho blog nhỏ',
                'slug' => 'lam-sao-chon-cau-truc-category-cho-blog-nho',
                'excerpt' => 'Một cấu trúc category ít nhưng rõ giúp trang chủ trông gọn và dễ điều hướng hơn.',
                'category_slug' => 'career',
                'thumbnail' => url('/images/PhuocLocBlogLogoHeader.jpg'),
                'content' => '<h2>Gợi ý</h2><p>Chỉ cần vài category đủ dùng, miễn là tên ngắn, dễ hiểu và nhất quán với nội dung.</p><h3>Kiểm tra</h3><p>Bài viết này giúp test trạng thái danh mục, hiển thị ngày đăng và ảnh đại diện ở list.</p><p>Nếu muốn giao diện dày hơn, đây là bài mẫu phù hợp để xem nhiều card cùng lúc.</p>',
            ],
            [
                'title' => 'Checklist trước khi publish một bài viết kỹ thuật',
                'slug' => 'checklist-truoc-khi-publish-mot-bai-viet-ky-thuat',
                'excerpt' => 'Mẫu bài giúp test đoạn text dài hơn một chút để xem mức cắt excerpt và tỷ lệ card.',
                'category_slug' => 'productivity',
                'thumbnail' => null,
                'content' => '<h2>Trước khi đăng</h2><p>Kiểm tra title, excerpt, thumbnail, chính tả và ảnh trong nội dung.</p><h3>Tiêu chuẩn</h3><p>Một bài tốt phải đọc được ở cả list lẫn detail page mà không bị quá rối.</p><ol><li>Title rõ</li><li>Excerpt đủ ngắn</li><li>Ảnh hợp tỉ lệ</li></ol><p>Bài này rất hợp để test độ dài nội dung và card related posts.</p>',
            ],
            [
                'title' => 'Tổ chức một bài viết có code block và bảng',
                'slug' => 'to-chuc-mot-bai-viet-co-code-block-va-bang',
                'excerpt' => 'Bài mẫu để kiểm tra code block, table và spacing trong article content.',
                'category_slug' => 'java',
                'thumbnail' => url('/images/HeroBannerForWork.png'),
                'content' => '<h2>Code</h2><pre><code>public class App {\n    public static void main(String[] args) {\n        System.out.println("Hello blog");\n    }\n}</code></pre><h2>Bảng</h2><table><thead><tr><th>Mục</th><th>Trạng thái</th></tr></thead><tbody><tr><td>Heading</td><td>OK</td></tr><tr><td>List</td><td>OK</td></tr><tr><td>Table</td><td>OK</td></tr></tbody></table>',
            ],
            [
                'title' => 'Mẫu bài ngắn cho phần bài viết nổi bật',
                'slug' => 'mau-bai-ngan-cho-phan-bai-viet-noi-bat',
                'excerpt' => 'Một bài ngắn để xem featured cards trên homepage có đẹp khi nội dung gọn.',
                'category_slug' => 'frontend',
                'thumbnail' => null,
                'content' => '<h2>Bài ngắn</h2><p>Bài này dùng để test card nổi bật, card list và trạng thái không có thumbnail.</p><p>Đây là nội dung tối giản, nhưng đủ để kiểm tra spacing và typography.</p>',
            ],
        ];

        foreach ($samplePosts as $index => $postData) {
            $categoryId = $categoryIds[$postData['category_slug']] ?? $categoryIds->values()->first();

            Post::updateOrCreate(
                ['slug' => $postData['slug']],
                [
                    'title' => $postData['title'],
                    'excerpt' => $postData['excerpt'],
                    'content' => $postData['content'],
                    'thumbnail' => $postData['thumbnail'],
                    'category_id' => $categoryId,
                    'status' => 'published',
                    'published_at' => now()->subDays(14 - ($index * 2)),
                ]
            );
        }

        $settings = [
            'site_title' => 'PhuocLocBlog',
            'author_name' => 'Phuoc Loc',
            'author_bio' => 'Blog chia sẻ kiến thức Java, Spring Boot, hệ thống web và kinh nghiệm kỹ thuật thực chiến.',
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
            'headline' => 'Java Developer | Spring Boot',
            'email' => 'admin@gmail.com',
            'phone' => '0123 456 789',
            'address' => 'Ho Chi Minh City, Vietnam',
            'summary' => 'Lập trình viên tập trung vào xây dựng hệ thống web ổn định, bảo mật và dễ mở rộng.',
            'skills' => "Java\nSpring Boot\nMySQL\nRESTful API\nClean Architecture",
            'experience' => "Công ty A | Backend Developer | 2022 - Nay\n- Xây dựng hệ thống quản trị nội dung và tối ưu truy vấn dữ liệu.",
            'education' => "Đại học CNTT | Kỹ sư phần mềm",
            'projects' => "PhuocLocBlog CMS\nRecruitment Platform\nInternal Admin Dashboard",
        ]);
    }
}
