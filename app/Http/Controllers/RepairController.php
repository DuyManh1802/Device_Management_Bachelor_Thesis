<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RepairService;
use Exception;
use App\Http\Requests\RepairedRequest;

class RepairController extends Controller
{
    private $repairService;

    public function __construct()
    {
        $this->repairService = new RepairService();
    }
    public function repairDevice($device_id)
    {
        try {
            $result = $this->repairService->repairDevice($device_id);
            if ($result){
                return back()->with('success', 'thành công.');
            } else {
                return back()->with('error', 'k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function repairDeviceForm($device_id)
    {
        $repairs = $this->repairService->findRepairByDevice($device_id);

        return view('repair.repairDeviceForm', compact('repairs'));
    }

    public function repairDeviced($id, RepairedRequest $request)
    {
        try {
            $result = $this->repairService->repairDeviced($id, $request);
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
