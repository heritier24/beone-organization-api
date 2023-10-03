<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHomeSectionRequest;
use App\Services\HeroViewService;

class HeroViewController extends Controller
{
    public function __construct(protected HeroViewService $service)
    {
    }
    public function indexAction()
    {
        try {
            $result = $this->service->listHomeSection();

            return response()->json($result);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function createHeroView(CreateHomeSectionRequest $request)
    {
        try {
            $file = $request->file('image_path');
            if ($file) {

                $namefile = $file->getClientOriginalName();

                $file->storeAs('public', $namefile);

                $this->service->createHeroView($request->title, $request->body, $namefile);

            } else {

                return response()->json(["failed to upload portfolio file image and description, please try again"]);
            }

            return response()->json(["Hero Section Created Successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }
}
