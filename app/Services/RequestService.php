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
                'type' => 1,
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

        public function sendReturnRequest($device_id)
        {
            try {
                DB::beginTransaction();
                $user = Auth::user();
                $user->requests()->create([
                    'device_id' => (int)$device_id,
                    'type' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                Device::where('id', $device_id)->update(['status' => 1]);

                DB::commit();
            } catch (Exception $exception){
                DB::rollBack();
            }

            return $user;
        }

        public function reportDeviceBroken($device_id)
        {
            try {
                DB::beginTransaction();
                $user = Auth::user();
                $user->requests()->create([
                    'device_id' => (int)$device_id,
                    'type' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                Device::where('id', $device_id)->update(['condition' => 0]);

                DB::commit();
            } catch (Exception $exception){
                DB::rollBack();
            }

            return $user;
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
                        'type' => 4,
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

        public function listRequestReturn()
        {
            return RequestModel::with(['department', 'user', 'device'])->where('type', 0)->whereHas('user', function($query){
                $query->where('role', 0);
            })->paginate(10);
        }

        public function listRequestBroken()
        {
            return RequestModel::with(['department', 'user', 'device'])->where('type', 2)->whereHas('user', function($query){
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

        public function findUserId($user_id)
        {
            return RequestModel::where('user_id', $user_id)->get();
        }

        public function delivered(Request $request, $user_id)
        {
            try {
                DB::beginTransaction();
                $requests = RequestModel::where('user_id', $user_id)->where('type', 4)->get();

                foreach ($requests as $req) {
                    RequestModel::where('confirm', $req->confirm)->update([
                        'confirm' => 1,
                    ]);
                    $req->device()->update([
                        'status' => 0
                    ]);
                    $req->useHistory()->create([
                        'status' => 1,
                        'borrowed_date' => $request->borrowed_date,
                        'return_date' => $request->return_date
                    ]);
                }
                DB::commit();
            } catch (Exception $exception){
                DB::rollBack();
            }

            return $requests;
        }

        public function listDeviceBorrow()
        {
            return RequestModel::where('user_id', Auth::user()->id)
            ->where('type', 4)
            ->where('status', 1)
            ->where('result', 1)
            ->where('confirm', 1)
            ->with(['device', 'useHistory'])
            ->whereHas('device', function($query){
                $query->where('status', 0);
            })
            ->paginate(10);
        }

        public function listDeviceBorrowed()
        {
            return RequestModel::where('type', 4)
            ->where('status', 1)
            ->where('result', 1)
            ->where('confirm', 1)
            ->with(['device', 'useHistory', 'department', 'user'])
            ->whereHas('device', function($query){
                $query->where('status', 0);
            })
            ->paginate(10);
        }
    }
?>
