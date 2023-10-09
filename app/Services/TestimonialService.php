<?php

namespace App\Services;

use App\Models\Testimonials;

class TestimonialService
{
    public function createTestimonial(string $nameTitle, string $namePosition, string $nameDescription, string $namePath)
    {
        $createTestimonial = Testimonials::create([
            "nameTitle" => $nameTitle,
            "namePosition" => $namePosition,
            "nameDescription" => $nameDescription,
            "image_path" => $namePath
        ]);

        return $createTestimonial;
    }

    public function removeTestimonial(int $testimonialID)
    {
        $removeTestimonial = Testimonials::where("id", $testimonialID)->delete();

        return $removeTestimonial;
    }
}
