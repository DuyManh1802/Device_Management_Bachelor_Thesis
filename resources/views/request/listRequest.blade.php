@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Yêu cầu /</span> Danh sách yêu cầu</h4>
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
        <div class="d-flex justify-content-end p-3">
            <a href="{{ route('request.adminProvideDeviceForm') }}" class="m-1">
                <button type="button" class="btn btn-outline-primary">Cấp thiết bị</button>
            </a>

            {{-- <a href="" class="m-1">
                <button type="button" class="btn btn-outline-primary">Gửi licence key</button>
            </a>

            <a href="{{ route('request.recallDeviceForm') }}" class="m-1">
                <button type="button" class="btn btn-outline-primary">Thu hồi thiết bị</button>
            </a> --}}
        </div>
        <div class="table-responsive ">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Phòng</th>
                        <th>Người gửi</th>
                        <th>Thể loại</th>
                        <th>Ghi chú</th>
                        <th>Ngày gửi yêu cầu</th>
                        <th>Trạng thái</th>
                        <th>Kết quả</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ( $requests as $key => $req )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $req->department->name }}</td>
                        <td><strong>{{ $req->user->name }}</strong></td>
                        <td>
                            @if ($req->type == 0)
                            <span class="badge bg-label-primary me-1">Trả thiết bị</span>
                            @elseif ($req->type == 1)
                            <span class="badge bg-label-success me-1">Mượn thiết bị</span>
                            @elseif ($req->type == 2)
                            <span class="badge bg-label-warning me-1">Báo hỏng</span>
                            @elseif ($req->type == 3)
                            <span class="badge bg-label-info me-1">Gia hạn phần mềm</span>
                            @elseif ($req->type == 4)
                            <span class="badge bg-label-info me-1">Cấp thiết bị</span>
                            @else
                            <span class="badge bg-label-warning me-1">Không xác định</span>
                            @endif
                        </td>
                        <td>{{ $req->note }}</td>
                        <td>{{ $req->created_at }}</td>
                        <td>@if ($req->status == 0)
                            <span class="badge bg-label-warning me-1">Chưa xử lý</span>
                            @elseif ($req->status == 1)
                            <span class="badge bg-label-success me-1">Đã xử lý</span>
                            @else
                            <span class="badge bg-label-warning me-1">Không xác định</span>
                            @endif
                        </td>
                        <td>@if ($req->result === 0)
                            <span class="badge bg-label-warning me-1">Từ chối</span>
                            @elseif ($req->result == 1)
                            <span class="badge bg-label-success me-1">Đồng ý</span>
                            @else
                            <span class="badge bg-label-warning me-1">Chưa xử lý</span>
                            @endif
                        </td>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if($req->status != 1)
                                    <a class="dropdown-item" href="{{ route('request.approveRequest', $req->id) }}"
                                        onclick="return confirmAction();"><i class="fas fa-check-double me-1"></i>
                                        Đồng ý</a>
                                    <a class="dropdown-item" href="{{ route('request.refuseRequest', $req->id) }}"
                                        onclick="return confirmAction();"><i class="far fa-times-circle me-1"></i>
                                        Từ chối</a>
                                    @endif

                                    @if($req->status == 1 || $req->result == 1)
                                    @if ($req->result == 1 && $req->status == 1 && $req->type == 4 || $req->type == 1)
                                    <a class="dropdown-item"
                                        href="{{ route('request.provideDeviceForm', $req->id) }}"><i
                                            class="fas fa-check-double me-1"></i>
                                        Cấp thiết bị</a>

                                    @if($req->confirm == 1)
                                    <a class="dropdown-item"
                                        href="{{ route('request.formDelivered', $req->user_id) }}"><i
                                            class="far fa-check-circle me-1"></i> Đã lấy
                                        thiết
                                        bị</a>
                                    @endif
                                    @endif

                                    @if ($req->result == 1 && $req->status == 1 && $req->type == 0)
                                    <a class="dropdown-item" href="#"><i class="far fa-check-circle me-1"></i> Đã trả
                                        thiết
                                        bị</a>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $requests->links() }}
    </div>
</div>
@endsection
