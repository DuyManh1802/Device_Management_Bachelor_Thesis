@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin thiết bị</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive text-wrap">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Tên thiết bị</th>
                                    <th>Ảnh</th>
                                    <th>Màu sắc</th>
                                    <th>Cấu hình</th>
                                    <th>Tình trạng</th>
                                    <th>Giá nhập</th>
                                    <th>Thời hạn BH còn (ngày)</th>
                                    <th>Số lần BH</th>
                                    <th>Số lần sửa chữa</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td><strong>{{ $deviceWarrantied->name }}</strong></td>
                                    <td><img src="{{ asset('image/device/' . $deviceWarrantied->image) }}" alt=""
                                            width="40px" height="40px">
                                    </td>
                                    <td>{{ $deviceWarrantied->color }}</td>
                                    <td>{{ $deviceWarrantied->configuration }}</td>
                                    <td>
                                        @if ($deviceWarrantied->condition === 1)
                                        <span class="badge bg-label-success me-1">Bình thường</span>
                                        @elseif ($deviceWarrantied->condition === 0)
                                        <span class="badge bg-label-warning me-1">Đang hỏng</span>
                                        @elseif ($deviceWarrantied->condition === 2)
                                        <span class="badge bg-label-warning me-1">Đang sửa chữa</span>
                                        @elseif ($deviceWarrantied->condition === 3)
                                        <span class="badge bg-label-warning me-1">Đang bảo hành</span>
                                        @else
                                        <span class="badge bg-label-info me-1">Không xác định</span>
                                        @endif
                                    </td>
                                    <td>{{ $deviceWarrantied->purchase_price }}</td>
                                    @foreach ($deviceWarrantied->warranties as $warranty)

                                    <td>
                                        @php
                                        $dateWarranty =
                                        (Carbon\Carbon::now())->diffInDays(Carbon\Carbon::parse($warranty->end),
                                        false);
                                        @endphp {{ $dateWarranty > 0 ? $dateWarranty : 'Đã hết hạn' }}
                                    </td>
                                    <td>{{ $warranty->warranty_count }}</td>
                                    @endforeach
                                    @foreach($deviceWarrantied->repairs as $repair)
                                    <td>{{ $repair->repair_count }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin bảo hành</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-wrap">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Lần</th>
                                    <th>Nội dung</th>
                                    <th>Kết quả</th>
                                    <th>Ngày bắt đầu bảo hành</th>
                                    <th>Ngày bảo hành xong</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($deviceWarrantied->warrantyDetails as $key => $warrantyDetail)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $warrantyDetail->content }}</td>
                                    <td>{{ $warrantyDetail->result }}</td>
                                    <td>{{ $warrantyDetail->created_at }}</td>
                                    <td>{{ $warrantyDetail->updated_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin sửa chữa</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-wrap">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Lần</th>
                                    <th>Kiểu</th>
                                    <th>Nội dung</th>
                                    <th>Kết quả</th>
                                    <th>Chi phí</th>
                                    <th>Ngày bắt đầu sửa chữa</th>
                                    <th>Ngày sửa chữa xong</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($deviceRepaired->repairs as $key => $repairs)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @foreach ($repairs->typeRepairs as $typeRepair)
                                        {{ $typeRepair->type }}
                                        @endforeach
                                    </td>
                                    @foreach($repairs->repairDetails as $repair)

                                    <td>{{ $repair->content }}</td>
                                    <td>{{ $repair->result }}</td>
                                    <td>{{ $repair->cost }}</td>
                                    <td>{{ $repair->created_at }}</td>
                                    <td>{{ $repair->updated_at }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
