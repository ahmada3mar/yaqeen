<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class PortalController extends Controller
{
    public function index(){

        $user = Auth::user() ;
        $all_policy = $user->getMyPolicy()->where('created_at' , '>=' , Carbon::today())->get() ;
        return view('admin.portal.index' , compact('all_policy') ) ;
    }
}
