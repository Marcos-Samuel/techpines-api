<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlbumFactory extends Factory
{
    protected $model = Album::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'artist_id' => \App\Models\Artist::factory(),
            'release_year' => $this->faker->year,
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
