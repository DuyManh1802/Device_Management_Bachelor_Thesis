@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thiết bị /</span> Thông tin bảo hành</h4>

    <div class="card">

        <form method="POST" action="{{ route('warranty.warrantyDeviced', $warranties->id) }}"
            enctype="multipart/form-data">
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
                                    name="" value="{{ $warranties->device->name }}" required autocomplete="name"
                                    readonly />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="device_id" value="{{ $warranties->device_id }}">

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Hình ảnh')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <img id="basic-icon-default-phone" width="100px" height="100px"
                                    class=" @error('image') is-invalid @enderror" placeholder="image" aria-label="image"
                                    aria-describedby="basic-icon-default-phone2"
                                    src="{{ asset('image/device/' . $warranties->device->image) }}" required
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
                                    value="{{ $warranties->device->configuration }}" required
                                    autocomplete="configuration" readonly>

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
                                    name="" value="{{ $warranties->device->color }}" required autocomplete="color"
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
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Kiểu bảo hành')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('type') is-invalid @enderror"
                                    placeholder="type" aria-label="type" aria-describedby="basic-icon-default-phone2"
                                    name="" value="{{ $warranties->type }}" required autocomplete="type" readonly />
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Ngày bắt đầu bảo hành')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('start') is-invalid @enderror"
                                    placeholder="start" aria-label="start" aria-describedby="basic-icon-default-phone2"
                                    name="" value="{{ $warranties->start }}" required autocomplete="start" readonly />
                                @error('start')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Ngày kết thúc bảo
                            hành')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('end') is-invalid @enderror" placeholder="end"
                                    aria-label="end" aria-describedby="basic-icon-default-phone2" name=""
                                    value="{{ $warranties->end }}" required autocomplete="end" readonly />
                                @error('end')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Kết quả bảo
                            hành')
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
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Nội dung bảo hành')
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

                </div>
                <button type="submit" class="btn btn-outline-primary">Thêm</button>
            </div>
        </form>
    </div>
</div>
@endsection
