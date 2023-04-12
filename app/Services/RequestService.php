<?php
    namespace App\Services;
    use App\Models\Department;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    use App\Models\Request as RequestModel;
    use Exception;
    use App\Models\Device;

    class RequestService
    {
        public function sendBorrorRequest(Request $request)
        {
            $user = Auth::user();

            return $user->requests()->create([
                'department_id' => $request->department_id,
                'type' => $request->type,
                'start_date' => $request->start_date,
                'note' => $request->note
            ]);
        }
            // try {
            //     DB::beginTransaction();
            //     DB::commit();
            // } catch (Exception $exception){
            //     DB::rollBack();
            // }

        public function sendReturnRequest()
        {

        }

        public function notify()
        {

        }

        public function listRequest()
        {
            return RequestModel::with(['department', 'user', 'device'])->whereHas('user', function($query){
                $query->where('role', 0);
            })->paginate(10);
        }

        public function refuseRequest($id)
        {
            return RequestModel::find($id)->update([
                'status' => 1,
                'result' => 0,
                'user_confirm' => Auth::user()->id
            ]);
        }

        public function approveRequest($id)
        {
            return RequestModel::find($id)->update([
                'status' => 1,
                'result' => 1,
                'user_confirm' => Auth::user()->id
            ]);
        }

        public function provideDevice(Request $request)
        {
            try {
                DB::beginTransaction();
                $department_id = $request->department_id;
                $device_ids = $request->input('device_id');
                $user_id = $request->user_id;

                $request_data = [];

                foreach ($device_ids as $device_id) {
                    $request_data[] = [
                        'department_id' => (int)$department_id,
                        'user_id' => (int)$user_id,
                        'device_id' => (int)$device_id,
                        'status' => 1,
                        'type' => 1,
                        'result' => 1,
                        'note' => 'admin cấp thiết bị',
                        'user_confirm' => Auth::user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    Device::where('id', $device_id)->update(['status' => 0]);
                }
                RequestModel::insert($request_data);

                DB::commit();
            } catch (Exception $exception){
                DB::rollBack();
            }

            return $request_data;
        }

        public function allDepartment()
        {
            return Department::all();
        }

        public function listRequestBorrow()
        {
            return RequestModel::with(['department', 'user', 'device'])->where('type', 1)->whereHas('user', function($query){
                $query->where('role', 0);
            })->paginate(10);
        }

        public function listDeviceAvailable()
        {
            return Device::where('status', 1)->where('condition', 1)->get();
        }

        public function findIdRequest($id)
        {
            return RequestModel::find($id);
        }
    }
?>
