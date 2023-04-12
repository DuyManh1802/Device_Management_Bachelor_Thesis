@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Phòng ban /</span> Thêm phòng ban</h4>

    <div class="card">

        <form method="POST" action="{{ route('department.store') }}">
            @csrf
            <div class="card-body">
                <div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Tên phòng')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text">
                                    <i class="bx bx-user"></i></span>
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('name') is-invalid @enderror"
                                    placeholder="name" aria-label="name" aria-describedby="basic-icon-default-phone2"
                                    name="name" required autocomplete="name" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Người quản lý')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('manager') is-invalid @enderror"
                                    placeholder="manager" aria-label="manager"
                                    aria-describedby="basic-icon-default-phone2" name="manager" required
                                    autocomplete="manager" />
                                @error('manager')
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
                                    aria-describedby="basic-icon-default-phone2" name="address" required
                                    autocomplete="address" />
                                @error('address')
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
