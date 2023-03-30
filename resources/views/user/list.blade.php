@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
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
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Ảnh</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Quyền</th>
                        <th>Phòng làm việc</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ( $users as $key => $user )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td><img src="{{ $user->image }}" alt=""></td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->department->name ?? '' }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i> Sửa</a>
                                    <a class="dropdown-item" href="{{ route('user.delete', $user->id) }}"
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
    <div class="d-flex justify-content-center mt-2">
        {{ $users->links() }}
    </div>
</div>
@endsection
