@extends('layouts.admin')
@section('content')
<div class="card p-4" style="max-width:600px;">
    <h4 class="mb-3">Đổi mật khẩu</h4>
    <form method="post" action="{{ route('admin.security.password.update') }}">
        @csrf @method('put')
        <div class="mb-3"><label class="form-label">Mật khẩu hiện tại</label><input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">@error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
        <div class="mb-3"><label class="form-label">Mật khẩu mới</label><input type="password" name="password" class="form-control @error('password') is-invalid @enderror">@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
        <div class="mb-3"><label class="form-label">Nhập lại mật khẩu mới</label><input type="password" name="password_confirmation" class="form-control"></div>
        <button class="btn btn-dark">Cập nhật</button>
    </form>
</div>
@endsection
