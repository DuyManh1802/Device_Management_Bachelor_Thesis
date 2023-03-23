<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeviceService;
use Exception;
use App\Http\Requests\CreateDeviceRequest;
use App\Http\Requests\EditDeviceRequest;

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
            $device = $this->deviceService->allDevice();
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }

        return view('device.list', compact('device'));
    }

    public function create()
    {
        return view('device.create');
    }

    public function store(CreateDeviceRequest $request)
    {
        try {
            $result = $this->deviceService->storeDevice($request);

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
        $device = $this->deviceService->findId($id);

        return view('device.edit', compact('device'));
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
}