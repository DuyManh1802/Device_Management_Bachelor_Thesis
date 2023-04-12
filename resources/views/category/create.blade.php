@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh mục /</span> Thêm danh mục</h4>
    <div class="card">
        <form method="POST" action="{{ route('category.store') }}">
            @csrf
            <div class="card-body">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Tên phòng</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Name"
                        aria-describedby="defaultFormControlHelp" name="name" />
                </div>
                <button type="submit" class="btn btn-outline-primary">Thêm</button>
            </div>
        </form>
    </div>
</div>
@endsection
