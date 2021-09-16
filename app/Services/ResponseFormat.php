<?php

namespace App\Services;

trait ResponseFormat
{
    public static function formatResponse($status, $data = null, $message)
    {
        $response = [
            "status" => $status,
            "message" => $message
        ];
        if ($data) $response["data"] = $data;
        return $response;
    }

    /**
     * @param Array_Object $data	The data to be sent with the response
     */
    public static function returnSuccess($data = null, $message = null)
    {
        return response()->json(ResponseFormat::formatResponse(true, $data, $message == null ? 'Successfull' : $message), 200);
    }


    /**
     * @param Optional_String $message	The custom message to be sent with the response
     * To return default text, call the method without the message parameter
     */
    public static function returnFailed($data = null, $message = null)
    {
        $data = $data == null ? 'Failed' : $data;
        return response()->json(ResponseFormat::formatResponse(false, $data, $message == null ? 'Failed' : $message), 200);
    }


    public static function returnNotFound()
    {
        return response()->json(ResponseFormat::formatResponse(false, null, 'The resource you are looking for is not available'), 200);
    }


    public static function returnInvalidAccessKey()
    {
        return response()->json(ResponseFormat::formatResponse(false, null, 'Invalid token'), 200);
    }

    public static function returnNotPermitted()
    {
        return response()->json(ResponseFormat::formatResponse(false, null, 'You are not permitted access to this resource'), 200);
    }
    public static function returnSystemFailure()
    {
        return response()->json(ResponseFormat::formatResponse(false, null, 'System failure'), 200);
    }
}
