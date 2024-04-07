<?php

namespace App\Service;
use Illuminate\Http\Response;

class JsonResponse
{
    public static function SuccessResponse($message = null  , $status = null ): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => $message , 'status' => $status], 200);
    }

    public static function NotFoundResponse($message = null  , $status = null ): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => $message , 'status' => $status],
            Response::HTTP_NOT_FOUND);
    }

    public static function internalSererError($message = null  , $status = null ): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => $message , 'status' => $status],
            Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public static function  forbidden($message = null  , $status = null ): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => $message , 'status' => $status],
            Response::HTTP_FORBIDDEN);
    }

    public function SuccessFindid($id)
    {
        return response()->json(['email' => $id ],200);
    }

}
