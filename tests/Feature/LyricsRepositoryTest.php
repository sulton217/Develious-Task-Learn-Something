<?php

namespace Tests\Feature;

use App\Lyrics\LyricsRepository;
use Illuminate\Support\Arr;
use Tests\TestCase;

class LyricsRepositoryTest extends TestCase
{
    const SONG_ARTIST = 'Bring Me The Horizon';
    const SONG_TITLE = 'Follow You';
    const SONG_LYRICS = "My head is haunting me and my heart feels like a ghost...";
    
    const ATTRIBUTE_LYRICS = 'lyrics';

    /** @var LyricsRepository */
    private $lyricsRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->lyricsRepository = $this->app->make(LyricsRepository::class);
    }

    public function testGetLyricsSuccess()
    {
        $result = $this->lyricsRepository->getLyrics(self::SONG_ARTIST, self::SONG_TITLE);
        $this->assertEquals(self::SONG_LYRICS, Arr::get($result, self::ATTRIBUTE_LYRICS));
    }
}