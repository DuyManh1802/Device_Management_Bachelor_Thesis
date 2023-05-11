@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Người dùng /</span> Sửa thông tin người dùng</h4>

    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('user.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">{{ __('Tên') }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                    <i class="bx bx-user"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="basic-icon-default-fullname" placeholder="Name" aria-label="John Doe"
                                    aria-describedby="basic-icon-default-fullname2" name="name"
                                    value="{{ $users->name }}" required autocomplete="name" autofocus />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">{{ __('Phòng ban')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="department_id">
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Hình ảnh')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="file" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('image') is-invalid @enderror"
                                    placeholder="image" aria-label="image" aria-describedby="basic-icon-default-phone2"
                                    name="image" value="{{ old('image') }}" required autocomplete="image" />
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-email">{{ __('Email')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="text" id="basic-icon-default-email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                    aria-label="john.doe" aria-describedby="basic-icon-default-email2" name="email"
                                    value="{{ $users->email }}" required autocomplete="email" />
                                <span id="basic-icon-default-email2" class="input-group-text">@gmail.com</span>
                            </div>
                            <div class="form-text">có thể sử dụng chữ, số & dấu chấm</div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Số điện thoại')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                        class="bx bx-phone"></i></span>
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('phone') is-invalid @enderror"
                                    placeholder="0xx xxx xxxx" aria-label="0xx xxx xxxx"
                                    aria-describedby="basic-icon-default-phone2" name="phone"
                                    value="{{ $users->phone }}" required autocomplete="phone" />
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Địa chỉ')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                        class="fas fa-map-marker-alt"></i></span>
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('address') is-invalid @enderror"
                                    placeholder="address" aria-label="address"
                                    aria-describedby="basic-icon-default-phone2" name="address"
                                    value="{{ $users->address }}" required autocomplete="address" />
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Chức vụ')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" value="" id="defaultCheck1" name="role"
                                    value="0" />
                                <label class="form-check-label" for="defaultCheck1"> Employee </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" value="" id="defaultCheck1" name="role"
                                    value="1" />
                                <label class="form-check-label" for="defaultCheck1"> Device Manager </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" value="" id="defaultCheck1" name="role"
                                    value="2" />
                                <label class="form-check-label" for="defaultCheck1"> Super Manager </label>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-outline-primary" onclick="return confirmAction();">Cập
                                nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
