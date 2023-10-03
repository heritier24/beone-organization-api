<?php

namespace App\Services;

use App\Models\HeroView;
use App\Models\MakeService;
use Illuminate\Support\Facades\DB;

class WhatwedoService
{
    public function createService(string $title, string $description)
    {
        $createService = MakeService::create([
            "title" => $title,
            "description" => $description,
        ]);

        return $createService;
    }

    public function updateService(string $title, string $description, int $serviceID)
    {
        $updateService = MakeService::where("id", $serviceID)->update([
            "title" => $title,
            "description" => $description
        ]);

        return $updateService;
    }

    public function deleteService(int $serviceID)
    {
        $deleteService = MakeService::where("id", $serviceID)->delete();

        return $deleteService;
    }

    public function listServices()
    {
        $listService = DB::select("SELECT MakeService.id, MakeService.title, MakeService.description FROM MakeService");

        $listHomeSection = HeroView::all();

        $uploadedHomeSections = $listHomeSection->map(function ($listHomeSection) {
            return [
                "id" => $listHomeSection->id,
                "title" => $listHomeSection->title,
                "body" => $listHomeSection->body,
                "image_path" => env('APP_URL') . '/' . 'storage/' . $listHomeSection->image_path,
            ];
        });

        return [
            "services" => $listService,
            "heroTitle" => $uploadedHomeSections[0]["title"],
            "heroBody" => $uploadedHomeSections[0]["body"]
        ];
    }
}
