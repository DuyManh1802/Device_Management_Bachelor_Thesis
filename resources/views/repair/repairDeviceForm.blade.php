@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thiết bị /</span> Thông tin sửa chữa</h4>

    <div class="card">

        <form method="POST" action="{{ route('repair.repairDeviced', $repairs->id) }}" enctype="multipart/form-data">
            @csrf
            <div class=" card-body">
                <div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Tên thiết bị')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('name') is-invalid @enderror"
                                    placeholder="name" aria-label="name" aria-describedby="basic-icon-default-phone2"
                                    name="" value="{{ $repairs->device->name }}" required autocomplete="name"
                                    readonly />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="device_id" value="{{ $repairs->device_id }}">

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Hình ảnh')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <img id="basic-icon-default-phone" width="100px" height="100px"
                                    class=" @error('image') is-invalid @enderror" placeholder="image" aria-label="image"
                                    aria-describedby="basic-icon-default-phone2"
                                    src="{{ asset('image/device/' . $repairs->device->image) }}" required
                                    autocomplete="image" />
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Cấu hình')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('configuration') is-invalid @enderror"
                                    placeholder="configuration" aria-label="configuration"
                                    aria-describedby="basic-icon-default-phone2" name=""
                                    value="{{ $repairs->device->configuration }}" required autocomplete="configuration"
                                    readonly>

                                @error('configuration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Màu sắc')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('color') is-invalid @enderror"
                                    placeholder="color" aria-label="color" aria-describedby="basic-icon-default-phone2"
                                    name="" value="{{ $repairs->device->color }}" required autocomplete="color"
                                    readonly />
                                @error('color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Kiểu sửa chữa')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" id="defaultCheck1" name="type" value="0"
                                    checked />
                                <label class="form-check-label" for="defaultCheck1"> Sửa chữa </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" id="defaultCheck1" name="type" value="1" />
                                <label class="form-check-label" for="defaultCheck1"> Thay thế </label>
                            </div>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Kết quả sửa chữa')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('result') is-invalid @enderror"
                                    placeholder="result" aria-label="result"
                                    aria-describedby="basic-icon-default-phone2" name="result"
                                    value="{{ old('result') }}" required autocomplete="result" />
                                @error('result')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Nội dung sửa chữa')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <textarea type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('content') is-invalid @enderror"
                                    placeholder="content" aria-label="content"
                                    aria-describedby="basic-icon-default-phone2" name="content"
                                    value="{{ old('content') }}" required autocomplete="content">
                                </textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Chi phí sửa chữa')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('cost') is-invalid @enderror"
                                    placeholder="cost" aria-label="cost" aria-describedby="basic-icon-default-phone2"
                                    name="cost" value="{{ old('cost') }}" required autocomplete="cost">

                                @error('cost')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-outline-primary">Xác nhận</button>
            </div>
        </form>
    </div>
</div>
@endsection
