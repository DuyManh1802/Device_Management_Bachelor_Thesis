@extends('layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Yêu cầu /</span> Xác nhận
        đã trả thiết bị</h4>
    <div class="card">
        <form method="POST" action="{{ route('request.returned', $requests->id) }}">
            @csrf

            <div class="card-body">

                <div class="row mb-3">
                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">{{ __('Ngày trả thiết bị')
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
                <input type="hidden" name="device_id" value="{{ $requests->device_id }}" required
                    autocomplete="return_date" />

                <button type="submit" class="btn btn-outline-primary" onclick="return confirmAction();">Xác
                    nhận</button>
            </div>
        </form>

    </div>
</div>

@endsection
