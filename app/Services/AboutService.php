<?php

namespace App\Services;

use App\Models\AboutView;

class AboutService
{
    public function createAboutSection(string $title, string $body, string $nameFile)
    {
        $about = AboutView::firstOrCreate([
            "title" => $title,
            "body" => $body,
            "image_path" => $nameFile,
        ]);

        return $about;
    }

    public function updateAboutSection(string $title, string $body, string $nameFile, int $id)
    {
        $updateAbout = AboutView::where("id", $id)->update([
            "title" => $title,
            "body" => $body,
            "image_path" => $nameFile
        ]);

        return $updateAbout;
    }

    public function listAboutSection()
    {
        $listHomeSection = AboutView::all();

        $uploadedHomeSections = $listHomeSection->map(function ($listHomeSection) {
            return [
                "id" => $listHomeSection->id,
                "title" => $listHomeSection->title,
                "body" => $listHomeSection->body,
                "image_path" => env('APP_URL') . '/' . 'storage/' . $listHomeSection->image_path,
            ];
        });

        return $uploadedHomeSections;   
    }
}
