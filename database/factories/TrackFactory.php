<?php

namespace Database\Factories;

use App\Models\Track;
use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackFactory extends Factory
{
    protected $model = Track::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'album_id' => Album::factory(),
            'duration' => $this->faker->string('H:i:s'),
            'file_url' => $this->faker->url(),
        ];
    }
}
