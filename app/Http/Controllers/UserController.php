<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\models\User ;
use \App\models\Branch ;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all() ;

        return view('admin.users.index' , compact('users')) ; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all() ;

        return view('admin.users.create' , compact('branches')) ; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data =  $request->validate([
            'name' => 'required|string|max:191',
            'role' => 'required|string|max:191',
            'email' => 'required|email|unique:users',
            'username' => 'required|string|max:191|unique:users',
            'branch_id' => 'required|numeric|exists:branches,id',
        ]);

        $data['password'] =  bcrypt('123456789') ;
        
        User::create($data);

        return redirect(route('users'))->with(['CRUD' => 'تم انشاء مستخدم جديد بنجاح']) ;
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
    public function edit(User $user)
    {
        $branches = Branch::all();
        return view('admin.users.edit' , compact('user' , 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
 
        $data =  $request->validate([
            'name' => 'required|string|max:191',
            'role' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:191|unique:users,username,' . $user->id,
            'branch_id' => 'required|numeric|exists:branches,id',
        ]);

        $user->name = $data['name'] ;
        $user->role = $data['role'] ;
        $user->email = $data['email'] ;
        $user->username = $data['username'] ;
        $user->branch_id = $data['branch_id'] ;

        $user->save();

        return redirect(route('users'))->with(['CRUD' => 'تم تعديل المستخدم  بنجاح']) ;

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
