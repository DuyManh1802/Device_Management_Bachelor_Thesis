@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên phòng</th>
                        <th>Người quản lý</th>
                        <th>Địa chỉ</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ( $departments as $key => $department )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><strong>{{ $department->name }}</strong></td>
                        <td>{{ $department->manager }}</td>
                        <td>{{ $department->address }}</td>
                        <td>
                            <a href="{{ route('department.edit', $department->id) }}">
                                <i class=" bx bx-edit-alt me-1"></i>
                                Edit</a>
                        </td>
                        <td>
                            <a href="{{ route('department.delete', $department->id) }}"><i class="bx bx-trash me-1"></i>
                                Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
