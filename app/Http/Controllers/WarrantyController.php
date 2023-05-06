<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WarrantyService;
use Exception;
use App\Http\Requests\WarrantiedRequest;

class WarrantyController extends Controller
{
    private $warrantyService;

    public function __construct()
    {
        $this->warrantyService = new WarrantyService();
    }

    public function warrantyDevice($device_id)
    {
        try {
            $result = $this->warrantyService->warrantyDevice($device_id);
            if ($result){
                return back()->with('success', 'thành công.');
            } else {
                return back()->with('error', 'k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function warrantyDeviceForm($device_id)
    {
        $warranties = $this->warrantyService->findWarrantyByDevice($device_id);

        return view('warranty.warrantyDeviceForm', compact('warranties'));
    }

    public function warrantyDeviced($id, WarrantiedRequest $request)
    {
        try {
            $result = $this->warrantyService->warrantyDeviced($id, $request);
            if ($result){
                return redirect()->route('device.listDeviceBrokening')->with('success', 'thành công.');
            } else {
                return back()->with('error', 'k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }
}
