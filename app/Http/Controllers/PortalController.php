<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index(){

        $all_policy = Policy::where('created_at' , '>=' , Carbon::today())->get() ;
        return view('admin.portal.index' , compact('all_policy') ) ;
    }
}
