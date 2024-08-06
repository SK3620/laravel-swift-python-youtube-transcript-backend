<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class TranscriptController extends Controller
{
    public function getTranscript($video_id)
    {
        $scriptPath = base_path('sample-laravel-flutter-youtube-transcript-env/scripts/get_transcript.py'); // Pythonスクリプトのパス

        $process = new Process(['python3', $scriptPath, $video_id]);
        $process->run();



        // エラー処理
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }


        $transcript = $process->getOutput();
        return response()->json(json_decode($transcript, true));
    }
}