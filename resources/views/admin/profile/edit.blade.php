@extends('layouts.admin')
@section('content')
<div class="panel">
    <div class="panel-header">Hồ sơ giới thiệu (CV)</div>
    <div class="panel-body">
        <form method="post" enctype="multipart/form-data" action="{{ route('admin.profile.update') }}">
            @csrf @method('put')
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Ảnh đại diện</label>
                    <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                    @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @if(!empty($profile?->avatar_url))
                        <div class="mt-3">
                            <img src="{{ $profile->avatar_url }}" alt="avatar" width="140" style="border-radius:12px;object-fit:cover;border:1px solid rgba(0,0,0,.08);">
                        </div>
                    @endif
                </div>
                <div class="col-md-6"><label class="form-label">Họ và tên</label><input name="full_name" value="{{ old('full_name', $profile->full_name) }}" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Tiêu đề nghề nghiệp</label><input name="headline" value="{{ old('headline', $profile->headline) }}" class="form-control" placeholder="Ví dụ: Backend Developer | Laravel"></div>
                <div class="col-md-4"><label class="form-label">Email</label><input name="email" value="{{ old('email', $profile->email) }}" class="form-control"></div>
                <div class="col-md-4"><label class="form-label">Số điện thoại</label><input name="phone" value="{{ old('phone', $profile->phone) }}" class="form-control"></div>
                <div class="col-md-4"><label class="form-label">Địa chỉ</label><input name="address" value="{{ old('address', $profile->address) }}" class="form-control"></div>
                <div class="col-12"><label class="form-label">Tóm tắt bản thân</label><textarea name="summary" rows="4" class="form-control wysiwyg">{{ old('summary', $profile->summary) }}</textarea></div>
                <div class="col-12"><label class="form-label">Kỹ năng</label><textarea name="skills" rows="6" class="form-control wysiwyg">{{ old('skills', $profile->skills) }}</textarea></div>
                <div class="col-12"><label class="form-label">Kinh nghiệm làm việc</label><textarea name="experience" rows="8" class="form-control wysiwyg" placeholder="Gợi ý: Công ty | Vị trí | Thời gian">{{ old('experience', $profile->experience) }}</textarea></div>
                <div class="col-12"><label class="form-label">Học vấn</label><textarea name="education" rows="6" class="form-control wysiwyg">{{ old('education', $profile->education) }}</textarea></div>
                <div class="col-12"><label class="form-label">Dự án nổi bật</label><textarea name="projects" rows="8" class="form-control wysiwyg">{{ old('projects', $profile->projects) }}</textarea></div>
            </div>
            <button class="btn btn-dark mt-3">Lưu hồ sơ</button>
        </form>
    </div>
</div>
@push('scripts')
<script>
document.querySelectorAll('.wysiwyg').forEach((el) => {
    ClassicEditor.create(el).catch((error) => console.error(error));
});
</script>
@endpush
@endsection
