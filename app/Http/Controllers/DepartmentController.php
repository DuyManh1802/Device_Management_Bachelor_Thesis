<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DepartmentService;
use Exception;
use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\EditDepartmentRequest;

class DepartmentController extends Controller
{
    private $departmentService;

    public function __construct()
    {
        $this->departmentService = new DepartmentService();
    }

    public function index()
    {
        try {
            $departments = $this->departmentService->allDepartment();
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }

        return view('department.list', compact('departments'));
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(CreateDepartmentRequest $request)
    {
        try {
            $result = $this->departmentService->storeDepartment($request);

            if ($result){
                return redirect()->route('department.index')->with('success', 'Thêm mới thành công.');
            } else {
                return back()->with('error', 'Thêm mới k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function edit($id)
    {
        $departments = $this->departmentService->findId($id);

        return view('department.edit', compact('departments'));
    }

    public function update(EditDepartmentRequest $request, $id)
    {
        try {
            $result = $this->departmentService->updateDepartment($request, $id);

            if ($result){
                return redirect()->route('department.index')->with('success', 'Sửa thành công.');
            } else {
                return back()->with('error', 'Sửa k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->departmentService->deleteDepartment($id);

            if ($result){
                return redirect()->route('department.index')->with('success', 'Xóa thành công.');
            } else {
                return back()->with('error', 'Xóa k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }
}