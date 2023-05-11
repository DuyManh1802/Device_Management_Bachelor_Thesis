@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh mục /</span> Sửa thông tin danh mục</h4>
    <div class="card">
        <form action="{{ route('category.update', $categories->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Tên danh mục')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">

                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('name') is-invalid @enderror"
                                    placeholder="name" aria-label="name" aria-describedby="basic-icon-default-phone2"
                                    name="name" value="{{ $categories->name }}" required autocomplete="name" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-outline-primary" onclick="return confirmAction();">Cập
                                nhật</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
