@extends('layouts.app')
@section('content')
@php
foreach ($devices as $device) {
$device_id = $device->id;
}

foreach ($users as $user) {
$user_id = $user->user_id;
}
@endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Yêu cầu /</span> Cấp license key</h4>

    <div class="col-xxl">
        <div class="card mb-4">
            <form action="{{ route('request.provideLicenseKey') }}" method="POST">
                @csrf
                <div class="card-body">

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

                    {{-- <input type="hidden" class="form-control" aria-label="Text input with dropdown button"
                        name="user_id" value="{{ $user_id }}" /> --}}
                    <input type="hidden" class="form-control" aria-label="Text input with dropdown button"
                        name="device_id" value="{{ $device_id }}" />
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Cấp</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

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
