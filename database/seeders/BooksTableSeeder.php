<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'The Great Gatsby',
                'publisher' => 'Charles Scribner\'s Sons',
                'author' => 'F. Scott Fitzgerald',
                'genre' => 'Novel',
                'publication' => '1925-04-10',
                'word_count' => 47000,
                'price' => 15.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => '1984',
                'publisher' => 'Secker & Warburg',
                'author' => 'George Orwell',
                'genre' => 'Dystopian, Political fiction, Social science fiction',
                'publication' => '1949-06-08',
                'word_count' => 89000,
                'price' => 12.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'The Catcher in the Rye',
                'publisher' => 'Little, Brown and Company',
                'author' => 'J. D. Salinger',
                'genre' => 'Fiction, Poetry',
                'publication' => '1951-07-16',
                'word_count' => 50000,
                'price' => 9.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
