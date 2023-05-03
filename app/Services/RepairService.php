<?php
    namespace App\Services;
    use App\Models\Repair;
    use Illuminate\Support\Facades\DB;
    use Exception;
    use App\Models\Device;
    use Symfony\Component\HttpFoundation\Request;

    class RepairService
    {
        public function repairDevice($device_id)
        {
            Device::where('id', $device_id)->update(['condition' => 2]);
            $repair = $this->findRepairByDevice($device_id);
            $repair_count = $repair->repair_count;

            return $repair->update([
                'repair_count' => $repair_count + 1
            ]);
        }

        public function findRepairByDevice($device_id)
        {
            return Repair::with('device')->where('device_id', $device_id)->first();
        }

        public function repairDeviced($id, Request $request)
        {
            $device_id = (int)$request->device_id;
            $type = (int)$request->type;
            $cost = (int)$request->cost;
            try {
                DB::beginTransaction();
                $repair = Repair::find($id);
                $repair->repairDetail()->create([
                    'result' => $request->result,
                    'content' => $request->content,
                    'cost' => $cost
                ]);
                $repair->typeRepairs()->create([
                    'type' => $type
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
