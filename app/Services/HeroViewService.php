<?php

namespace App\Services;

use App\Models\HeroView;

class HeroViewService
{
    public function createHeroView(string $title, string $body, string $nameFile)
    {
        $createHero = HeroView::firstOrCreate([
            "title" => $title,
            "body" => $body,
            "image_path" => $nameFile,
        ]);

        return $createHero;
    }

    public function listHomeSection()
    {
        $listHomeSection = HeroView::all();

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
