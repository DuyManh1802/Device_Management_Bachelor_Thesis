<?php

namespace App\Http\Controllers;

use App\Services\RequestService;
use Exception;
use App\Http\Requests\SendBorrorRequest;;
use App\Http\Requests\ConfirmProvideRequest;
use App\Http\Requests\DeliveredRequest;
use App\Http\Requests\sendBorrorRequestLicensekeyRequest;
use App\Http\Requests\SendLicenseRequest;
use PDF;
use App\Http\Requests\ReturnedRequest;
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

    public function sendReturnRequest($device_id)
    {
        try {
            $result = $this->requestService->sendReturnRequest($device_id);
            if ($result){
                return redirect()->route('request.listDeviceBorrow')->with('success', 'Gửi yêu cầu thành công.');
            } else {
                return back()->with('error', 'Gửi yêu cầu k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
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

    public function generateListRequestPDF()
    {
        $requests = $this->requestService->listRequest();

        $data = [
            'requests' => $requests
        ];

        $pdf = PDF::loadView('pdf.listRequest', $data)->setOptions(['defaultFont' => 'Times New Roman']);

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

    public function listRequestBorrow()
    {
        $requests = $this->requestService->listRequestBorrow();

        return view('request.listUserBorrow', compact('requests'));
    }

    public function listAdminProvideDevice()
    {
        $requests = $this->requestService->listAdminProvideDevice();

        return view('request.listAdminProvideDevice', compact('requests'));
    }

    public function listRequestReturn()
    {
        $requests = $this->requestService->listRequestReturn();

        return view('request.listRequestReturn', compact('requests'));
    }

    public function listRequestBroken()
    {
        $requests = $this->requestService->listRequestBroken();

        return view('request.listRequestBroken', compact('requests'));
    }

    public function listRequestLicensekey()
    {
        $requests = $this->requestService->listRequestLicensekey();

        return view('request.listRequestLicensekey', compact('requests'));
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
                return redirect()->route('request.listRequestBorrow')->with('success', 'Cấp thiết bị thành công.');
            } else {
                return back()->with('error', 'Cấp thiết bị k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function provideLicenseKeyForm($user_id, $device_id)
    {
        $devices = $this->requestService->findDevice($device_id);
        $softwares = $this->requestService->listSoftwareAvailable();
        $users = $this->requestService->findUserId($user_id);

        return view('request.provideLicenseKeyForm', compact('devices', 'softwares', 'users'));
    }

    public function provideLicenseKey(SendLicenseRequest $request)
    {

        try {
            $result = $this->requestService->provideLicenseKey($request);
            if ($result){
                return redirect()->route('request.listRequestLicenseKey')->with('success', 'Gửi License Key thành công.');
            } else {
                return back()->with('error', 'Gửi License Key thành công.');
            }
        } catch (Exception $exception) {
            dd($exception);
            return back()->with('error', 'Lỗi');
        }
    }

    public function formDelivered($id)
    {
        $requests = $this->requestService->findIdRequest($id);

        return view('request.delivered', compact('requests'));
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
            return back()->with('error', 'Lỗi');
        }
    }

    public function formReturned($id)
    {
        $requests = $this->requestService->findIdRequest($id);

        return view('request.returned', compact('requests'));
    }

    public function returned(ReturnedRequest $request, $id)
    {
        try {
            $result = $this->requestService->returned($request, $id);

            if ($result){
                return redirect()->route('request.listRequestReturn')->with('success', 'Xác nhận thành công.');
            } else {
                return back()->with('error', 'Xác nhận k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function listDeviceBorrow()
    {
        $devices = $this->requestService->listDeviceBorrow();

        return view('device.listDeviceBorrowByUser', compact('devices'));
    }

    public function listDeviceAvailabale()
    {
        $devices = $this->requestService->listDeviceAvailable();

        return view('device.listDeviceAvailable', compact('devices'));
    }

    public function listDeviceBorrowed()
    {
        $devices = $this->requestService->listDeviceBorrowed();

        return view('device.listDeviceBorrowed', compact('devices'));
    }

    public function showBorrowFormLicensekey($device_id)
    {
        $devices = $this->requestService->findDevice($device_id);

        return view('request.borrowLicenseKeyForm', compact('devices'));
    }

    public function sendBorrorRequestLicensekey(sendBorrorRequestLicensekeyRequest $request, $device_id)
    {
        try {
            $result = $this->requestService->sendBorrorRequestLicensekey($request, $device_id);

            if ($result){
                return redirect()->route('home')->with('success', 'Gửi yêu cầu thành công.');
            } else {
                return back()->with('error', 'Xác nhận k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function listRequestByUser()
    {
        $requests = $this->requestService->listRequestByUser();

        return view('request.listRequestByUser', compact('requests'));
    }

    public function adminProvideDeviceForm()
    {
        $departments = $this->requestService->allDepartment();
        $users = $this->requestService->allUser();
        $devices = $this->requestService->listDeviceAvailable();

        return view('request.adminProvideDeviceForm', compact('devices', 'departments', 'users'));
    }

    public function recallDeviceForm()
    {
        $users = $this->requestService->allUser();

        return view('request.recallDevice', compact('users', 'devices'));
    }

    public function recallDevice()
    {

    }
}
