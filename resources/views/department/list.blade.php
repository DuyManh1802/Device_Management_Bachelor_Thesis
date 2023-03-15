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
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('department.edit', $department->id) }}"><i
                                            class=" bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <a class="dropdown-item" href="{{ route('department.delete', $department->id) }}"><i
                                            class="bx bx-trash me-1"></i>
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

</div>
@stop
