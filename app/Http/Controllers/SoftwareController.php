<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Services\SoftwareService;
use App\Http\Requests\CreateSoftwareRequest;
use App\Http\Requests\EditSoftwareRequest;

class SoftwareController extends Controller
{
    private $softwareService;

    public function __construct()
    {
        $this->softwareService = new SoftwareService();
    }

    public function index()
    {
        $softwares = $this->softwareService->allSoftware();

        return view('software.list', compact('softwares'));
    }

    public function create()
    {
        $devices = $this->softwareService->allDevice();

        return view('software.create', compact('devices'));
    }

    public function store(CreateSoftwareRequest $request)
    {
        try {
            $result = $this->softwareService->storeSoftware($request);
            if ($result){
                return redirect()->route('software.index')->with('success', 'Thêm mới thành công.');
            } else {
                return back()->with('error', 'Thêm mới k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function edit($id)
    {
        $softwares = $this->softwareService->findId($id);

        return view('software.edit', compact('softwares'));
    }

    public function update(EditSoftwareRequest $request, $id)
    {
        try {
            $result = $this->softwareService->updateSoftware($request, $id);

            if ($result){
                return redirect()->route('software.index')->with('success', 'Sửa thành công.');
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
            $result = $this->softwareService->deleteSoftware($id);

            if ($result){
                return redirect()->route('software.index')->with('success', 'Xóa thành công.');
            } else {
                return back()->with('error', 'Xóa k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }
}
