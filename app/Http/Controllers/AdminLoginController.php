<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use App\Http\Controllers\API\AdminApi;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public $adminApi;

    public function __construct(AdminApi $adminApi)
    {
        $this->adminApi = $adminApi;
    }
    public function index()
    {
        if ($this->adminApi->checkAuth()->getData()->status) {
            return redirect()->route('admin.dashboard');
        }

        $page_title = 'Login';
        $page_description = '';
        $action = __FUNCTION__;

        return view('admin.login', compact('page_title', 'page_description', 'action'));
    }

    public function authenticate(Request $request)
    {
        $authenticated = $this->adminApi->authenticate($request)->getData();
        if ($authenticated->status) {
            return redirect()->intended('admin/dashboard');
        } else {
            return back()->withErrors('Oops! You have entered invalid credentials');
        }
    }

    public function logout()
    {
        $response = $this->adminApi->logout()->getData();
        if ($response->status) {
            return redirect()->route('admin.loginForm');
        }
    }
}
