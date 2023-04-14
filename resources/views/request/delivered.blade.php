@extends('layouts.app')
@section('content')
@php
foreach ($users as $user) {
$user_id = $user->user_id;
}

@endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Yêu cầu /</span> Xác nhận
        đã lấy thiết bị</h4>

    <div class="card">


        <form method="POST" action="{{ route('request.delivered', $user->user_id) }}">
            @csrf

            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Ngày
                        lấy thiết bị')
                        }}</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <input type="date" id="basic-icon-default-phone"
                                class="form-control phone-mask @error('borrowed_date') is-invalid @enderror"
                                placeholder="borrowed_date" aria-label="borrowed_date"
                                aria-describedby="basic-icon-default-phone2" name="borrowed_date"
                                value="{{ old('borrowed_date') }}" required autocomplete="borrowed_date" />
                            @error('borrowed_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Ngày dự
                        kiến trả')
                        }}</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <input type="date" id="basic-icon-default-phone"
                                class="form-control phone-mask @error('return_date') is-invalid @enderror"
                                placeholder="return_date" aria-label="return_date"
                                aria-describedby="basic-icon-default-phone2" name="return_date"
                                value="{{ old('return_date') }}" required autocomplete="return_date" />
                            @error('return_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Xác nhận</button>
            </div>
        </form>

    </div>
</div>

@endsection
