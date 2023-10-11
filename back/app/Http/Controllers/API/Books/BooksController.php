<?php

namespace App\Http\Controllers\API\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books;

class BooksController extends Controller
{
    public function index(Request $request){
        $books = Books::when($request->has('genreId'), function ($query) use ($request) {
            $genreIds = explode(',', $request->input('genreId'));
            return $query->whereIn('genre_id', $genreIds);
        })
        ->when($request->has('authorId'), function ($query) use ($request) {
            $authorIds = explode(',', $request->input('authorId'));
            return $query->whereIn('author_id', $authorIds);
        })
        ->get();

        return $books;  
    }
    public function findByParam($param){
        $books = Books::all();
        return $books;
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'year_published' => 'required|integer',
            'author_id' => 'required|integer',
            'genre_id' => 'required|integer',
            'image_url' => 'required|string',
        ]);
        
        $book = Books::create([
            'title' => $request->input('title'),
            'year_published' => $request->input('year_published'),
            'author_id' => $request->input('author_id'),
            'genre_id' => $request->input('genre_id'),
            'image_url' => $request->input('image_url'),
        ]);
        return response()->json(['message' => 'Книга успешно создана', 'book' => $book], 201);
        
    }
    public function update(Request $request, $id){
        $request->validate([
            'title' => 'string',
            'year_published' => 'integer',
            'author_id' => 'integer',
            'genre_id' => 'integer',
            'image_url' => 'string',
        ]);
        $book = Books::find($id);

        if (!$book) {
            return response()->json(['message' => 'Книга не найдена'], 404);
        }
        $book->update([
            'title' => $request->input('title'),
            'year_published' => $request->input('year_published'),
            'author_id' => $request->input('author_id'),
            'genre_id' => $request->input('genre_id'),
            'image_url' => $request->input('image_url'),
        ]);

        return response()->json(['message' => 'Данные книги успешно обновлены'], 200);
    }
    public function delete($id)
    {
        $book = Books::find($id);

        if (!$book) {
            return response()->json(['message' => 'Книга не найдена'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Книга успешно удалена']);
    }
}
