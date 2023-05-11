@extends('layouts.app')

@section('content')

@if(Auth::user()->role == 0)
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="d-flex align-items-center">
            <div class="col-sm-7 d-flex justify-content-center">
                <div class="card-header">
                    <h4 class="card-title text-primary">Hello {{ Auth::user()->name }}! 🎉</h4>
                </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                    <img src="template/assets/img/illustrations/man-with-laptop-light.png" height="140"
                        alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6 col-12 mb-md-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Thống kê thiết bị</h5>
                    </div>

                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2" id="device_count"></h2>
                            <span>Tổng số thiết bị</span>
                        </div>
                        <div id="orderStatisticsChart"></div>
                    </div>
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="fas fa-laptop-code"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Laptop</h6>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold" id="laptop_count"></small>
                                </div>
                            </div>
                        </li>

                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="fas fa-desktop"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">PC</h6>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold" id="pc_count"></small>
                                </div>
                            </div>
                        </li>

                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="fas fa-tablet-alt"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Máy tính bảng</h6>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold" id="tablet_count"></small>
                                </div>
                            </div>
                        </li>

                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="fas fa-network-wired"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Thiết bị mạng</h6>
                                    <small class="text-muted">Route, Switch</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold" id="network_count"></small>
                                </div>
                            </div>
                        </li>

                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Phụ kiện</h6>
                                    <small class="text-muted">Chuật, Bàn phím, Tai nghe</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold" id="accessory_count"></small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Thống kê yêu cầu</h5>
                    </div>

                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="mt-2 tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3" style="height: 120px">
                                <div class="d-flex flex-column align-items-center gap-1">
                                    <h2 class="mb-2" id="total_request"></h2>
                                    <span>Tổng số yêu cầu</span>
                                </div>
                                <div id="growthChart"></div>
                                <div id="requestStatisticsChart"></div>
                            </div>
                            <div id="incomeChart"></div>
                            <div class="d-flex justify-content-center mt-3">
                                <h5 class="m-0 me-2">Số lượng yêu cầu các ngày gần nhất</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $.ajax({
    url: 'http://127.0.0.1:8000/get-devices-info',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
        // Đổ dữ liệu vào trang Blade
        $('#device_count').text(response.result.devices_count)
        $('#laptop_count').text(response.result.laptop_devices);
        $('#pc_count').text(response.result.pc_devices);
        $('#tablet_count').text(response.result.tablet_devices);
        $('#network_count').text(response.result.network_devices);
        $('#accessory_count').text(response.result.accessory_devices);
    },
    error: function(xhr) {
        // Xử lý lỗi nếu có
    }
});
</script>

<script>
    $.ajax({
    url: 'http://127.0.0.1:8000/get-requests-info',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
        // Đổ dữ liệu vào trang Blade
        $('#total_request').text(response.result.total_requests)

    },
    error: function(xhr) {
        // Xử lý lỗi nếu có
    }
});
</script>
@endif
@endsection
