@extends('layouts.admin')
@section('content')
<div class="panel"><div class="panel-header">Sửa danh mục</div><div class="panel-body"><form method="post" action="{{ route('admin.categories.update', $category) }}">@csrf @method('put') @include('admin.categories.form') <button class="btn btn-dark">Cập nhật</button></form></div></div>
@endsection
