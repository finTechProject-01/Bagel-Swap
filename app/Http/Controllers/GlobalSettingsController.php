<?php

namespace App\Http\Controllers;


use App\Models\GlobalSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class GlobalSettingsController extends JsonController
{
    /**
     * Display a listing of the resource.
     *the request methode is GET
     *
     */
    public function index()
    {
        if(Auth::check()){
            $id= Auth::id();
            //$settings = GlobalSettings::find(['user_id'=>$id]);
            $user=User::with('globalSettings')->findOrFail($id);
            $response=['user'=>$user];
            return $this->jsonSuccses('user Profiles',$response);
        }
    }

    /**
     * Store a newly created resource in storage.
     *the request methode is POST
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {

        if(Auth::check()){
            $request->validate([
                'first_name'=>'required',
                'last_name'=>'required',
            ]);

            $id= Auth::id();
            $user =User::find($id);
            if(!is_null($user->name)){
               return $this->jsonError('You already have a profile ',[],Response::HTTP_ALREADY_REPORTED);
            }
            $user->name = $request->first_name .' '. $request->last_name;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->registration_number = $this->reg_number($id);
            $user->save();
            $global_settings = new GlobalSettings(['total_invested'=>10000,'cost'=>0.3,'opening_date'=>Carbon::now()]);
            $user->globalSettings()->save($global_settings);

            $response=['user'=>User::with('globalSettings')->findOrFail($id)];
            return $this->jsonSuccses('user settings',$response,true);

        }

        return $this->jsonError('UNAUTHORIZED',[],Response::HTTP_UNAUTHORIZED);



    }

    /**
     * Update the specified resource in storage.
     * the request methode is PUT
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        //return response()->json(['login'=>Auth::id(),'id'=>intval($id)]);
        if(Auth::check()){
            $request->validate([
                'first_name',
                'last_name',
            ]);
            $loginId= Auth::id();
            if($loginId === intval($id)){
                $user =User::find($id);
                if ($request->first_name){
                    $user->name = $request->first_name .' '. $user->last_name;
                    $user->first_name = $request->first_name;
                }
                if ($request->last_name){
                    $user->name = $user->first_name .' '. $request->last_name;
                    $user->last_name = $request->last_name;
                }
                if($request->first_name && $request->last_name){
                    $user->name = $request->first_name .' '. $request->last_name;
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                }


                $user->save();

                $response =['user'=>User::with('globalSettings')->findOrFail($id)];
                return $this->jsonSuccses(' updated user Profiles',$response);
            }
        }
        return $this->jsonError('UNAUTHORIZED',[],Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Remove the specified resource from storage.
     * the request methode is DELETE
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        if(Auth::check()){
            $loginId= Auth::id();
            if($loginId === intval($id)){
                $user =User::find($id);
                $user->delete();
                return $this->jsonSuccses(' delete user and  Profiles',[]);
            }
        }
        return $this->jsonError('UNAUTHORIZED',[],Response::HTTP_UNAUTHORIZED);
    }
}
