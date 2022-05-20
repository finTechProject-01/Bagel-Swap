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
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonError(String $message, Array $value, Int $code): \Illuminate\Http\JsonResponse
    {
        $response =['status'=>['message'=>$message ,'code'=>$code,'type'=>'error'],'data'=>$value];
        return response()->json($response,$code);
    }
    public function reg_number($id): string
    {
        $regNum = '';
        $uniqueId = str_pad($id, 4, '0', STR_PAD_LEFT);
        $date = date('y');
        $regNum = "AH" . '\\' . $date . '\\' . $uniqueId;
        return $regNum;
    }


}
