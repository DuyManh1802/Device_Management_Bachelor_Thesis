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

    //condition: 0 đang hỏng, 1: bình thường, 2: dang sua chua, 3: dang bao hanh, 4 da thanh ly
    //status: 0: đang sử dụng, 1: đang rảnh

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

    public function listDeviceRepairing()
    {
        $devices = $this->deviceService->listDeviceRepairing();

        return view('device.listDeviceRepairing', compact('devices'));
    }

    public function listDeviceBrokening()
    {
        $devices = $this->deviceService->listDeviceBrokening();

        return view('device.listDeviceBrokening', compact('devices'));
    }

    public function listDeviceWarranting()
    {
        $devices = $this->deviceService->listDeviceWarranting();

        return view('device.listDeviceWarranting', compact('devices'));
    }

    public function listSoftwareUsage($device_id)
    {
        $softwares = $this->deviceService->listSoftwareByDevice($device_id);

        return view('software.list', compact('softwares'));
    }

    public function listDeviceWarrantiedOrRepaired()
    {
        $devices = $this->deviceService->listDeviceWarrantiedOrRepaired();

        return view('device.listDeviceWarrantiedOrRepaired', compact('devices'));
    }

    public function detailDeviceWarrantiedOrRepaired($id)
    {
        $deviceWarrantied = $this->deviceService->detailDeviceWarrantied($id);
        $deviceRepaired = $this->deviceService->detailDeviceRepaired($id);

        return view('device.detailDeviceWarrantiedOrRepaired', compact('deviceWarrantied', 'deviceRepaired'));
    }
}
