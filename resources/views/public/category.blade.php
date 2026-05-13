@extends('layouts.public')
@section('content')
<div class="panel mb-4"><div class="panel-body"><h3 class="mb-1">Danh mục: {{ $category->name }}</h3><p class="text-muted mb-0">Các bài viết thuộc danh mục này.</p></div></div>
@include('public._post_grid', ['posts' => $posts])
@endsection
