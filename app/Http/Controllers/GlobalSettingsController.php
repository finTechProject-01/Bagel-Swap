<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Models\GlobalSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class GlobalSettingsController extends JsonController
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        if(Auth::check()){
            $id= Auth::id();
            //$settings = GlobalSettings::find(['user_id'=>$id]);
            $user =User::findOrFail($id);
            $response=['user'=>new  UserCollection($user)];
            return $this->jsonSuccses('user settings',$response);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {


        if(Auth::check()){
            $request->validate([
                'first_name'=>'required',
                'last_name'=>'required',
            ]);

            $id= Auth::id();
            $user =User::find($id);
            $user->name = $request->first_name .' '. $request->last_name;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->registration_number = $this->reg_number($id);
            $user->save();
            $global_settings = new GlobalSettings(['total_invested'=>10000,'cost'=>0.3,'opening_date'=>Carbon::now()]);
            $user->globalSettings()->save($global_settings);




            $response=['user'=>$user];
            return $this->jsonSuccses('user settings',$response);







        }


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
