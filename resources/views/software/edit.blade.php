@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Thêm mới thiết bị</h5>
        <form method="POST" action="{{ route('software.update', $softwares->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div>
                    <div class="row mb-3">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">{{ __('Danh mục')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('device_id') is-invalid @enderror"
                                    placeholder="device_id" aria-label="device_id"
                                    aria-describedby="basic-icon-default-phone2" name="device_id"
                                    value="{{ $softwares->device->name }}" required autocomplete="device_id" readonly />
                                @error('software_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Tên phần mềm')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('name') is-invalid @enderror"
                                    placeholder="name" aria-label="name" aria-describedby="basic-icon-default-phone2"
                                    name="name" value="{{ $softwares->name }}" required autocomplete="name" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
                                    name="image" value="{{ $softwares->image }}" required autocomplete="image" />
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Phiên bản')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('version') is-invalid @enderror"
                                    placeholder="version" aria-label="version"
                                    aria-describedby="basic-icon-default-phone2" name="version"
                                    value="{{ $softwares->version }}" required autocomplete="version" />
                                @error('version')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Giá bản quyền')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('license_price') is-invalid @enderror"
                                    placeholder="license_price" aria-label="license_price"
                                    aria-describedby="basic-icon-default-phone2" name="license_price"
                                    value="{{ $softwares->license_price }}" required autocomplete="license_price"
                                    readonly />
                                @error('license_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Sửa</button>
            </div>
        </form>
    </div>
</div>
@endsection
