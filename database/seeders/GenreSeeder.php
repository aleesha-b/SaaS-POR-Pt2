<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedGenres = [
            ['id' => 1, 'name' => "Unknown"],
            ['id' => 2, 'name' => "Fiction"],
            ['id' => 3, 'name' => "Non-Fiction"],
            ['id' => 4, 'name' => "Autobiography"],
            ['id' => 5, 'name' => "Science Fiction"],
            ['id' => 6, 'name' => "History"],
            ['id' => 7, 'name' => "Technical"],
            ['id' => 8, 'name' => "LGBTQIA+"],
            ['id' => 9, 'name' => "Classic"],
            ['id' => 10, 'name' => "Science"],
            ['id' => 11, 'name' => "Novel"],
            ['id' => 12, 'name' => "Philosophy"]
        ];
        foreach ($seedGenres as $seedGenre){
            Genre::create($seedGenre);
        }
    }
}
