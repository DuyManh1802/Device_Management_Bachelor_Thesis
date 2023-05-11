@extends('layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Yêu cầu /</span> Gửi yêu cầu cấp license key</h4>

    <div class="col-xxl">
        <div class="card mb-4">
            <form action="{{ route('request.sendBorrowRequestLicensekey', $devices->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Tên thiết bị')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">

                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('') is-invalid @enderror" placeholder=""
                                    aria-label="" aria-describedby="basic-icon-default-phone2" name=""
                                    value="{{ $devices->name }}" readonly />
                                @error('')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Kiểu yêu cầu')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" id="defaultCheck1" name="type" value="3"
                                    checked readonly />
                                <label class="form-check-label" for="defaultCheck1"> Cấp license key </label>
                            </div>

                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Ngày mượn')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="date" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('start_date') is-invalid @enderror"
                                    placeholder="start_date" aria-label="start_date"
                                    aria-describedby="basic-icon-default-phone2" name="start_date"
                                    value="{{ old('start_date') }}" required autocomplete="start_date" />
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Ghi chú')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">

                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('note') is-invalid @enderror"
                                    placeholder="note" aria-label="note" aria-describedby="basic-icon-default-phone2"
                                    name="note" value="{{ old('note') }}" required autocomplete="note" />
                                @error('note')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary" onclick="return sendRequest();">Gửi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
