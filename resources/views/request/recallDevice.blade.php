@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Yêu cầu /</span> Thu hồi thiết bị</h4>

    <div class="card">

        <form method="POST" action="{{ route('request.provideDevice') }}">
            @csrf
            <div class="card-body">
                <div>

                    <div class="row mb-3">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">{{ __('Người mượn')
                            }}</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <select name="department_id" class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" checked>{{
                                        $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">{{ __('Thiết bị')
                            }}</label>
                        <div class="col-sm-10">

                            <div class="input-group input-group-merge">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Chọn thiết bị</button>
                                <ul class="dropdown-menu">
                                    <select name="device_id[]" class="form-select" id="exampleFormControlSelect1"
                                        style="width: 300px" aria-label="Default select example"
                                        onchange="updateSelectedDevices()" multiple>
                                        @foreach ($devices as $device)
                                        <li class="dropdown-item">
                                            <option value="{{ $device->id }}" onclick="updateSelectedDevices(this)"
                                                style="height: 40px" class="d-flex align-items-center">{{
                                                $device->name }}</option>
                                        </li>
                                        @endforeach
                                    </select>
                                </ul>
                                <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                    name="selected_devices" id="selected_devices" />
                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-outline-primary">Thu hồi</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var selectedDevices = [];

    function updateSelectedDevices(selectedOption) {
        var deviceId = selectedOption.value;
        var deviceName = selectedOption.text;

        if (selectedDevices.find(device => device.id === deviceId)) {
            selectedDevices = selectedDevices.filter(device => device.id !== deviceId);
        } else {
            selectedDevices.push({
                id: deviceId,
                name: deviceName
            });
        }

        var selectedDevicesText = selectedDevices.map(function(device) {
            return device.name;
        }).join(", ");

        var selectedDevicesId = selectedDevices.map(function(device) {
            return Number(device.id);
        });

        $('#selected_devices').val(selectedDevicesText);
        $('#exampleFormControlSelect1').val(selectedDevicesId);

    }
</script>

@endsection
