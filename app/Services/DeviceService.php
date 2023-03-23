<?php
    namespace App\Services;

    use App\Models\Device;
    use App\Models\Category;
    use Illuminate\Http\Request;

    class DeviceService
    {
        public function allDevice()
        {
            return Device::paginate(10);
        }

        public function allCategory()
        {
            return Category::all();
        }

        public function storeDevice(Request $request)
        {
            return Device::create([
                'name' => $request->name,
            ]);
        }

        public function findId($id)
        {
            return Device::find($id);
        }

        public function updateDevice(Request $request, $id)
        {
            return Device::find($id)->update([
                'name' => $request->name,
            ]);
        }

        public function deleteDevice($id)
        {
            return Device::find($id)->delete();
        }
    }
?>