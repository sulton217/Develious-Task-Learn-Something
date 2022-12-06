<?php

namespace App\Lyrics;

use App\Lyrics\LyricsHttpClient;
use App\Lyrics\Exception\GetRequestLyricsFailedException;
use App\Lyrics\Exception\LyricsNotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class LyricsRepository extends Client
{
    /** @var LyricsHttpClient */
    private $lyricsHttpClient;

    public function __construct(LyricsHttpClient $lyricsHttpClient)
    {
        $this->lyricsHttpClient = $lyricsHttpClient;
    }

    public function getLyrics(string $artist, string $title): array
    {
        $requestId = $this->createRequestId();

        try {
            Log::info('Send lyrics request', ['artist' => $artist, 'title' => $title, 'request_id' => $requestId]);
            $result = $this->lyricsHttpClient->get("{$artist}/{$title}", $this->createHeaders($requestId));
            $result = $result->getBody()->getContents();
            $result = json_decode($result, true);
            return $result;
        } catch (ClientException $exception) {
            Log::info('Failed to get lyrics', ['artist' => $artist, 'title' => $title, 'request_id' => $requestId]);
            $statusCode = $exception->getCode();
            if ($statusCode === Response::HTTP_NOT_FOUND) {
                throw new LyricsNotFoundException;
            }
            throw new GetRequestLyricsFailedException;
        }
    }

    private function createHeaders(string $requestId): array
    {
        return [
            'headers' => [
                'requestId' => $requestId,
            ],
        ];
    }

    private function createRequestId(): string
    {
        return (string) Uuid::uuid4();
    }
}