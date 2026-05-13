<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $vnTitles = [
            'Hướng dẫn học Laravel cho người mới bắt đầu',
            'Tại sao nên sử dụng Tailwind CSS cho dự án của bạn',
            'Cách tối ưu hiệu năng ứng dụng PHP',
            'Xây dựng hệ thống Blog chuyên nghiệp với Laravel 11',
            'Tìm hiểu về Design Patterns trong phát triển phần mềm',
            'Kinh nghiệm triển khai CI/CD cho dự án web',
            'Những tính năng mới đáng chú ý trong PHP 8.3',
            'Cách bảo mật ứng dụng Web khỏi tấn công XSS và SQL Injection',
            'Tối ưu hóa Database với Indexing và Caching',
            'Hướng dẫn sử dụng Docker cho môi trường phát triển',
            'Lộ trình trở thành Senior Fullstack Developer',
            'Bí quyết quản lý thời gian hiệu quả cho lập trình viên',
            'Tìm hiểu về Microservices architecture',
            'Cách viết Code sạch và dễ bảo trì',
            'Tại sao nên chọn Vue.js thay vì React',
        ];

        $vnParagraphs = [
            'Trong bài viết này, chúng ta sẽ cùng nhau tìm hiểu về các khái niệm cơ bản và nâng cao trong việc phát triển ứng dụng.',
            'Việc áp dụng các kỹ thuật mới không chỉ giúp tăng tốc độ phát triển mà còn đảm bảo tính ổn định của hệ thống.',
            'Chúng tôi đã tổng hợp những kinh nghiệm thực chiến từ các dự án lớn để chia sẻ đến bạn đọc một cách chi tiết nhất.',
            'Lập trình không chỉ là viết code, mà còn là tư duy giải quyết vấn đề một cách logic và tối ưu nhất có thể.',
            'Hệ sinh thái Laravel ngày càng mạnh mẽ với sự ra đời của nhiều công cụ hỗ trợ tuyệt vời như Herd, Pail, và Folio.',
            'Bảo mật luôn là yếu tố quan trọng hàng đầu mà bất kỳ nhà phát triển nào cũng cần phải lưu ý khi xây dựng sản phẩm.',
            'Hãy cùng khám phá những bí mật đằng sau các ứng dụng triệu người dùng và cách họ xử lý lưu lượng truy cập lớn.',
            'Tương lai của ngành IT đang thay đổi nhanh chóng với sự bùng nổ của AI và Machine Learning trong lập trình.',
        ];

        $title = fake()->randomElement($vnTitles) . ' ' . fake()->unique()->numberBetween(1, 1000);
        
        $images = [
            'https://images.unsplash.com/photo-1498050108023-c5249f4df085',
            'https://images.unsplash.com/photo-1461749280684-dccba630e2f6',
            'https://images.unsplash.com/photo-1499750310107-5fef28a66643',
            'https://images.unsplash.com/photo-1516321318423-f06f85e504b3',
            'https://images.unsplash.com/photo-1522202176988-66273c2fd55f',
            'https://images.unsplash.com/photo-1519389950473-47ba0277781c',
            'https://images.unsplash.com/photo-1488590528505-98d2b5aba04b',
            'https://images.unsplash.com/photo-1517694712202-14dd9538aa97',
            'https://images.unsplash.com/photo-1555066931-4365d14bab8c',
            'https://images.unsplash.com/photo-1515879218367-8466d910aaa4',
            'https://images.unsplash.com/photo-1587620962725-abab7fe55159',
            'https://images.unsplash.com/photo-1550745165-9bc0b252726f',
            'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5',
            'https://images.unsplash.com/photo-1531297484001-80022131f5a1',
            'https://images.unsplash.com/photo-1518770660439-4636190af475',
        ];

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->randomElement($vnParagraphs),
            'content' => '<h3>Giới thiệu</h3><p>' . fake()->randomElement($vnParagraphs) . '</p><p>' . fake()->randomElement($vnParagraphs) . '</p><h3>Nội dung chính</h3><p>' . fake()->randomElement($vnParagraphs) . '</p><p>' . fake()->randomElement($vnParagraphs) . '</p><blockquote>' . fake()->randomElement($vnParagraphs) . '</blockquote><p>' . fake()->randomElement($vnParagraphs) . '</p>',
            'thumbnail' => fake()->randomElement($images).'?auto=format&fit=crop&w=800&q=80',
            'category_id' => Category::inRandomOrder()->value('id') ?? Category::factory(),
            'status' => fake()->randomElement(['published', 'published', 'published']), // Ensure more published posts
            'published_at' => now()->subDays(fake()->numberBetween(0, 60)),
        ];
    }
}
