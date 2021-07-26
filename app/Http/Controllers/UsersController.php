<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\User;
use Storage;
use Session;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function profile(){
        $cities = City::all();
        return view('admin.users.profile',['cities'=>$cities]);
    }

    public function update_profile(Request $request){
        $request->validate([
            'name'=>'required',
            'phone'=>'required'
        ]);

        $user = User::findorfail(Auth::user()->id);

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->city_id = $request->input('city_id');

        if($request->hasFile('photo')){
            Storage::delete($user->photo);
            $user->photo = explode('/',$request->photo->store('public/profile'))[2];
        }

        if($user->update()){
            Session::flash('success','Perfil actualizado con Exito!!');
        }else{
            Session::flash('error', 'Error al tratar de actualizar el Perfil!!');
        }

        return redirect()->route('profile');
    }

    public function update_password(Request $request){
        $request->validate([
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ]);

        $user = User::findorfail(Auth::user()->id);

        $user->password = bcrypt($request->input('password'));

        if($user->update()){
            Session::flash('success','Contrasena Actualizada Con Exito!!');
        }else{
            Session::flash('error','Error al tratar de actualizar tu contrasena!!');
        }

        return redirect()->route('profile');
    }
}
