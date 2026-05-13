@extends('layouts.admin')
@section('content')
<div class="panel"><div class="panel-header">Sửa bài viết</div><div class="panel-body"><form method="post" enctype="multipart/form-data" action="{{ route('admin.posts.update',$post) }}">@csrf @method('put') @include('admin.posts.form') <button class="btn btn-dark mt-3">Cập nhật</button></form></div></div>
@endsection
