<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $learnerCount = 0;
        $trainerCount = 0;

        return view('admin.home')->with(['learnerCount'=>$learnerCount, 'trainerCount'=>$trainerCount]);
    }
}
