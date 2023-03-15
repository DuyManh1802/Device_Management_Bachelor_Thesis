@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Sửa thông tin phòng ban</h5>
        <form action="{{ route('department.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Tên phòng</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Name"
                        aria-describedby="defaultFormControlHelp" name="name" />

                    <label for="defaultFormControlInput" class="form-label">Người quản lý</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Manager"
                        aria-describedby="defaultFormControlHelp" name="manager" />

                    <label for="defaultFormControlInput" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Address"
                        aria-describedby="defaultFormControlHelp" name="address" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</div>
@stop
