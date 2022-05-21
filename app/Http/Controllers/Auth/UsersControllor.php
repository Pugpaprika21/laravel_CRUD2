<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RegisterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class UsersControllor extends Controller
{
    /**
     * @return object
     */
    public function users_page(): object
    {
        if (self::check_session()) {
            return view('Auth.user-page');
        } else {
            return redirect('/');
        }
    }
    /**
     * @return boolean
     */
    public static function check_session(): bool
    {
        if (!empty(Session::get('user-info')->user_role) == 'user') {
            return true;
        } else {
            return false;
        }
    }
    /**
     * @return object
     */
    public function getUsers_profile(): object
    {
        $user_profile = RegisterModel::find(Session::get('user-info')->id);
        if (empty(!$user_profile)) {
            return response()->json([$user_profile]);
        } else {
            return response()->json([]);
        }
    }
    /**
     * @param Request $request
     * @return object
     */
    public function update_profile(Request $request): object
    {

        if ($request->file('user_img')) {

            $oddFile = 'uploads/user_upload/' . $request->user_img;
            File::exists($oddFile) ? File::delete($oddFile) : '';

            $profile = RegisterModel::where('id', $request->id)->update([
                'username' => $request->username,
                'password' => $request->password,
                'phone' => $request->phone,
                'email' => $request->email,
                'user_img' => self::uploadeFile($request) ?? null,
                'user_role' => $request->user_role,
            ]);

            if ($profile) {
                return response()->json(['status' => 200, 'message' => 'update data successfully']);
            } else {
                return response()->json(['status' => 500, 'message' => 'update fail!']);
            }
        }

        return response()->json(['status' => 500, 'message' => 'image is valid!']);
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
    public function user_logout(int $id): object
    {
        if ($id == 2) {
            Session::forget('user-info');
            return response()->json(['message' => 'logout']);
        }
    }
}
