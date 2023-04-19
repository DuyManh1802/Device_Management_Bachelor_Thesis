@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Yêu cầu /</span> Danh sách yêu cầu mượn thiết bị
    </h4>
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
        <div class="table-responsive ">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Phòng</th>
                        <th>Người gửi</th>
                        <th>Thể loại</th>
                        <th>Ghi chú</th>
                        <th>Ngày dự kiến mượn</th>
                        <th>Trạng thái</th>
                        <th>Kết quả</th>
                        <th>Đã lấy</th>
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
                        <td>{{ $req->start_date }}</td>
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
                        <td>@if ($req->confirm === 0)
                            <span class="badge bg-label-warning me-1">Chưa lấy</span>
                            @elseif ($req->confirm === 1)
                            <span class="badge bg-label-success me-1">Đã lấy</span>
                            @else
                            <span class="badge bg-label-warning me-1">Không xác định</span>
                            @endif
                        </td>
                        <td>
                            @if ($req->result == 1)

                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">

                                    @if($req->status == 0)
                                    <a class="dropdown-item" href="{{ route('request.approveRequest', $req->id) }}"
                                        onclick="return myFunction();"><i class="fas fa-check-double me-1"></i>
                                        Đồng ý</a>
                                    <a class="dropdown-item" href="{{ route('request.refuseRequest', $req->id) }}"
                                        onclick="return myFunction();"><i class="far fa-times-circle me-1"></i>
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
                                    <a class="dropdown-item"
                                        href="{{ route('request.formDelivered', $req->user_id) }}"><i
                                            class="far fa-check-circle me-1"></i> Đã trả
                                        thiết
                                        bị</a>
                                    @endif
                                    @endif
                                </div>
                            </div>
                            @endif
                        </td>
                        {{-- <div class="col-lg-4 col-md-6">

                            <div class="mt-3">
                                <!-- Button trigger modal -->
                                <!-- Modal -->

                                <form action="{{ route('request.delivered', $req->user_id) }}" method="POST">
                                    @csrf
                                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1">Xác nhận
                                                        đã lấy thiết bị</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="dobBasic" class="form-label">Ngày
                                                                lấy thiết bị</label>
                                                            <input type="date" id="dobBasic" class="form-control"
                                                                name="borrowed_date" placeholder="DD / MM / YY" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="dobBasic" class="form-label">Ngày dự
                                                                kiến trả</label>
                                                            <input type="date" id="dobBasic" class="form-control"
                                                                name="return_date" placeholder="DD / MM / YY" />
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Xác
                                                        nhận</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> --}}
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
{{-- <div class="col-lg-4 col-md-6">

    <div class="mt-3">
        <!-- Button trigger modal -->
        <!-- Modal -->
        <form action="" method="POST">
            @csrf
            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Xác nhận đã lấy thiết bị</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="dobBasic" class="form-label">Ngày lấy thiết bị</label>
                                    <input type="date" id="dobBasic" class="form-control" placeholder="DD / MM / YY" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="dobBasic" class="form-label">Ngày dự kiến trả</label>
                                    <input type="date" id="dobBasic" class="form-control" placeholder="DD / MM / YY" />
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> --}}
