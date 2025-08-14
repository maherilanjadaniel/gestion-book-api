<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Repositories\Eloquent\Book\BookRepository;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BookResource::collection(
            $this->bookRepository->getAll()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = $this->bookRepository->create($request->validated());

        return response()->json([
            'message' => 'Book created successfully',
            'data' => new BookResource($book)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new BookResource($this->bookRepository->getById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, string $id)
    {
        $this->bookRepository->update($request->validated());
        return response()->json([
            'message' => 'Book updated successfully',
            'data' => new BookResource($this->bookRepository->getById($id))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->bookRepository->delete($id);
        return response()->json([
            'message' => 'Book deleted successfully'
        ]);
    }
}
