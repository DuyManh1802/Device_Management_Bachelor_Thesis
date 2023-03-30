@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Sửa thông tin danh mục</h5>
        <form action="{{ route('category.update', $categories->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" placeholder="John Doe" name="name"
                        value="{{ $categories->name }}" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>
@endsection
