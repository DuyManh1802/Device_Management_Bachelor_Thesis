@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Thêm mới phần mềm</h5>
        <form method="POST" action="{{ route('software.store') }}" enctype="multipart/form-data">
            @csrf
            <div class=" card-body">
                <div>
                    <div class="row mb-3">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">{{ __('Thiết bị')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <select name="device_id" class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    @foreach ($devices as $device)
                                    <option value="{{ $device->id }}" checked>{{
                                        $device->name }}</option>
                                    @endforeach
                                </select>
                                @error('device_id')
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
                                    name="name" value="{{ old('name') }}" required autocomplete="name" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row mb-3">
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
                    </div> --}}

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Phiên bản')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <textarea type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('version') is-invalid @enderror"
                                    placeholder="version" aria-label="version"
                                    aria-describedby="basic-icon-default-phone2" name="version"
                                    value="{{ old('version') }}" required autocomplete="version">
                                </textarea>
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
                                    value="{{ old('license_price') }}" required autocomplete="license_price" />
                                @error('license_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Ngày bắt đầu')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="date" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('start') is-invalid @enderror"
                                    placeholder="start" aria-label="start" aria-describedby="basic-icon-default-phone2"
                                    name="start" value="{{ old('start') }}" required autocomplete="start" />
                                @error('start')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Ngày hết hạn')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="date" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('end') is-invalid @enderror" placeholder="end"
                                    aria-label="end" aria-describedby="basic-icon-default-phone2" name="end"
                                    value="{{ old('end') }}" required autocomplete="end" />
                                @error('end')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
    </div>
</div>
@endsection
