@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"> Thông tin cá nhân</h4>
    <div class="card mb-4">
        <!-- Account -->
        <form id="formAccountSettings" action="{{ route('user.updateProfile', Auth::user()->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{ asset('image/user/' . $user->image) }}" alt="user-avatar" class="d-block rounded"
                        height="100" width="100" id="uploadedAvatar" />
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-outline-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Thay đổi ảnh</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" class="account-file-input" hidden
                                accept="image/png, image/jpeg, image/jpg" name="image" value="{{ $user->image }}" />
                        </label>

                    </div>
                </div>
            </div>
            <hr class="my-0" />

            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">Họ và tên</label>
                        <input class="form-control" type="text" id="firstName" name="name" value="{{ $user->name }}"
                            autofocus />
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}"
                            placeholder="john.doe@example.com" readonly />
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phoneNumber">Số điện thoại</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">VN (+84)</span>
                            <input type="text" id="phoneNumber" name="phone" class="form-control"
                                placeholder="0xx xxx xxxx" value="{{ $user->phone}}" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                            value="{{ $user->address }}" />
                    </div>

                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-outline-primary me-2">Cập nhật</button>
                </div>
            </div>
            <!-- /Account -->
        </form>
    </div>
</div>
@endsection
