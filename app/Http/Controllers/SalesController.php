<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\City;
use Auth;
use Session;
use App\Models\SalePhoto;
use Storage;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();

        return view('admin.sales.browse',['sales'=>$sales]);
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
        return view('admin.sales.edit-add',['cities'=>$cities, 'type'=>$type]);
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
            'price'=>'required|numeric',
            'bedrooms'=>'required|numeric',
            'description'=>'required',
            'location'=>'required',
            'city_id'=>'required'
        ]);

        $sale = new Sale();
        $sale->user_id = Auth::user()->id;
        $sale->price = $request->input('price');
        $sale->bed_rooms = $request->input('bedrooms');
        $sale->description = $request->input('description');
        $sale->location = $request->input('location');
        $sale->city_id = $request->input('city_id');

        $photos = $request->file('photos');

        if($sale->save()){
            if($request->hasFile('photos')){
                for($i=0; $i < count($photos); $i++){
                    $sale_photo = new SalePhoto();
                    $photo = explode('/', $request->photos[$i]->store('public/sales'))[2];
                    $sale_photo->sale_id = $sale->id;
                    $sale_photo->url = $photo;
                    $sale_photo->save();
                    
                }
            }
            
            Session::flash('success','Venta subida con Exito!!');
        }else{
            Session::flash('error','Error al tratar de subir la Venta!!');
        }

        return redirect()->route('sales.index');
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
        $sale = Sale::findorfail($id);
        $type = 'edit';
        return view('admin.sales.edit-add',['cities'=>$cities, 'type'=>$type, 'sale'=>$sale]);
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
            'price'=>'required|numeric',
            'bedrooms'=>'required|numeric',
            'description'=>'required',
            'location'=>'required',
            'city_id'=>'required'
        ]);

        $sale = Sale::findorfail($id);
        $sale->user_id = Auth::user()->id;
        $sale->price = $request->input('price');
        $sale->bed_rooms = $request->input('bedrooms');
        $sale->description = $request->input('description');
        $sale->location = $request->input('location');
        $sale->city_id = $request->input('city_id');

        $photos = $request->file('photos');

        if($sale->update()){  
            if($request->hasFile('photos')){
                for($i=0; $i < count($photos); $i++){
                    $sale_photo = new SalePhoto();
                    $photo = explode('/', $request->photos[$i]->store('public/sales'))[2];
                    $sale_photo->sale_id = $sale->id;
                    $sale_photo->url = $photo;
                    $sale_photo->save();
                    
                }
            }         
            Session::flash('success','Venta actualizada con Exito!!');
        }else{
            Session::flash('error','Error al tratar de actualizar la Venta!!');
        }

        return redirect()->route('sales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::findorfail($id);
        if($sale->delete()){
            Session::flash('success','Venta eliminada con Exito!!');
        }else{
            Session::flash('error','Error al tratar de eliminar la Venta!!');
        }

        return redirect()->route('sales.index');
    }

    public function deleteImage($id){
        $data = [];
        $SalePhoto = SalePhoto::findorfail($id);
        Storage::delete($SalePhoto->url);
        if($SalePhoto->delete()){
            $data = ['success'=>'yes'];
        }else{
            $data = ['success'=>'no'];
        }

        return response()->json($data);
    }
}