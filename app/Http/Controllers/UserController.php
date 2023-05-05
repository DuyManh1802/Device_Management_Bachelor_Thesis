<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Services\UserService;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;

class UserController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index(Request $request)
    {
        try {
            $users = $this->userService->allUser($request);
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }

        return view('user.list', compact('users'));
    }

    public function create()
    {
        $departments = $this->userService->allDepartment();

        return view('user.create', compact('departments'));
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $result = $this->userService->storeUser($request);

            if ($result){
                return redirect()->route('user.index')->with('success', 'Thêm mới người dùng thành công.');
            } else {
                return back()->with('error', 'Thêm mới người dùng k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function edit($id)
    {
        $users = $this->userService->findId($id);
        $departments = $this->userService->allDepartment();

        return view('user.edit', compact('users', 'departments'));
    }

    public function update(EditUserRequest $request, $id)
    {
        try {
            $result = $this->userService->updateUser($request, $id);

            if ($result){
                return redirect()->route('user.index')->with('success', 'Sửa người dùng thành công.');
            } else {
                return back()->with('error', 'Sửa người dùng k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->userService->deleteUser($id);

            if ($result){
                return redirect()->route('user.index')->with('success', 'Xóa người dùng thành công.');
            } else {
                return back()->with('error', 'Xóa người dùng k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function profile($id)
    {
        $user = $this->userService->findId($id);

        return view('user.profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request, $id)
    {
        try {
            $result = $this->userService->updateProfile($request, $id);

            if ($result){
                return redirect()->route('home')->with('success', 'Sửa thông tin cá nhân thành công.');
            } else {
                return back()->with('error', 'Sửa thông tin cá nhân k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function changePasswordForm($id)
    {
        $user = $this->userService->findId($id);

        return view('user.changePassword', compact('user'));
    }

    public function changePassword(ChangePasswordRequest $request, $id)
    {
        try {
            $result = $this->userService->changePassword($request, $id);

            if ($result){
                return redirect()->route('home')->with('success', 'Đổi mật khẩu thành công.');
            } else {
                return back()->with('error', 'Đổi mật khẩu k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }
}
