@extends('welcome')
@section('content')
@if ($category_by_id->count() > 0)

<div class="alert alert-success text-center">
    <p>Có sản phẩm</p>
</div>

@else
<div class="alert alert-danger text-center">
    <p>Không có sản phẩm</p>
</div>
@endif
@endsection