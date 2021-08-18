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
// use Illuminate\Support\Facades\Auth;

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
                $request->session()->regenerate();
                return ResponseFormat::returnSuccess();
            } else {
                return ResponseFormat::returnFailed();
            }
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    //create admin account
    public function create()
    {
        try {
            $admin = Admin::create([
                'name' => 'Morpheus',
                'email' => 'kennyozordi@betathing.com',
                'password' => Hash::make('Password54321#'),
            ]);

            return ResponseFormat::returnSuccess($admin);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
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
        return ResponseFormat::returnSuccess();
    }
}
