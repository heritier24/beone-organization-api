<?php

namespace App\Http\Controllers;

use App\Http\Requests\WhatwedoServiceRequest;
use App\Services\WhatwedoService;

class MakeServiceController extends Controller
{
    public function __construct(protected WhatwedoService $service)
    {
    }
    public function createService(WhatwedoServiceRequest $request)
    {
        try {
            $this->service->createService($request->title, $request->description);

            return response()->json(["what we do service created successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function updateService(WhatwedoServiceRequest $request, int $serviceID)
    {
        try {
            $this->service->updateService($request->title, $request->description, $serviceID);

            return response()->json(["what we do service updated successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function deleteService(int $serviceID)
    {
        try {
            $this->service->deleteService($serviceID);

            return response()->json(["what we do service deleted successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function listServices()
    {
        try {
            $result = $this->service->listServices();

            return response()->json($result);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }
}
