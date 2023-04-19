<?php
    namespace App\Services;

    use App\Models\Device;
    use App\Models\Category;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Exception;

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
                    'end' => $req->end
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
            return Device::where('condition', 0)->get();
        }

        public function listDeviceWarranting()
        {
            return Device::where('condition', 3)->get();
        }
    }
?>
