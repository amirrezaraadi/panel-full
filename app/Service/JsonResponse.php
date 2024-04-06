<?php

namespace App\Service;
use Illuminate\Http\Response;

class JsonResponse
{
    public static function SuccessResponse($message , $status): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => $message , 'status' => $status], 200);
    }

    public static function NotFoundResponse($message , $status): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => $message , 'status' => $status],
            Response::HTTP_NOT_FOUND);
    }

    public static function internalSererError($message , $status): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => $message , 'status' => $status],
            Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public static function  forbidden($message , $status): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => $message , 'status' => $status],
            Response::HTTP_FORBIDDEN);
    }


}
