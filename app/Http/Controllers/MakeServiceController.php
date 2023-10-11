<?php

namespace App\Http\Controllers;

use App\Http\Requests\WhatwedoServiceRequest;
use App\Services\WhatwedoService;
use Illuminate\Http\Request;

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

    /**
     * Undocumented function
     *
     * @param WhatwedoServiceRequest $request
     * @param integer $serviceID
     * @return void
     */
    #[WhatwedoServiceRequest()]
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

    public function createClientsTruestedus(Request $request)
    {
        try {
            $request->validate([
                "image_path" => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $file = $request->file('image_path');
            if ($file) {
                $name = $file->getClientOriginalName();
                $file->storeAs('public', $name);

                $this->service->createClientsTrustedus($name);

            } else {
                return response()->json(["failed to upload portfolio file image and description, please try again"]);
            }

            return response()->json(["Client Trusted us Logo Created successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function listClientsTruestedus()
    {
        try {
            $result = $this->service->listClientsTruested();

            return response()->json($result);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function removeClientsTruestedus(int $logoID)
    {
        try {
            $this->service->removeClientsTruestedus($logoID);

            return response()->json(["clients trusted us Logo removed successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }
}
