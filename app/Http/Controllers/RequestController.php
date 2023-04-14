<?php

namespace App\Http\Controllers;

use App\Services\RequestService;
use Exception;
use App\Http\Requests\SendBorrorRequest;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Device;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ConfirmProvideRequest;
use App\Http\Requests\DeliveredRequest;

class RequestController extends Controller
{
    private $requestService;

    public function __construct()
    {
        $this->requestService = new RequestService();
    }

    //status: 0: chua duoc xu ly, 1: da xu ly
    //type: 0: tra thiet bi, 1:muon thiet bi, 2: bao hong 3 gia han pm, 4 admin cap thiet bi
    //result: 0: tu choi cho muon, 1:dong y cho muon
    //message co the dung send mail ly do tu choi....

    //use_histories: status: 0: da tra thiet bi 1: dang muon

    public function showBorrowForm()
    {
        $departments = $this->requestService->allDepartment();

        return view('request.borrowForm', compact('departments'));
    }

    public function sendBorrorRequest(SendBorrorRequest $request)
    {
        try {
            $result = $this->requestService->sendBorrorRequest($request);
            if ($result){
                return redirect()->route('home')->with('success', 'Gửi yêu cầu thành công.');
            } else {
                return back()->with('error', 'Gửi yêu cầu k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function sendReturnRequest()
    {

    }

    public function reportDeviceBroken($device_id)
    {
        try {
            $result = $this->requestService->reportDeviceBroken($device_id);
            if ($result){
                return redirect()->route('request.listDeviceBorrow')->with('success', 'Gửi yêu cầu thành công.');
            } else {
                return back()->with('error', 'Gửi yêu cầu k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function listRequest()
    {
        $requests = $this->requestService->listRequest();

        return view('request.listRequest', compact('requests'));
    }

    public function listRequestBorrow()
    {
        $requests = $this->requestService->listRequestBorrow();

        return view('request.listUserBorrow', compact('requests'));
    }

    public function refuseRequest($id)
    {
        try {
            $result = $this->requestService->refuseRequest($id);
            if ($result){
                return back()->with('success', 'Cập nhật thành công.');
            } else {
                return back()->with('error', 'Cập nhật k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function approveRequest($id)
    {
        try {
            $result = $this->requestService->approveRequest($id);
            if ($result){
                return back()->with('success', 'Cập nhật thành công.');
            } else {
                return back()->with('error', 'Cập nhật k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function provideDeviceForm($id)
    {
        $requests = $this->requestService->findIdRequest($id);
        $requestBorrow = $this->requestService->listRequestBorrow();
        $devices = $this->requestService->listDeviceAvailable();

        return view('request.provideDeviceForm', compact('requests', 'devices', 'requestBorrow'));
    }

    public function provideDevice(ConfirmProvideRequest $request)
    {
        try {
            $result = $this->requestService->provideDevice($request);

            if ($result){
                return back()->with('success', 'Cấp thiết bị thành công.');
            } else {
                return back()->with('error', 'Cấp thiết bị k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function formDelivered($user_id)
    {
        $users = $this->requestService->findUserId($user_id);

        return view('request.delivered', compact('users'));
    }

    public function delivered(DeliveredRequest $request, $user_id)
    {
        try {
            $result = $this->requestService->delivered($request, $user_id);

            if ($result){
                return redirect()->route('request.listRequestBorrow')->with('success', 'Xác nhận thành công.');
            } else {
                return back()->with('error', 'Xác nhận k thành công.');
            }
        } catch (Exception $exception) {
            dd($exception);
            return back()->with('error', 'Lỗi');
        }
    }

    public function listDeviceBorrow()
    {
        $devices = $this->requestService->listDeviceBorrow();

        return view('device.listDeviceBorrowByUser', compact('devices'));
    }
}
