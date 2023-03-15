@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Sửa thông tin phòng ban</h5>
        <form action="{{ route('department.update', $departments->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Tên phòng</label>
                    <input type="text" class="form-control" placeholder="John Doe" name="name"
                        value="{{ $departments->name }}" />

                    <label for="defaultFormControlInput" class="form-label">Người quản lý</label>
                    <input type="text" class="form-control" placeholder="John Doe" name="manager"
                        value="{{ $departments->manager }}" />

                    <label for="defaultFormControlInput" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="John Doe" name="address"
                        value="{{ $departments->address }}" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>
@endsection
