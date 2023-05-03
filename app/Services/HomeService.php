<?php
    namespace App\Services;
    use App\Models\Device;
    use App\Models\Request;

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
            // Lấy tổng số request và số request.status = 0 và 1
            $total_requests = Request::with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->count();
            $pending_requests = Request::with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->where('status', 0)->count();
            $processed_requests = Request::with('user')->whereHas('user', function($query){
                $query->where('role', 0);
            })->where('status', 1)->count();

            return [
                'total_requests' => $total_requests,
                'pending_requests' => $pending_requests,
                'processed_requests' => $processed_requests
            ];
         }
    }
