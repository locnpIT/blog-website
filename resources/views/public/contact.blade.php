@extends('layouts.public')
@section('title', 'Liên hệ - ' . ($globalSettings['site_title'] ?? 'PhuocLocBlog'))
@section('meta_description', 'Liên hệ với PhuocLocBlog để trao đổi hợp tác, góp ý hoặc đặt câu hỏi về nội dung kỹ thuật.')
@section('og_type', 'website')

@section('content')
<section class="simple-hero simple-hero-tight">
    <p class="eyebrow">Liên hệ</p>
    <h1>Gửi lời nhắn cho mình</h1>
    <p>Nếu bạn có bất kỳ câu hỏi nào hoặc muốn trao đổi về hợp tác, đừng ngần ngại gửi cho mình một lời nhắn nhé!</p>
</section>

<div class="contact-simple">
    <section class="simple-card">
        <form method="post" action="{{ route('contact.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Họ tên</label>
                    <input name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Tiêu đề</label>
                    <input name="subject" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror">
                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Nội dung</label>
                    <textarea name="message" rows="7" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <button class="btn btn-pastel mt-3" type="submit">Gửi lời nhắn</button>
        </form>
    </section>

    <aside class="simple-card">
        <p class="mb-2"><strong>Thời gian phản hồi</strong></p>
        <p class="text-muted mb-3">Trong vòng 24 giờ</p>
        <p class="mb-2"><strong>Nội dung phù hợp</strong></p>
        <p class="text-muted mb-3">Hợp tác, góp ý, câu hỏi kỹ thuật</p>
        <p class="mb-0"><strong>Lưu ý</strong></p>
        <p class="text-muted mb-0">Vui lòng ghi rõ ngữ cảnh để mình hỗ trợ tốt hơn</p>
    </aside>
</div>
@endsection
