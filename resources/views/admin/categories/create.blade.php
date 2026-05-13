@extends('layouts.admin')
@section('content')
<div class="panel"><div class="panel-header">Thêm danh mục</div><div class="panel-body"><form method="post" action="{{ route('admin.categories.store') }}">@csrf @include('admin.categories.form') <button class="btn btn-dark">Lưu</button></form></div></div>
@endsection
