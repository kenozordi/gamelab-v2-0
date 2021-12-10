<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\GamerApi;
use Illuminate\Http\Request;

class GamerController extends Controller
{
    protected $gamerApi;

    public function __construct(GamerApi $gamerApi)
    {
        $this->gamerApi = $gamerApi;
    }


    public function store(Request $request)
    {
        $gamer = $this->gamerApi->store($request)->getData();

        if (!$gamer->status) {
            return back()->withErrors($gamer->data);
        }

        return back();
    }
}
