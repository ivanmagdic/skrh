<?php

namespace App\Console\Commands;

use App\Models\Camera;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skrh:import {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses data from file and populates database';

    public function handle()
    {
        $file = File::get($this->argument('file'));

        $cameras = collect(explode(PHP_EOL, $file))
            ->map(function ($item) {
                // Sometimes data contains hidden characters that we must remove
                return trim($item = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $item));
            })->filter(function ($item) {
                return Str::length($item) > 3;
            })->map(function ($item) {
                $c = explode('|', $item);
                return [
                    'longitude' => $c[0],
                    'latitude' => $c[1],
                    'name' => $c[2]
                ];
            });

        Camera::query()->delete();
        Camera::query()->insert($cameras->all());
    }
}
