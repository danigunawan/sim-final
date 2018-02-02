<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingDefault;

class SettingDefaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return SettingDefault::paginate(10);
    }
    public function all()
    {
        //
        return SettingDefault::all();
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

    public function search(Request $request){
       return SettingDefault::where('text','LIKE',"%$request->q%")->orWhere('value','LIKE',"%$request->q%")->paginate(10);
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
        return SettingDefault::find($id);
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
        $request->validate([
            'text' => 'required|unique:setting_defaults,text,'.$id.'|max:255',
            'value' => 'required|unique:setting_defaults,value,'.$id.'|max:255',
        ]);
        $settingDefault = SettingDefault::find($id)->update($request->all());
        if($settingDefault) {
           return response(200);
        } else {
           return response(500);
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
        //
        $settingDefault = SettingDefault::destroy($id);
        if($settingDefault){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

