<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class JsonController extends Controller
{
    /**
     * success
     * @param String $message
     * @param array $value
     * @param bool $create
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonSuccses(String $message, Array $value, Bool $create = false): \Illuminate\Http\JsonResponse
    {
        if (!$create){
            $response =['status'=>['message'=>$message ,'code'=>Response::HTTP_CREATED,'type'=>'success'],'data'=>$value];
            return response()->json($response,Response::HTTP_CREATED);
        }
        $response =['status'=>['message'=>$message ,'code'=>Response::HTTP_OK,'type'=>'success'],'data'=>$value];
        return response()->json($response,Response::HTTP_OK);
    }

    /**
     * error
     * @param String $message
     * @param array $value
     * @param bool $error
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonError(String $message, Array $value, Bool $error): \Illuminate\Http\JsonResponse
    {
        if (!$error){
            $response =['status'=>['message'=>$message ,'code'=>Response::HTTP_INTERNAL_SERVER_ERROR,'type'=>'error'],'data'=>$value];
            return response()->json($response,Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $response =['status'=>['message'=>$message ,'code'=>Response::HTTP_NOT_FOUND,'type'=>'error'],'data'=>$value];
        return response()->json($response,Response::HTTP_NOT_FOUND);
    }
}
