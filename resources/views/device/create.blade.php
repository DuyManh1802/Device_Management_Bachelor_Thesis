@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Thêm mới phòng ban</h5>
        <form method="POST" action="{{ route('department.store') }}">
            @csrf
            <div class="card-body">
                <div>
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
                                    aria-describedby="basic-icon-default-phone2" name="address"
                                    value="{{ old('address') }}" required autocomplete="address" />
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">{{ __('Phòng ban')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <select name="department_id" class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" checked>{{
                                        $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
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
                                    aria-describedby="basic-icon-default-phone2" name="address"
                                    value="{{ old('address') }}" required autocomplete="address" />
                                @error('address')
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
