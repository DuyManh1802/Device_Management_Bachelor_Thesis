@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Phần mềm /</span> Danh sách phần mềm</h4>
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
                        <th>Tên phần mềm</th>
                        <th>Ảnh</th>
                        <th>Phiên bản</th>
                        <th>Licence key</th>
                        <th>Lượt dùng</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày hết hạn</th>
                        <th>Giá bản quyền</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ( $softwares as $key => $software )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><strong>{{ $software->name }}</strong></td>
                        <td><img src="{{ asset('image/software/' . $software->image) }}" alt="" width="40px"
                                height="40px"></td>
                        <td>{{ $software->version }}
                        </td>
                        <td>{{ $software->license_key }}</td>
                        <td>{{ $software->usage_count }}</td>
                        <td>{{ $software->start }}</td>
                        <td>{{ $software->end }}</td>
                        <td>{{ $software->license_price }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('software.listDeviceUsage', $software->id) }}"><i
                                            class="fas fa-laptop"></i> Thiết bị sử dụng</a>
                                    <a class="dropdown-item" href="{{ route('software.edit', $software->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i> Sửa</a>
                                    <a class="dropdown-item" href="{{ route('software.delete', $software->id) }}"
                                        onclick="return myFunction();"><i class="bx bx-trash me-1"></i>
                                        Xóa</a>
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
        {{ $softwares->links() }}
    </div>
</div>
@endsection
