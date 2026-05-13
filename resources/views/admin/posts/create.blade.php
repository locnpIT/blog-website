@extends('layouts.admin')
@section('content')
<div class="panel"><div class="panel-header">Thêm bài viết</div><div class="panel-body"><form method="post" enctype="multipart/form-data" action="{{ route('admin.posts.store') }}">@csrf @include('admin.posts.form') <button class="btn btn-dark mt-3">Lưu</button></form></div></div>
@endsection
