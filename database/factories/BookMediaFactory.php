<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BookList;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Upload;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookMedia>
 */
class BookMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        Storage::fake('avatars');

        $file =  UploadedFile::fake()->image('avatar.jpg') ;

        return [
            'media_name' => $file,
        ];
    }
}
