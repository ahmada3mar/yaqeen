<?php

namespace App\Http\Controllers;

use App\Models\Vip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.policy.create-vip');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = Auth::user() ;
      $date =   $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'car_type' => 'required',
            'car_model' => 'required',
            'color' => 'required',
            'car_number' => 'required',
            'end_at' => 'required',
            'inssurance_type' => 'required',
            'price' => 'required',
        ]);

        $date ['user_id'] = $user->id;
        $date ['branch_id'] = $user->branch_id;

       $vip = Vip::create($date);

       return redirect(route('print-vip' , $vip->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vip  $vip
     * @return \Illuminate\Http\Response
     */
    public function show(Vip $vip)
    {

        return view('admin.policy.vip' , compact('vip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vip  $vip
     * @return \Illuminate\Http\Response
     */
    public function edit(Vip $vip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vip  $vip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vip $vip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vip  $vip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vip $vip)
    {
        //
    }
}
