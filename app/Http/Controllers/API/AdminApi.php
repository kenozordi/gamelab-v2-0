<?php

namespace App\Http\Controllers\API;


use Auth;
use Exception;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminApi extends Controller
{
    use ResponseFormat;
    /**
     * **used to authenticate user**
     * @param Request $request containing user credentials
     * @return mixed 
     */
    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            if (Auth::guard('admin')->attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ])) {
                // $request->session()->regenerate();
                return ResponseFormat::returnSuccess();
            }
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
        return ResponseFormat::returnFailed();
    }


    //check if admin is authenticated
    public function checkAuth()
    {
        try {
            if (Auth::guard('admin')->check()) {
                return ResponseFormat::returnSuccess();
            }
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
        return ResponseFormat::returnFailed();
    }



    /**
     * **used to get all admin users**
     * @param Request $request containing user credentials
     * @return mixed 
     */
    public function all()
    {
        try {
            $admins = Admin::all();
            return ResponseFormat::returnSuccess($admins);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }


    public function get($id)
    {
        try {
            $admin = Admin::find($id);
            if ($admin) {
                return ResponseFormat::returnSuccess($admin);
            }
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
        return ResponseFormat::returnNotFound();
    }


    //create admin account
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:admin'],
                'password' => ['required'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $credentials = $validator->validated();

            $admin = Admin::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password']),
            ]);

            return ResponseFormat::returnSuccess($admin);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }


    public function delete($id)
    {
        try {
            $admin = Admin::find($id);
            if ($admin) {
                Admin::destroy($id);
                return ResponseFormat::returnSuccess();
            }
        } catch (Exception $e) {
            return ResponseFormat::returnFailed($admin);
        }
        return ResponseFormat::returnNotFound();
    }


    public function logout()
    {
        try {
            Auth::guard('admin')->logout();
            session()->flash('message', 'Just Logged Out!');
            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function test()
    {
        // return ResponseFormat::returnSuccess();
        $data = ['1,2,3', '3,4,5'];
        $first = $data[0];
        $second = $data[1];
        $firstArray = explode(',', $first);
        sort($firstArray);
        $secondArray = explode(',', $second);
        sort($secondArray);
        $result = '';
        for ($i = 0; $i < count($firstArray); $i++) {
            for ($j = 0; $j < count($secondArray); $j++) {
                if ($firstArray[$i] == $secondArray[$j]) {
                    $result = $result . $firstArray[$i];
                }
            }
        }
        return ResponseFormat::returnSuccess($result);
    }
}
