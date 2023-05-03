@extends('layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thiết bị /</span> Danh sách thiết bị đang hỏng</h4>
    @if (session('success'))
    <div class="text-center" role="alert">
        <h4 class="alert alert-success">{{ session('success') }}</h4>
    </div>
    @endif
    @if (session('error'))
    <div class="text-center" role="alert">
        <h4 class="alert alert-danger">{{ session('error') }}</h4>
    </div>
    @endif
    @if (session('alert'))
    <div class="text-center" role="alert">
        <h4 class="alert alert-danger">{{ session('alert') }}</h4>
    </div>
    @endif
    <div class="card">
        <div class="table-responsive text-wrap">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Danh mục</th>
                        <th>Tên thiết bị</th>
                        <th>Ảnh</th>
                        <th>Màu sắc</th>
                        <th>Cấu hình</th>
                        <th>Tình trạng</th>
                        <th>Giá nhập</th>
                        <th>MFG Bảo hành</th>
                        <th>EXP Bảo hành</th>
                        <th>Thời hạn BH còn (ngày)</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ( $devices as $key => $device )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $device->category->name }}</td>
                        <td><strong>{{ $device->name }}</strong></td>
                        <td><img src="{{ asset('image/device/' . $device->image) }}" alt="" width="40px" height="40px">
                        </td>
                        <td>{{ $device->color }}</td>
                        <td>{{ $device->configuration }}</td>
                        <td>
                            @if ($device->condition === 1)
                            <span class="badge bg-label-success me-1">Bình thường</span>
                            @elseif ($device->condition === 0)
                            <span class="badge bg-label-warning me-1">Đang hỏng</span>
                            @elseif ($device->condition === 2)
                            <span class="badge bg-label-warning me-1">Đang sửa chữa</span>
                            @elseif ($device->condition === 3)
                            <span class="badge bg-label-warning me-1">Đang bảo hành</span>
                            @else
                            <span class="badge bg-label-info me-1">Không xác định</span>
                            @endif
                        </td>
                        <td>{{ $device->purchase_price }}</td>
                        @foreach ($device->warranties as $warranty)
                        <td>{{ $warranty->start }}</td>
                        <td>{{ $warranty->end }}</td>
                        <td>
                            @php
                            $dateWarranty = (Carbon\Carbon::now())->diffInDays(Carbon\Carbon::parse($warranty->end),
                            false);
                            @endphp {{ $dateWarranty > 0 ? $dateWarranty : 'Đã hết hạn' }}</td>
                        <td>

                            @endforeach
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if($dateWarranty > 0)
                                    @if($device->condition === 3)

                                    <a class="dropdown-item"
                                        href="{{ route('warranty.warrantyDeviceForm', $device->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i> Đã BH xong</a>
                                    @endif
                                    @if($device->condition === 0)

                                    <a class="dropdown-item"
                                        href="{{ route('warranty.warrantyDevice', $device->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i> Đã mang đi BH</a>
                                    @endif
                                    @else
                                    @if($device->condition === 0)

                                    <a class="dropdown-item" href="{{ route('repair.repairDevice', $device->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i> Đã mang đi
                                        sửa chữa</a>
                                    @endif
                                    @if($device->condition === 2)

                                    <a class="dropdown-item"
                                        href="{{ route('repair.repairDeviceForm', $device->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i> Đã sửa chữa
                                        xong</a>
                                    @endif

                                </div>
                                @endif
                            </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
