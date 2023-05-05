<?php
    namespace App\Services;

    use App\Models\Device;
    use App\Models\Category;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Exception;
    use Carbon\Carbon;
    use App\Models\Warranty;

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

        public function storeDevice(Request $request, Request $req)
        {
            $image = $request->image;
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $name_file = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                if (strcasecmp($extension, 'jpg') || strcasecmp($extension, 'png') || strcasecmp($extension, 'jepg')){
                    $image = Str::random(5) ."_". $name_file;
                    while (file_exists("image/device/" .$image)){
                        $image = Str::random(5) ."_". $name_file;
                    }
                    $file->move('image/device', $image);
                }
            }

            try {
                DB::beginTransaction();

                $device = Device::create([
                    'category_id' => $request->category_id,
                    'name' => $request->name,
                    'configuration' => $request->configuration,
                    'image' => $image,
                    'color' => $request->color,
                    'purchase_price' => $request->purchase_price
                ]);

                $device->warranties()->create([
                    'type' => $req->type,
                    'start' => $req->start,
                    'end' => $req->end,
                    'warranty_count' => 0
                ]);

                $device->repairs()->create([
                    'repair_count' => 0
                ]);

                DB::commit();
            } catch (Exception $ex){
                DB::rollBack();
            }

            return $device;
        }

        public function findId($id)
        {
            return Device::find($id);
        }

        public function updateDevice(Request $request, $id)
        {
            $image = $request->image;
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $name_file = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                if (strcasecmp($extension, 'jpg') || strcasecmp($extension, 'png') || strcasecmp($extension, 'jepg')){
                    $image = Str::random(5) ."_". $name_file;
                    while (file_exists("image/device/" .$image)){
                        $image = Str::random(5) ."_". $name_file;
                    }
                    $file->move('image/device', $image);
                }
            }

            try {
                DB::beginTransaction();
                $device = Device::find($id)->update([
                    'category_id' => $request->category_id,
                    'name' => $request->name,
                    'configuration' => $request->configuration,
                    'image' => $image,
                    'color' => $request->color,
                ]);

                DB::commit();
            } catch (Exception $ex){
                DB::rollBack();
            }

            return $device;
        }

        public function deleteDevice($id)
        {
            try {
                DB::beginTransaction();
                $device = Device::find($id);
                $device->warranties()->delete();
                $device->delete();

                DB::commit();
            } catch (Exception $ex){
                DB::rollBack();
            }

            return $device;
        }

        // public public function showByCategory()
        // {
        //     $category = new Category;
        //     $devices = $category->devices;

        //     return $devices;
        // }

        public function listDeviceRepairing()
        {
            return Device::where('condition', 2)->get();
        }

        public function listDeviceBrokening()
        {
            return Device::with('warranties')->whereIn('condition', [0, 2, 3])->get();
        }

        public function listDeviceWarranting()
        {
            return Device::where('condition', 3)->get();
        }

        public function listSoftwareByDevice($device_id)
        {
            $id = (int)$device_id;

            return Device::find($id)->softwares()->paginate(10);
        }

        public function listDeviceWarrantyStocking()
        {
            return Device::with(['warranties' => function($query) {
                $query->where('start_date', '<=', Carbon::now())
                      ->where('end_date', '>=', Carbon::now());
            }])->get();
        }

        public function listDeviceWarrantiedOrRepaired()
        {
            return Device::with(['warranties', 'repairs'])->whereHas('warranties', function ($query) {
                $query->where('warranty_count', '>', 0);
            })
            ->orWhereHas('repairs', function ($query) {
                $query->where('repair_count', '>', 0);
            })
            ->get();
        }

        public function detailDeviceWarrantied($id)
        {
            return Device::with(['warranties', 'warrantyDetails'])->whereHas('warranties', function ($query) {
                $query->where('warranty_count', '>', 0);})->find($id);
        }

        public function detailDeviceRepaired($id)
        {
            return Device::with(['repairs', 'repairDetails', 'typeRepairs'])->whereHas('repairs', function ($query) {
                $query->where('repair_count', '>', 0);})->find($id);
        }
    }
?>
