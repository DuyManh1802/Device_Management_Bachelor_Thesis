@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh mục /</span> Sửa thông tin danh mục</h4>
    <div class="card">
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
