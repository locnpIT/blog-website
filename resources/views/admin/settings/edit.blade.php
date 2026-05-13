@extends('layouts.admin')
@section('content')
<div class="card p-4">
    <h4 class="mb-3">Cài đặt website</h4>
    <form method="post" action="{{ route('admin.settings.update') }}">
        @csrf @method('put')
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Site title</label><input name="site_title" value="{{ old('site_title',$settings['site_title'] ?? '') }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Tên tác giả</label><input name="author_name" value="{{ old('author_name',$settings['author_name'] ?? '') }}" class="form-control"></div>
            <div class="col-12"><label class="form-label">Bio</label><textarea name="author_bio" class="form-control" rows="3">{{ old('author_bio',$settings['author_bio'] ?? '') }}</textarea></div>
            <div class="col-md-3"><label class="form-label">Facebook</label><input name="social_facebook" value="{{ old('social_facebook',$settings['social_facebook'] ?? '') }}" class="form-control"></div>
            <div class="col-md-3"><label class="form-label">Instagram</label><input name="social_instagram" value="{{ old('social_instagram',$settings['social_instagram'] ?? '') }}" class="form-control"></div>
            <div class="col-md-3"><label class="form-label">LinkedIn</label><input name="social_linkedin" value="{{ old('social_linkedin',$settings['social_linkedin'] ?? '') }}" class="form-control"></div>
            <div class="col-md-3"><label class="form-label">GitHub</label><input name="social_github" value="{{ old('social_github',$settings['social_github'] ?? '') }}" class="form-control"></div>
        </div>
        <button class="btn btn-dark mt-3">Lưu cài đặt</button>
    </form>
</div>
@endsection
