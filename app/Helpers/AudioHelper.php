<?php

namespace App\Helpers;

use FFMpeg\FFMpeg;
use Illuminate\Support\Facades\Storage;

class AudioHelper
{
    public static function getDurationFromFile($file)
    {
        $tempFilePath = $file->store('audio_files', 'public');

        $ffmpeg = FFMpeg::create();
        $audio = $ffmpeg->open(storage_path('app/public/' . $tempFilePath));

        $ffprobe = \FFMpeg\FFProbe::create();
        $durationInSeconds = $ffprobe->format(storage_path('app/public/' . $tempFilePath))->get('duration');

        Storage::delete($tempFilePath);

        $minutes = floor($durationInSeconds / 60);
        $seconds = $durationInSeconds % 60;
        $formattedDuration = sprintf('%02d:%02d', $minutes, $seconds);

        return $formattedDuration;
    }

    public static function storeFile($file)
    {
        return $file->store('audio_files', 'public');
    }
}
