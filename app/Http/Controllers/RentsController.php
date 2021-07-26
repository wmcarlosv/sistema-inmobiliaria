<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\City;
use Auth;
use Session;
use App\Models\RentPhoto;
use Storage;

class RentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rents = Rent::all();

        return view('admin.rents.browse',['rents'=>$rents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $type = 'new';
        return view('admin.rents.edit-add',['cities'=>$cities, 'type'=>$type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'price_to_month'=>'required|numeric',
            'bedrooms'=>'required|numeric',
            'description'=>'required',
            'location'=>'required',
            'city_id'=>'required',
            'colony'=>'required'
        ]);

        $rent = new Rent();
        $rent->user_id = Auth::user()->id;
        if($request->input('is_deposit')){
            $rent->is_deposit = 1;
        }else{
            $rent->is_deposit = 0;
        }
        $rent->price_to_month = $request->input('price_to_month');
        $rent->bed_rooms = $request->input('bedrooms');
        $rent->description = $request->input('description');
        $rent->location = $request->input('location');
        $rent->colony = $request->input('colony');
        $rent->city_id = $request->input('city_id');

        $photos = $request->file('photos');

        if($rent->save()){
            if($request->hasFile('photos')){
                for($i=0; $i < count($photos); $i++){
                    $rent_photo = new RentPhoto();
                    $photo = explode('/', $request->photos[$i]->store('public/rents'))[2];
                    $rent_photo->rent_id = $rent->id;
                    $rent_photo->url = $photo;
                    $rent_photo->save();
                    
                }
            }
            
            Session::flash('success','Renta subida con Exito!!');
        }else{
            Session::flash('error','Error al tratar de subir la Renta!!');
        }

        return redirect()->route('rents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::all();
        $rent = Rent::findorfail($id);
        $type = 'edit';
        return view('admin.rents.edit-add',['cities'=>$cities, 'type'=>$type, 'rent'=>$rent]);
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
        $request->validate([
            'price_to_month'=>'required|numeric',
            'bedrooms'=>'required|numeric',
            'description'=>'required',
            'location'=>'required',
            'city_id'=>'required',
            'colony'=>'required'
        ]);

        $rent = Rent::findorfail($id);
        $rent->user_id = Auth::user()->id;
        if($request->input('is_deposit')){
            $rent->is_deposit = 1;
        }else{
            $rent->is_deposit = 0;
        }
        $rent->price_to_month = $request->input('price_to_month');
        $rent->bed_rooms = $request->input('bedrooms');
        $rent->description = $request->input('description');
        $rent->location = $request->input('location');
        $rent->colony = $request->input('colony');
        $rent->city_id = $request->input('city_id');

        $photos = $request->file('photos');

        if($rent->update()){  
            if($request->hasFile('photos')){
                for($i=0; $i < count($photos); $i++){
                    $rent_photo = new RentPhoto();
                    $photo = explode('/', $request->photos[$i]->store('public/rents'))[2];
                    $rent_photo->rent_id = $rent->id;
                    $rent_photo->url = $photo;
                    $rent_photo->save();
                    
                }
            }         
            Session::flash('success','Renta actualizada con Exito!!');
        }else{
            Session::flash('error','Error al tratar de actualizar la Renta!!');
        }

        return redirect()->route('rents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rent = Rent::findorfail($id);
        if($rent->delete()){
            Session::flash('success','Renta eliminada con Exito!!');
        }else{
            Session::flash('error','Error al tratar de eliminar la Renta!!');
        }

        return redirect()->route('rents.index');
    }

    public function deleteImageRent($id){
        $data = [];
        $rentPhoto = RentPhoto::findorfail($id);
        Storage::delete($rentPhoto->url);
        if($rentPhoto->delete()){
            $data = ['success'=>'yes'];
        }else{
            $data = ['success'=>'no'];
        }

        return response()->json($data);
    }
}
