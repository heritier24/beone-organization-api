<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialsRequest;
use App\Services\TestimonialService;

class TestimonialsController extends Controller
{
    public function __construct(protected TestimonialService $service)
    {
    }
    public function createTestimonial(TestimonialsRequest $request)
    {
        try {
            $file = $request->file('image_path');
            if ($file) {

                $namefile = $file->getClientOriginalName();

                $file->storeAs('public', $namefile);

                $this->service->createTestimonial($request->nameTitle, $request->namePosition, $request->nameDescription, $namefile);

            } else {

                return response()->json(["failed to upload file image and description, please try again"]);
            }

            return response()->json(["testimonial created successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function removeTestimonial(int $testimonialID)
    {
        try {
            $this->service->removeTestimonial($testimonialID);

            return response()->json(["remove testimonial successfully removed"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }
}
