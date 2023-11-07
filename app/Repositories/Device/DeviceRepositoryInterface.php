<?php
namespace App\Repositories\Device;

use App\Repositories\RepositoryInterface;

interface DeviceRepositoryInterface extends RepositoryInterface
{
    public function getDevices();
}
