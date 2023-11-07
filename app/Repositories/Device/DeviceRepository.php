<?php
namespace App\Repositories\Device;

use App\Repositories\BaseRepository;
use App\Repositories\Device\DeviceRepositoryInterface;

class DeviceRepository extends BaseRepository implements DeviceRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Device::class;
    }

    public function getDevices()
    {
        $devices = $this->model->with('warranties')->paginate(10);

        $devices->each(function ($device) {
            $device->warranties = $device->warranties->map(function ($warranty) {
                return [
                    'id' => $warranty->id,
                    'warranty_count' => $warranty->warranty_count,
                    'type' => $warranty->type,
                    'start' => $warranty->start,
                    'end' => $warranty->end,
                ];
            });
        });

        return $devices;
    }
}
