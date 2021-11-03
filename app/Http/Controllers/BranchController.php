<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();

        return view('admin.branches.index' , compact('branches'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branches.create');
    }
    public function privacy()
    {
        return view('admin.branches.privacy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->validate([
            'name' => 'required|string|max:191',
            'total_los_cars' => 'required|numeric|min:86',
            'total_los_cars_accedint' => 'required|numeric|min:100',
            'total_los_vans' => 'required|numeric|min:165',
            'total_los_pickups' => 'required|numeric|min:86',
            'full_cover_cars' => 'required|numeric|min:86',
            'full_cover_cars_per_k' => 'required|numeric',
            'full_cover_vans' => 'required|numeric|min:86',
            'full_cover_vans_per_k' => 'required|numeric',
            'full_cover_pickups' => 'required|numeric|min:86',
            'full_cover_pickups_per_k' => 'required|numeric',
        ]);
        Branch::create($data);

        return redirect()->route('branches');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view('admin.branches.edit' , compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'total_los_cars' => 'required|numeric|min:86',
            'total_los_cars_accedint' => 'required|numeric|min:' . $request->total_los_cars,
            'total_los_vans' => 'required|numeric|min:165',
            'total_los_vans_accedint' => 'required|numeric|min:'. $request->total_los_vans,
            'total_los_pickups' => 'required|numeric|min:200',
            'total_los_pickups_accedint' => 'required|numeric|min:' . $request->total_los_pickups,
            'full_cover_cars' => 'required|numeric|min:86',
            'full_cover_cars_per_k' => 'required|numeric',
            'full_cover_vans' => 'required|numeric|min:86',
            'full_cover_vans_per_k' => 'required|numeric',
            'full_cover_pickups' => 'required|numeric|min:86',
            'full_cover_pickups_per_k' => 'required|numeric',
        ]);

        $branch->update($data);

        return redirect(route('branches'))->with(['CRUD' => 'تم التحديث بنجاح']) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
