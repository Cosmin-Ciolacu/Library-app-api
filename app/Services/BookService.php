<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function getBooks() {
        return Book::all();
    }

    public function getBook($id) {
        return Book::find($id);
    }

    public function createBook($data) {
        return Book::create($data);
    }

    public function updateBook(Book $book, $data) {
        $book->update($data);
        return $book;
    }

    public function deleteBook(Book $book) {
        $book->delete();
    }
}
