<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use App\Http\Controllers\API\AdminApi;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $adminApi;

    public function __construct(AdminApi $adminApi)
    {
        $this->adminApi = $adminApi;
    }

    public function dashboard()
    {
        $page_title = 'Dashboard-1';
        $page_description = 'Some description for the page';
        $logo = "images/logo.png";
        $logoText = "images/logo-text.png";
        $action = 'dashboard_1';

        return view('admin.dashboard', compact('page_title', 'page_description', 'action', 'logo', 'logoText'));
    }

    public function test()
    {
        return $this->adminApi->test();
    }
}
