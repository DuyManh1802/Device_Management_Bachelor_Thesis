@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
    <div class="alert alert-success">
        <h5>{{ session('success') }}</h5>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif
    @if (session('alert'))
    <div class="alert alert-danger text-center">{{ session('alert') }}</div>
    @endif
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Email</th>
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
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ route('user.delete', $user->id) }}"
                                        onclick="return myFunction();"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $users->links() }}
</div>
@endsection
