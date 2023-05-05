<?php
    namespace App\Services;

    use App\Models\Device;
    use App\Models\Software;
    use Illuminate\Http\Request;
    use Exception;
    use Illuminate\Support\Str;

    class SoftwareService
    {
        public function allSoftware()
        {
            return Software::orderBy('id')->paginate(10);
        }

        public function storeSoftware(Request $request)
        {
            $image = $request->image;
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $name_file = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                if (strcasecmp($extension, 'jpg') || strcasecmp($extension, 'png') || strcasecmp($extension, 'jepg')){
                    $image = Str::random(5) . '_' . $name_file;
                    while (file_exists('image/software/' .$image)){
                        $image = Str::random(5) . '_' . $name_file;
                    }
                    $file->move('image/software', $image);
                }
            }

            return Software::create([
                'name' => $request->name,
                'image' => $image,
                'version' => $request->version,
                'license_key' => $request->license_key,
                'usage_count' => $request->usage_count,
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
            $image = $request->image;
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $name_file = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                if (strcasecmp($extension, 'jpg') || strcasecmp($extension, 'png') || strcasecmp($extension, 'jepg')){
                    $image = Str::random(5) . '_' . $name_file;
                    while (file_exists('image/software/' .$image)){
                        $image = Str::random(5) . '_' . $name_file;
                    }
                    $file->move('image/software', $image);
                }
            }

            return Software::find($id)->update([
                'name' => $request->name,
                'version' =>$request->version,
                'image' => $image
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

        public function listSoftwareExpire()
        {

        }

        public function listSoftwareOutOfUsage()
        {

        }
    }
?>
