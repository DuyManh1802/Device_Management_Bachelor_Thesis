@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Yêu cầu /</span> Cấp license key</h4>

    <div class="col-xxl">
        <div class="card mb-4">
            <form action="{{ route('request.provideLicenseKey') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">{{ __('Người gửi yêu
                            cầu')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('user_id') is-invalid @enderror"
                                    placeholder="user_id" aria-label="user_id"
                                    aria-describedby="basic-icon-default-phone2" value="{{ $users->name }}" required
                                    autocomplete="user_id" readonly />
                                @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">{{ __('Thiết bị cần cấp')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="basic-icon-default-phone"
                                    class="form-control phone-mask @error('user_id') is-invalid @enderror"
                                    placeholder="user_id" aria-label="user_id"
                                    aria-describedby="basic-icon-default-phone2" value="{{ $devices->name }}" required
                                    autocomplete="user_id" readonly />
                                @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleFormControlSelect2" class="col-sm-2 col-form-label">{{ __('Phần mềm')
                            }}</label>
                        <div class="col-sm-10">

                            <div class="input-group input-group-merge">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Chọn Phần mềm</button>
                                <ul class="dropdown-menu">
                                    <select name="software_id[]" class="form-select" id="exampleFormControlSelect2"
                                        style="width: 300px" aria-label="Default select example"
                                        onchange="updateSelectedSoftwares()" multiple>
                                        @foreach ($softwares as $software)
                                        <li class="dropdown-item">
                                            <option value="{{ $software->id }}" onclick="updateSelectedSoftwares(this)"
                                                style="height: 40px" class="d-flex align-items-center">{{
                                                $software->name }} phiên bản {{ $software->version }}</option>
                                        </li>
                                        @endforeach
                                    </select>
                                </ul>
                                <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                    name="selected_softwares" id="selected_softwares" />
                            </div>
                        </div>
                    </div>

                    <input type="hidden" class="form-control" aria-label="Text input with dropdown button"
                        name="user_id" value="{{ $users->id }}" />
                    <input type="hidden" class="form-control" aria-label="Text input with dropdown button"
                        name="device_id" value="{{ $devices->id }}" />

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-outline-primary">Cấp</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <script>
    $('form').on('submit', function(e) {
        e.preventDefault();
        var softwareIds = $('#exampleFormControlSelect2').val();
        $('#selected_softwares').val(softwareIds);
        $(this).unbind('submit').submit();
    });

</script> --}}

<script>
    var selectedSoftwares = [];

    function updateSelectedSoftwares(selectedOption) {
        var softwareId = selectedOption.value;
        var softwareName = selectedOption.text;

        if (selectedSoftwares.find(software => software.id === softwareId)) {
            selectedSoftwares = selectedSoftwares.filter(software => software.id !== softwareId);
        } else {
            selectedSoftwares.push({
                id: softwareId,
                name: softwareName
            });
        }

        var selectedSoftwaresText = selectedSoftwares.map(function(software) {
            return software.name;
        }).join(", ");

        var selectedSoftwaresId = selectedSoftwares.map(function(software) {
            return Number(software.id);
        });

        $('#selected_softwares').val(selectedSoftwaresText);
        $('#exampleFormControlSelect2').val(selectedSoftwaresId);
        console.log(selectedSoftwaresId);
    }
</script>
@endsection
