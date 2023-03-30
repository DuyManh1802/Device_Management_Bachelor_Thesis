<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeviceService;
use Exception;
use App\Http\Requests\CreateDeviceRequest;
use App\Http\Requests\EditDeviceRequest;
use App\Http\Requests\CreateWarrantyRequest;
use App\Models\Category;

class DeviceController extends Controller
{
    private $deviceService;

    public function __construct()
    {
        $this->deviceService = new DeviceService();
    }

    public function index()
    {
        try {
            $devices = $this->deviceService->allDevice();

        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }

        return view('device.list', compact('devices'));
    }

    public function create()
    {
        $categories = $this->deviceService->allCategory();

        return view('device.create', compact('categories'));
    }

    public function store(CreateDeviceRequest $request, CreateWarrantyRequest $req)
    {
        try {
            $result = $this->deviceService->storeDevice($request, $req);
            if ($result){
                return redirect()->route('device.index')->with('success', 'Thêm mới thành công.');
            } else {
                return back()->with('error', 'Thêm mới k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function edit($id)
    {
        $devices = $this->deviceService->findId($id);
        $categories = $this->deviceService->allCategory();

        return view('device.edit', compact('devices', 'categories'));
    }

    public function update(EditDeviceRequest $request, $id)
    {
        try {
            $result = $this->deviceService->updateDevice($request, $id);

            if ($result){
                return redirect()->route('device.index')->with('success', 'Sửa thành công.');
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
            $result = $this->deviceService->deleteDevice($id);

            if ($result){
                return redirect()->route('device.index')->with('success', 'Xóa thành công.');
            } else {
                return back()->with('error', 'Xóa k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function showByCategory(Category $category)
    {
        // $devices = $this->deviceService->showByCategory();
        $devices = $category->devices()->paginate(10);

        return view('device.list', compact('devices'));
    }
}
