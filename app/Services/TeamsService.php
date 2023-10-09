<?php

namespace App\Services;

use App\Models\Teams;

class TeamsService
{
    public function createTeams(string $teamTitle, string $teamPosition,
        string $twitterLink, string $facebookLink,
        string $instagramLink, string $linkedlnLink, string $namePath) {

            $createTeams = Teams::create([
                "teamTitle" => $teamTitle,
                "teamPosition" => $teamPosition,
                "twitterLink" => $twitterLink,
                "facebookLink" => $facebookLink,
                "instagramLink" => $instagramLink,
                "linkedlnLink" => $linkedlnLink,
                "image_path" => $namePath
            ]);

            return $createTeams;
    }
}
