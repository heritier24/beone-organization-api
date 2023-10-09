<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamsRequest;
use App\Services\TeamsService;

class TeamsController extends Controller
{
    public function __construct(protected TeamsService $service)
    {
    }
    public function createTeams(TeamsRequest $request)
    {
        try {
            $file = $request->file('image_path');
            if ($file) {

                $namefile = $file->getClientOriginalName();

                $file->storeAs('public', $namefile);

                $this->service->createTeams($request->teamTitle, $request->teamPosition,
                    $request->twitterLink, $request->facebookLink,
                    $request->instagramLink, $request->linkedlnLink, $namefile);

            } else {

                return response()->json(["failed to upload file image and description, please try again"]);
            }

            return response()->json(["Teams Created successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }
}
