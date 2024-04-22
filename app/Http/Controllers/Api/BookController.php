<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @OA\Info(title="Simple Book API", version="0.1")
 */


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    /**
     * @OA\Get(
     *     path="/api/books",
     *     tags={"Books"},
     *     summary="List all books",
     *     operationId="getBooks",
     *     @OA\Response(
     *         response=200,
     *         description="A paginated list of books",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     required={"title", "publisher", "author", "genre", "publication", "word_count", "price"},
     *                     @OA\Property(property="id", type="integer", format="int64", description="Book ID"),
     *                     @OA\Property(property="title", type="string", description="Title of the book"),
     *                     @OA\Property(property="publisher", type="string", description="Publisher of the book"),
     *                     @OA\Property(property="author", type="string", description="Author of the book"),
     *                     @OA\Property(property="genre", type="string", description="Genre of the book"),
     *                     @OA\Property(property="publication", type="string", format="date", description="Publication date of the book"),
     *                     @OA\Property(property="word_count", type="integer", description="Word count of the book"),
     *                     @OA\Property(property="price", type="number", format="float", description="Price of the book")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="total", type="integer", description="Total number of items"),
     *                 @OA\Property(property="count", type="integer", description="Number of items per page"),
     *                 @OA\Property(property="per_page", type="integer", description="Number of items shown per page"),
     *                 @OA\Property(property="current_page", type="integer", description="Current page number"),
     *                 @OA\Property(property="total_pages", type="integer", description="Total number of pages")
     *             ),
     *             @OA\Property(
     *                 property="links",
     *                 type="object",
     *                 @OA\Property(property="first", type="string", description="Link to the first page"),
     *                 @OA\Property(property="last", type="string", description="Link to the last page"),
     *                 @OA\Property(property="prev", type="string", description="Link to the previous page"),
     *                 @OA\Property(property="next", type="string", description="Link to the next page")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No books found"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $books = Book::paginate(10);
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */

    /**
     * @OA\Post(
     *     path="/api/books",
     *     summary="Store a new book",
     *     operationId="storeBook",
     *     tags={"Books"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Provide book data",
     *         @OA\JsonContent(
     *             required={"title", "publisher", "author", "genre", "publication", "word_count", "price"},
     *             @OA\Property(property="title", type="string", example="Sample Book Title"),
     *             @OA\Property(property="publisher", type="string", example="Sample Publisher"),
     *             @OA\Property(property="author", type="string", example="Author Name"),
     *             @OA\Property(property="genre", type="string", example="Fiction"),
     *             @OA\Property(property="publication", type="string", format="date", example="2023-01-01"),
     *             @OA\Property(property="word_count", type="integer", example=12345),
     *             @OA\Property(property="price", type="number", format="float", example=19.99)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Book successfully created",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'publication' => 'required|date',
            'word_count' => 'required|integer',
            'price' => 'required|numeric'
        ]);

        $book = Book::create($validated);
        return response()->json($book, ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return JsonResponse
     */

    /**
     * @OA\Get(
     *     path="/api/books/{id}",
     *     summary="Get a single book",
     *     operationId="getBook",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the book to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     )
     * )
     */

    public function show(Book $book): JsonResponse
    {
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Book $book
     * @return JsonResponse
     */

    /**
     * @OA\Put(
     *     path="/api/books/{id}",
     *     summary="Update an existing book",
     *     operationId="updateBook",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the book to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated book data",
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated Book Title"),
     *             @OA\Property(property="publisher", type="string", example="Updated Publisher"),
     *             @OA\Property(property="author", type="string", example="Updated Author Name"),
     *             @OA\Property(property="genre", type="string", example="Updated Genre"),
     *             @OA\Property(property="publication", type="string", format="date", example="2023-01-02"),
     *             @OA\Property(property="word_count", type="integer", example=12346),
     *             @OA\Property(property="price", type="number", format="float", example=20.99)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     )
     * )
     */

    public function update(Request $request, Book $book): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'publisher' => 'string|max:255',
            'author' => 'string|max:255',
            'genre' => 'string|max:255',
            'publication' => 'date',
            'word_count' => 'integer',
            'price' => 'numeric'
        ]);

        $book->update($validated);
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return JsonResponse
     */

    /**
     * @OA\Delete(
     *     path="/api/books/{id}",
     *     summary="Delete a book",
     *     operationId="deleteBook",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the book to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Book deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     )
     * )
     */

    public function destroy(Book $book): JsonResponse
    {
        $book->delete();
        return response()->json(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
