<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function testUserCanGetAllBooks()
    {
        Book::factory()->create();

        $response = $this->get('/api/books');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'publisher', 'author', 'genre', 'publication', 'word_count', 'price', 'created_at', 'updated_at']
                ],
                'first_page_url', 'last_page_url', 'prev_page_url', 'next_page_url',
                'links' => [
                    '*' => ['url', 'label', 'active']
                ]
            ]);
    }

    public function testUserCanCreateBook()
    {
        $bookData = [
            'title' => 'New Book',
            'author' => 'Author Name',
            'publisher' => 'Publisher Name',
            'genre' => 'Genre',
            'publication' => '2024-01-01',
            'word_count' => 1234,
            'price' => 19.99
        ];

        $response = $this->postJson('/api/books', $bookData);
        $response->assertStatus(201)
            ->assertJson([
                'price' => number_format(19.99, 2)
            ]);

        $this->assertDatabaseHas('books', [
            'price' => number_format(19.99, 2)
        ]);
    }


    public function testUserCanRetrieveSingleBook()
    {
        $book = Book::factory()->create();

        $response = $this->get("/api/books/{$book->id}");

        $response->assertOk()
            ->assertJson([
                'id' => $book->id,
                'title' => $book->title
            ]);
    }

    public function testUserCanUpdateBook()
    {
        $book = Book::factory()->create([
            'title' => 'Original Title'
        ]);

        $response = $this->putJson("/api/books/{$book->id}", [
            'title' => 'Updated Title'
        ]);

        $response->assertOk()
            ->assertJson([
                'id' => $book->id,
                'title' => 'Updated Title'
            ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Updated Title'
        ]);
    }

    public function testUserCanDeleteBook()
    {
        $book = Book::factory()->create();

        $response = $this->delete("/api/books/{$book->id}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('books', [
            'id' => $book->id
        ]);
    }






}
