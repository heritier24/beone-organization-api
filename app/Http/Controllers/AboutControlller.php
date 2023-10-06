<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutSectionRequest;
use App\Services\AboutService;
use Illuminate\Http\Request;

class AboutControlller extends Controller
{
    public function __construct(protected AboutService $service) {
    }
    public function createAboutSection(AboutSectionRequest $request)
    {
        try {
            $file = $request->file('image_path');
            if ($file) {

                $namefile = $file->getClientOriginalName();

                $file->storeAs('public', $namefile);

                $this->service->createAboutSection($request->title, $request->body, $namefile);

            } else {

                return response()->json(["failed to upload file image and description, please try again"]);
            }

            return response()->json(["About section created successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function updateAboutSection(AboutSectionRequest $request, $id)
    {
        try {
            $file = $request->file('image_path');
            if ($file) {

                $namefile = $file->getClientOriginalName();

                $file->storeAs('public', $namefile);

                $this->service->updateAboutSection($request->title, $request->body, $namefile, $id);

            } else {

                return response()->json(["failed to upload file image and description, please try again"]);
            }

            return response()->json(["About section Updated successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function listAboutSection()
    {
        try {
            $result = $this->service->listAboutSection();

            return response()->json($result);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }
}
