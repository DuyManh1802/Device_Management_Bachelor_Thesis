<?php
    namespace App\Services;
    use App\Models\Warranty;
    use App\Models\Device;
    use Symfony\Component\HttpFoundation\Request;
    use Illuminate\Support\Facades\DB;
    use Exception;

    class WarrantyService
    {
        public function findWarrantyByDevice($device_id)
        {
            return Warranty::with('device')->where('device_id', $device_id)->first();
        }

        public function warrantyDevice($device_id)
        {
            Device::where('id', $device_id)->update(['condition' => 3]);
            $warranty = $this->findWarrantyByDevice($device_id);
            $warranty_count = $warranty->warranty_count;

            return $warranty->update([
                'warranty_count' => $warranty_count + 1
            ]);
        }

        public function warrantyDeviced($id, Request $request)
        {
            $device_id = (int)$request->device_id;
            try {
                DB::beginTransaction();
                $warranty = Warranty::find($id);

                $warranty->warrantyDetails()->create([
                    'result' => $request->result,
                    'content' => $request->content
                ]);

                Device::where('id', $device_id)->update(['condition' => 1]);
                DB::commit();

                return true;
            } catch (Exception $exception){
                DB::rollBack();

                return false;
            }

        }
    }
?>
