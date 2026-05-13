@extends('layouts.public')
@section('content')
<section class="contact-hero mb-4">
    <span class="contact-kicker">Kết nối</span>
    <h1 class="mb-2">Bạn muốn để lại lời nhắn gì cho mình?</h1>
    <p class="mb-0">Hãy để lại dưới đây nhé. Mình luôn đọc kỹ từng tin nhắn và phản hồi sớm nhất có thể.</p>
</section>

<div class="contact-grid">
    <div class="panel contact-panel">
        <div class="panel-header">Gửi lời nhắn</div>
        <div class="panel-body">
            <form method="post" action="{{ route('contact.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Họ tên</label>
                        <input name="name" value="{{ old('name') }}" placeholder="Nguyễn Văn A" class="form-control @error('name') is-invalid @enderror">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input name="email" value="{{ old('email') }}" placeholder="you@example.com" class="form-control @error('email') is-invalid @enderror">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Tiêu đề</label>
                        <input name="subject" value="{{ old('subject') }}" placeholder="Ví dụ: Trao đổi hợp tác nội dung" class="form-control @error('subject') is-invalid @enderror">
                        @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Nội dung lời nhắn</label>
                        <textarea name="message" rows="7" placeholder="Bạn có thể chia sẻ ý tưởng, câu hỏi, góp ý hoặc bất kỳ điều gì bạn muốn gửi cho mình." class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                        @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-3 flex-wrap gap-2">
                    <small class="meta">Mình tôn trọng quyền riêng tư và không chia sẻ thông tin của bạn cho bên thứ ba.</small>
                    <button class="btn btn-dark">Gửi lời nhắn</button>
                </div>
            </form>
        </div>
    </div>
    <aside class="panel contact-aside">
        <div class="panel-header">Thông tin nhanh</div>
        <div class="panel-body">
            <div class="contact-info-item">
                <p class="meta mb-1">Thời gian phản hồi</p>
                <strong>Trong vòng 24 giờ</strong>
            </div>
            <div class="contact-info-item">
                <p class="meta mb-1">Nội dung phù hợp</p>
                <strong>Hợp tác, góp ý, câu hỏi kỹ thuật</strong>
            </div>
            <div class="contact-info-item mb-0">
                <p class="meta mb-1">Lưu ý</p>
                <strong>Vui lòng ghi rõ ngữ cảnh để mình hỗ trợ tốt hơn</strong>
            </div>
        </div>
    </aside>
</div>
</div>
@endsection
