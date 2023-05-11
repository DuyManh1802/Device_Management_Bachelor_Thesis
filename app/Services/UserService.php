<?php
    namespace App\Services;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Exception;
    use Illuminate\Support\Facades\DB;
    use App\Mail\WelcomeEmail;
    use Illuminate\Support\Facades\Mail;
    use App\Events\CreatedUser;
    use App\Models\Department;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Auth;

    class UserService
    {
        public function allUser(Request $request)
        {
            return User::orderBy('email')->paginate(10);
        }

        public function storeUser(Request $request)
        {
            $image = $request->image;
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $name_file = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                if (strcasecmp($extension, 'jpg') || strcasecmp($extension, 'png') || strcasecmp($extension, 'jepg')){
                    $image = Str::random(5) . '_' . $name_file;
                    while (file_exists('image/user/' .$image)){
                        $image = Str::random(5) . '_' . $name_file;
                    }
                    $file->move('image/user', $image);
                }
            }

            return User::create([
                'department_id' => $request->department_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'phone' => $request->phone,
                'role' => $request->role,
                'image' => $image
            ]);
        }

        public function findId($id)
        {
            return User::find($id);
        }

        public function updateUser(Request $request, $id)
        {
            $image = $request->image;
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $name_file = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                if (strcasecmp($extension, 'jpg') || strcasecmp($extension, 'png') || strcasecmp($extension, 'jepg')){
                    $image = Str::random(5) . '_' . $name_file;
                    while (file_exists('image/user/' .$image)){
                        $image = Str::random(5) . '_' . $name_file;
                    }
                    $file->move('image/user', $image);
                }
            }

            return User::find($id)->update([
                'name' => $request->name,
                'department_id' => $request->department_id,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'role' => $request->role,
                'image' => $image
            ]);
        }

        public function updateProfile(Request $request, $id)
        {
            $image = $request->image;
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $name_file = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                if (strcasecmp($extension, 'jpg') || strcasecmp($extension, 'png') || strcasecmp($extension, 'jepg')){
                    $image = Str::random(5) . '_' . $name_file;
                    while (file_exists('image/user/' .$image)){
                        $image = Str::random(5) . '_' . $name_file;
                    }
                    $file->move('image/user', $image);
                }
            }

            return User::find($id)->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'image' => $image
            ]);
        }

        public function changePassword(Request $request, $id)
        {
            $user = $this->findId($id);
            if (Hash::check($request->old_password, $user->password)){
                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);

                return true;
            } else {
                return false;
            }
        }

        public function deleteUser($id)
        {
            return User::find($id)->delete();
        }

        public function allDepartment()
        {
            return Department::all();
        }
    }
?>
