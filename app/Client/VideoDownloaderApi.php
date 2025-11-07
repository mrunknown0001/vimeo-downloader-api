<?php

namespace App\Client;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VideoDownloaderApi
{
    private string $apiKey;
    private string $baseUrl = 'https://p.savenow.to/ajax/download.php';

    private string $progressUrl = 'https://p.savenow.to/api/progress';

    public function __construct()
    {
        $this->apiKey = config('services.video_download_api.key', '');
    }

    public function download(string $url, string $format = '1080'): array
    {
        if (empty($this->apiKey)) {
            return ['success' => false, 'error' => 'API key not configured'];
        }

        try {
            $response = Http::timeout(30)->get($this->baseUrl, [
                'url' => $url,
                'format' => $format,
                'apikey' => $this->apiKey,
                'audio_quality' =>  320,
                'allow_extended_durations' => true,
            ]);
            
            if ($response->successful()) {
                return $response->json();
            }

            return ['success' => false, 'error' => 'Failed to connect to the video download service'];

        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function downloadStatus(string $id): array
    {
        $response = Http::timeout(10)->get($this->progressUrl , [
            'id' => $id
        ]);

        return $response->json();
    }
}