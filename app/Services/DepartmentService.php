<?php
    namespace App\Services;

    use App\Models\Department;
    use Illuminate\Http\Request;

    class DepartmentService
    {
        public function allDepartment()
        {
            return Department::paginate(10);
        }

        public function storeDepartment(Request $request)
        {
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
            return Department::find($id)->update([
                'name' => $request->name,
                'manager' => $request->manager,
                'address' => $request->address
            ]);
        }

        public function deleteDepartment($id)
        {
            return Department::find($id)->delete();
        }
    }
?>