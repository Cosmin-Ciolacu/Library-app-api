<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateBookRequest;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(private BookService $bookService) {}

    public function index() {
        return $this->bookService->getBooks();
    }

    public function store(StoreOrUpdateBookRequest $request) {
        return $this->bookService->createBook($request->validated());
    }

    public function update(StoreOrUpdateBookRequest $request, Book $book) {
        return $this->bookService->updateBook($book, $request->validated());
    }

    public function destroy(Book $book) {
        $this->bookService->deleteBook($book);
    }
}
