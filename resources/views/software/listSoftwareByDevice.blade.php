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
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Thiết bị</th>
                        <th>Tên phần mềm</th>
                        <th>Ảnh</th>
                        <th>Phiên bản</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày hết hạn</th>
                        <th>Giá bản quyền</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ( $softwares as $key => $software )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $software->devices->name }}</td>
                        <td><strong>{{ $software->softwares->name }}</strong></td>
                        <td><img src="{{ $software->softwares->image }}" alt=""></td>
                        <td>{{ $software->softwares->version }}</td>
                        <td>{{ $software->softwares->start }}</td>
                        <td>{{ $software->softwares->end }}</td>
                        <td>{{ $software->softwares->license_price }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                {{-- <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('software.edit', $software->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i> Sửa</a>
                                    <a class="dropdown-item" href="{{ route('software.delete', $software->id) }}"
                                        onclick="return myFunction();"><i class="bx bx-trash me-1"></i>
                                        Xóa</a>
                                </div> --}}
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
