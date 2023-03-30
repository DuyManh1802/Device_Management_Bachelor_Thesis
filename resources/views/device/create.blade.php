@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Thêm mới thiết bị</h5>
        <form method="POST" action="{{ route('device.store') }}" enctype="multipart/form-data">
            @csrf
            <div class=" card-body">
                <div>
                    <div class="row mb-3">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">{{ __('Danh mục')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <select name="category_id" class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" checked>{{
                                        $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Tên thiết bị')
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
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Cấu hình')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <textarea type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('configuration') is-invalid @enderror"
                                    placeholder="configuration" aria-label="configuration"
                                    aria-describedby="basic-icon-default-phone2" name="configuration"
                                    value="{{ old('configuration') }}" required autocomplete="configuration">
                                </textarea>
                                @error('configuration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Giá nhập')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('purchase_price') is-invalid @enderror"
                                    placeholder="purchase_price" aria-label="purchase_price"
                                    aria-describedby="basic-icon-default-phone2" name="purchase_price"
                                    value="{{ old('purchase_price') }}" required autocomplete="purchase_price" />
                                @error('purchase_price')
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
                                    name="color" value="{{ old('color') }}" required autocomplete="color" />
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
                                    name="type" value="{{ old('type') }}" required autocomplete="type" />
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
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Ngày kết thúc bảo
                            hành')
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
