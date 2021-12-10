<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\API\AdminApi;
use App\Http\Controllers\API\GameApi;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $adminApi, $gameApi;

    public function __construct(AdminApi $adminApi, GameApi $gameApi)
    {
        $this->adminApi = $adminApi;
        $this->gameApi = $gameApi;
    }

    public function dashboard()
    {
        $page_title = 'Dashboard-1';
        $page_description = 'Some description for the page';
        $action = 'dashboard_1';

        return view('admin.dashboard', compact('page_title', 'page_description', 'action'));
    }

    public function test()
    {
        return $this->adminApi->test();
    }
}
