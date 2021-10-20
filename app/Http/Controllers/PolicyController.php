<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policies = [];
        return view('admin.policy.index' , compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.policy.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        $policy = Policy::create(
            [
                'name' => $request->name ,
                'branch_id' => 1 ,
                'type' => $request->policy_type ,
                'car_price' => $request->car_price ?? 3000 ,
                'car_type' => $request->type ,
                'car_number' => $request->number ,
                'car_name' => 'هينوداي' ,
                'car_model' => 2015 ,
                'body_number' => $request->body ,
                'eng_number' => $request->eng ,
                'start_at' => '2021-01-01' ,
                'end_at' => '2021-01-01' ,
                'policy_date' => date('Y'),
                'cost' => 86 ,
                'price' => $request->cost ,
                ]
            );
        return $policy;
    }

    public function getPolicy(Request $request)
    {
        // return $request();
        return Policy::where('branch_id' , 1)->latest()->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
