@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Thêm mới danh mục</h5>
        <form method="POST" action="{{ route('category.store') }}">
            @csrf
            <div class="card-body">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Tên phòng</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Name"
                        aria-describedby="defaultFormControlHelp" name="name" />
                </div>
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
    </div>
</div>
@endsection
