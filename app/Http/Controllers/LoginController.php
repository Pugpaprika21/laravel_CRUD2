<?php

namespace App\Http\Controllers;

use App\Models\RegisterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return object
     */
    public function login(Request $request): object
    {
        $check_login = RegisterModel::where('username', $request->username)
            ->where('password', $request->password)
            ->where('user_role', $request->user_role)->first();

        if (!empty($check_login)) {

            if ($request->user_role == 'user') {
                Session::put('user-info', $check_login);
                return response()->json(['status' => 200, 'user_role' => $check_login->user_role]);

            } else if ($request->user_role == 'admin') {
                Session::put('admin-info', $check_login);
                return response()->json(['status' => 200, 'user_role' => $check_login->user_role]);
            }

        } else {

            return response()->json([
                'status' => 500, 
                'message' => 'data is valid!',
                'role' => $request->user_role
            ]);
        }
    }
    /**
     * @return object
     */
    public function register(): object
    {
        return view('/register');
    }
    /**
     * @param Request $request
     * @return void
     */
    public function store_register(Request $request): object
    {
        if ($request->hasFile('user_img')) {

            $regis_data = [
                'status' => 200,
                'username' => $request->username,
                'password' => $request->password,
                'phone' => $request->phone,
                'email' => $request->email,
                'user_role' => $request->user_role,
                'user_img' => self::uploadeFile($request)
            ];

            return self::add_toDB($regis_data) ? response()->json([
                'status' => 200,
                'message' => 'insert data successfully'
            ]) : response()->json([
                'status' => 500,
                'message' => 'password is duplicate!'
            ]);
            
        } else {

            return response()->json([
                'status' => 500,
                'message' => 'image is vaild!'
            ]);
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
     * @param array $data
     * @return void
     */
    public static function add_toDB(array $data): bool
    {
        $password_duplicate = RegisterModel::where('password', $data['password'])->get();
        if (!empty($password_duplicate[0]->password)) {
            return false;
        } else {
            return RegisterModel::create($data) ? true : false;
        }
    }
}
