<?php
    namespace App\Services;
    use App\Models\Device;
    use App\Models\Request;
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;

    class HomeService
    {
        public function getDevicesInfo() {
            // Lấy thông tin tất cả các thiết bị
            $devices = Device::all();

            $devices_count = $devices->count();
            // Lấy số lượng các thiết bị theo trạng thái
            $damaged_count = $devices->where('condition', 0)->count();
            $normal_count = $devices->where('condition', 1)->count();
            $repairing_count = $devices->where('condition', 2)->count();
            $warranty_count = $devices->where('condition', 3)->count();

            // Lấy danh sách các thiết bị có danh mục là 'laptop' hoặc 'PC'
            $laptop_devices = Device::whereHas('category', function ($query) {
                $query->whereIn('name', ['Laptop']);
            })->count();
            $pc_devices = Device::whereHas('category', function ($query) {
                $query->whereIn('name', ['PC']);
            })->count();
            $tablet_devices = Device::whereHas('category', function ($query) {
                $query->whereIn('name', ['Máy tính bảng']);
            })->count();
            $network_devices = Device::whereHas('category', function ($query) {
                $query->whereIn('name', ['Thiết bị mạng']);
            })->count();
            $accessory_devices = Device::whereHas('category', function ($query) {
                $query->whereIn('name', ['Phụ kiện']);
            })->count();

            return [
                'devices_count' => $devices_count,
                'damaged_count' => $damaged_count,
                'normal_count' => $normal_count,
                'repairing_count' => $repairing_count,
                'warranty_count' => $warranty_count,
                'laptop_devices' => $laptop_devices,
                'pc_devices' => $pc_devices,
                'tablet_devices' => $tablet_devices,
                'network_devices' => $network_devices,
                'accessory_devices' => $accessory_devices,
            ];
         }

         public function getRequestsInfo()
         {
            $total_requests = Request::with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->count();
            $pending_requests = Request::with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->where('status', 0)->count();
            $processed_requests = Request::with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->where('status', 1)->count();
            $borrow_requests = Request::with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->where('type', 1)->count();
            $return_requests = Request::with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->where('type', 2)->count();
            $broken_requests = Request::with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->where('type', 2)->count();
            $license_requests = Request::with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->where('type', 3)->count();

            return [
                'total_requests' => $total_requests,
                'pending_requests' => $pending_requests,
                'processed_requests' => $processed_requests,
                'borrow_requests' => $borrow_requests,
                'return_requests' => $return_requests,
                'broken_requests' => $broken_requests,
                'license_requests' => $license_requests
            ];
         }

         public function getRequestByDay()
         {
            $request_mon = Request::Monday()->with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->count();

            $request_tue = Request::Tuesday()->with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->count();

            $request_wed = Request::Wednesday()->with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->count();

            $request_thu = Request::Thursday()->with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->count();

            $request_fri = Request::Friday()->with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->count();

            $request_sat = Request::Saturday()->with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->count();

            $request_sun = Request::Sunday()->with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->count();

            return [
                'request_mon' => $request_mon,
                'request_tue' => $request_tue,
                'request_wed' => $request_wed,
                'request_thu' => $request_thu,
                'request_fri' => $request_fri,
                'request_sat' => $request_sat,
                'request_sun' => $request_sun
            ];
         }
    }
