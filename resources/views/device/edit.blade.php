@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thiết bị /</span> Sửa thông tin thiết bị</h4>

    <div class="card">
        <div class=" card-body">
            <form method="POST" action="{{ route('device.update', $devices->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class=" row mb-3">
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
                                class="form-control phone-mask @error('name') is-invalid @enderror" placeholder="name"
                                aria-label="name" aria-describedby="basic-icon-default-phone2" name="name"
                                value="{{ $devices->name }}" required autocomplete="name" />
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
                                class="form-control phone-mask @error('image') is-invalid @enderror" placeholder="image"
                                aria-label="image" aria-describedby="basic-icon-default-phone2" name="image"
                                value="{{ $devices->image }}" required autocomplete="image" />
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
                                aria-describedby="basic-icon-default-phone2" name="configuration"
                                value="{{ $devices->configuration }}" required autocomplete="configuration" />
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
                                value="{{ $devices->purchase_price }}" required autocomplete="purchase_price"
                                readonly />
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
                                class="form-control phone-mask @error('color') is-invalid @enderror" placeholder="color"
                                aria-label="color" aria-describedby="basic-icon-default-phone2" name="color"
                                value="{{ $devices->color }}" required autocomplete="color" />
                            @error('color')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" onclick="return confirmAction();">Sửa</button>
            </form>

        </div>

    </div>
    @endsection
