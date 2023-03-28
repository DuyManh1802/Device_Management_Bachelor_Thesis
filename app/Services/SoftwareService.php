<?php
    namespace App\Services;

    use App\Models\Device;
    use App\Models\Software;
    use Illuminate\Http\Request;
    use Exception;

    class SoftwareService
    {
        public function allSoftware()
        {
            return Software::orderBy('id')->paginate(10);
        }

        public function storeSoftware(Request $request)
        {
            return Software::create([
                'name' => $request->name,
                'device_id' => $request->device_id,
                'version' => $request->version,
                'start' => $request->start,
                'end' => $request->end,
                'license_price' => $request->license_price
            ]);
        }

        public function findId($id)
        {
            return Software::find($id);
        }

        public function updateSoftware(Request $request, $id)
        {
            return Software::find($id)->update([
                'name' => $request->name,
                'version' =>$request->version
            ]);
        }

        public function deleteSoftware($id)
        {
            return Software::find($id)->delete();
        }

        public function allDevice()
        {
            return Device::all();
        }
    }
?>
