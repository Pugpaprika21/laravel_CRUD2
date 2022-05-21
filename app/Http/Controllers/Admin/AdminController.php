<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegisterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * @return object
     */
    public function admin_page(): object
    {
        if (self::check_session()) {
            return view('Admin.admin-page');
        } else {
            return redirect('/');
        }
    }
    /**
     * @author status <ADMIN ROLE>
     * @return boolean
     */
    public static function check_session(): bool
    {
        if (!empty(Session::get('admin-info')->user_role) == 'admin') {
            return true;
        } else {
            return false;
        }
    }
    /**
     * @return object
     */
    public function displayUsers(): object
    {
        $data = RegisterModel::all();
        return response()->json($data);
    }
    /**
     * @param Request $request
     * @return object
     */
    public function addUser(Request $request): object
    {
        if ($request->hasFile('user_img')) {

            $oddFile = 'uploads/user_upload/' . $request->user_img;
            File::exists($oddFile) ? File::delete($oddFile) : '';

            $add_users = [
                'status' => 200,
                'username' => $request->username,
                'password' => $request->password,
                'phone' => $request->phone,
                'email' => $request->email,
                'user_role' => $request->user_role,
                'user_img' => self::uploadeFile($request)
            ];

            return self::add_UsersToDB($add_users) ? response()->json([
                'status' => 200,
                'message' => 'insert data successfully'
            ]) : response()->json([
                'status' => 500,
                'message' => 'password is duplicate!'
            ]);

            return response()->json($add_users);
        }
    }
    /**
     * @param array $data
     * @return boolean
     */
    public static function add_UsersToDB(array $data): bool
    {
        $password_duplicate = RegisterModel::where('password', $data['password'])->get();
        if (!empty($password_duplicate[0]->password)) {
            return false;
        } else {
            return RegisterModel::create($data) ? true : false;
        }
    }
    /**
     * @param object $users
     * @return string
     */
    public static function uploadeFile(object $users): string
    {
        $user_img = $users->file('user_img');
        $filename = date('YmdHi') . $user_img->getClientOriginalName();
        $user_img->move(public_path('uploads/user_upload/'), $filename);

        return $filename;
    }
    /**
     * @param integer $id
     * @return object
     */
    public function edit_user(int $id): object
    {
        $edit_id = RegisterModel::find($id);
        return response()->json($edit_id);
    }
    /**
     * @param Request $request
     * @return object
     */
    public function update_users(Request $request): object
    {
        if ($request->hasFile('user_img')) {

            $oddFile = 'uploads/user_upload/' . $request->user_img;
            File::exists($oddFile) ? File::delete($oddFile) : '';

            $updateUsers = RegisterModel::where('id', $request->id)->update([
                'username' => $request->username,
                'password' => $request->password,
                'phone' => $request->phone,
                'email' => $request->email,
                'user_img' => self::uploadeFile($request) ?? null,
                'user_role' => $request->user_role,
            ]);

            if ($updateUsers) {
                return response()->json(['status' => 200, 'message' => 'update data successfully']);
            } else {
                return response()->json(['status' => 500, 'message' => 'update fail!']);
            }
        }

        return response()->json(['status' => 500, 'message' => 'image is valid!']);
    }
    /**
     * @param integer $id
     * @return object
     */
    public function dalete_users(int $id): object
    {
        $del = RegisterModel::find($id);

        $oddFile = 'uploads/user_upload/' . $del->user_img;
        if (File::exists($oddFile)) {
            File::delete($oddFile);
        }

        $dels = RegisterModel::where('id', $id)->delete();

        if ($dels) {
            return response()->json(['status' => 200, 'message' => 'dalete row successfully']);
        } else {
            return response()->json(['status' => 500, 'message' => 'dalete row fail']);
        }
    }
    /**
     * @param integer $id
     * @return object
     */
    public function logout(int $id): object
    {
        if ($id == 1) {
            Session::forget('admin-info');
            return response()->json(['message' => 'logout']);
        }
    }
}
