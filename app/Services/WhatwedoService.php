<?php

namespace App\Services;

use App\Models\AboutView;
use App\Models\ClientsTrustedUs;
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
            "description" => $description,
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

        $listAboutSsection = AboutView::all();

        $uploadedHomeSections = $listHomeSection->map(function ($listHomeSection) {
            return [
                "id" => $listHomeSection->id,
                "title" => $listHomeSection->title,
                "body" => $listHomeSection->body,
                "image_path" => env('APP_URL') . '/' . 'storage/' . $listHomeSection->image_path,
            ];
        });

        $uploadAboutSection = $listAboutSsection->map(function ($listAboutSsection) {
            return [
                "id" => $listAboutSsection->id,
                "title" => $listAboutSsection->title,
                "body" => $listAboutSsection->body,
                "image_path" => env('APP_URL') . '/' . 'storage/' . $listAboutSsection->image_path,
            ];
        });

        $listClientsTrustedUs = ClientsTrustedUs::all();

        $uploadedClientssSections = $listClientsTrustedUs->map(function ($listClientsTrustedUs) {
            return [
                "logoID" => $listClientsTrustedUs->id,
                "imagePathLogo" => env('APP_URL') . '/' . 'storage/' . $listClientsTrustedUs->image_path,
            ];
        });

        return [
            "services" => $listService,
            "heroTitle" => $uploadedHomeSections[0]["title"],
            "heroBody" => $uploadedHomeSections[0]["body"],
            "image_path" => $uploadedHomeSections[0]["image_path"],
            "aboutTitle" => $uploadAboutSection[0]["title"],
            "aboutBody" => $uploadAboutSection[0]["body"],
            "aboutImagePath" => $uploadAboutSection[0]["image_path"],
            'clientsTrustedUs' => $uploadedClientssSections
        ];
    }

    public function createClientsTrustedus(string $namePath)
    {
        $createClientsTrustedUs = ClientsTrustedUs::create([
            "image_path" => $namePath
        ]); 
        
        return $createClientsTrustedUs;
    }

    public function listClientsTruested()
    {
        $listClientsTrustedUs = ClientsTrustedUs::all();

        $uploadedHomeSections = $listClientsTrustedUs->map(function ($listClientsTrustedUs) {
            return [
                "logoID" => $listClientsTrustedUs->id,
                "imagePathLogo" => env('APP_URL') . '/' . 'storage/' . $listClientsTrustedUs->image_path,
            ];
        });

        return $uploadedHomeSections;
    }
}
