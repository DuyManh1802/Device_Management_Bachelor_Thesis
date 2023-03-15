<?php
    namespace App\Services;

    use App\Models\User;
    use App\Models\Department;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Exception;
    use Illuminate\Support\Facades\DB;
    use App\Mail\WelcomeEmail;
    use Illuminate\Support\Facades\Mail;
    use App\Events\CreatedUser;

    class UserService
    {
        public function allUser(Request $request)
        {
            $user = User::orderBy('email');

            return $user;
        }

        public function storeUser(Request $request)
        {
            $user = User::create([
                'classroom_id' => $request->classroom_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'phone' => $request->phone,
                'role' => $request->role
            ]);

            return $user;
        }

        public function findId($id)
        {
            return User::find($id);
        }

        public function updateUser(Request $request, $id)
        {
            $user = User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'role' => $request->role
            ]);

            return $user;
        }

        public function deleteUser($id)
        {
            $user = User::find($id)->delete();

            return $user;
        }

        public function allClassroom()
        {
            return Department::all();
        }
    }
?>