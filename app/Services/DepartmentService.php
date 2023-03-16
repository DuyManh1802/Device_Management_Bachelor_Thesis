<?php
    namespace App\Services;

    use App\Models\Department;
    use Illuminate\Http\Request;

    class DepartmentService
    {
        public function allDepartment()
        {
            $department = Department::all();

            return $department;
        }

        public function storeDepartment(Request $request)
        {
            // $department = Department::create([
            //     'name' => $request->name,
            //     'manager' => $request->manager,
            //     'address' => $request->address,
            // ]);

            return Department::create([
                'name' => $request->name,
                'manager' => $request->manager,
                'address' => $request->address,
            ]);
        }

        public function findId($id)
        {
            return Department::find($id);
        }

        public function updateDepartment(Request $request, $id)
        {
            $department = Department::find($id)->update([
                'name' => $request->name,
                'manager' => $request->manager,
                'address' => $request->address
            ]);

            return $department;
        }

        public function deleteDepartment($id)
        {
            $department = Department::find($id)->delete();

            return $department;
        }

    }
?>