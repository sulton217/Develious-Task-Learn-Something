<?php

namespace App\Lyrics;

use GuzzleHttp\Client;

class LyricsHttpClient extends Client
{
    public function __construct()
    {
        parent::__construct([
            'base_uri' => 'api.lyrics.ovh/v1/',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ]);
    }
}