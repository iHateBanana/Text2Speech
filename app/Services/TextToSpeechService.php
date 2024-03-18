<?php
namespace App\Services;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
class TextToSpeechService
{
    protected $client;
    protected $apiKey;
    public function __construct()
    {
        $this->apiKey = env('TTS_API_KEY');
        $this->client = new Client([
            'base_uri' => 'https://api-inference.huggingface.co/models/facebook/mms-tts-eng',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ]);

    }
    public function getResponse($prompt)
    {
        $response = $this->client->post('/', [
            'inputs' => $prompt
        ]);

        return $response;
    }
}


