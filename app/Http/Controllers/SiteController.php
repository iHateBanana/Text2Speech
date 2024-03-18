<?php

namespace App\Http\Controllers;

use App\Services\TextToSpeechService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function index() {
        return view('index');
    }

    public function store(Request $request) {
        $request->validate([
            'inputs'=>'required|string'
        ]);

        $ttsService = new TextToSpeechService();
        $response = $ttsService->getResponse($request->inputs);
        $contents = $response->getBody()->getContents();
        $name = 'speech-' . \Str::random(20);
        $fileName = 'speech-' . \Str::random(20) . '.wav';
        Storage::disk('public')->put($fileName, $contents);
    }


}
