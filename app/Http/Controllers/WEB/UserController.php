<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data user
        $user =User::latest()->get();

        return view('pages.admin.User.index',compact('user'));
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
        //
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
        $user =User::findOrFail($id);
        return view('pages.admin.User.edit',compact('user'));
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
        // dd($request);
        $request->validate([
            'roles'=>'required|in:ADMIN,USER',
        ]);
        $user = User::findOrFail($id);

        $user->update([
            'roles'=>$request->roles
        ]);
        if ( $user) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.user.index')->with([
                'success' => 'Data Berhasil Diubah!'
            ]);
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.user.edit')->with([
                'error' => 'Data Gagal Diubah!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =User::findOrFail($id);

        $user->delete();
        return redirect()->route('dashboard.user.index',compact('user'));
    }
}
