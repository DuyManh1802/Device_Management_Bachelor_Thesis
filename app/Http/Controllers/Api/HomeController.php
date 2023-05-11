<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HomeService;

class HomeController extends Controller
{
    private $homeService;

    public function __construct()
    {
        $this->homeService = new HomeService();
    }

    public function getDevicesInfo()
    {
        $devices = $this->homeService->getDevicesInfo();

        return response()->json(array(
            'code'  => 200,
            'result' => $devices
        ));
    }

    public function getRequestsInfo()
    {
        $requests = $this->homeService->getRequestsInfo();

        return response()->json(array(
            'code'  => 200,
            'result' => $requests
        ));
    }

    public function getRequestByDay()
    {
        $requests = $this->homeService->getRequestByDay();

        return response()->json(array(
            'code'  => 200,
            'result' => $requests
        ));
    }
}
