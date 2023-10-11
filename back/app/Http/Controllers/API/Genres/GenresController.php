<?php

namespace App\Http\Controllers\API\Genres;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genres;

class GenresController extends Controller
{
    public function index(){
        $genres = Genres::all();
        return $genres;
    }
    
    public function create()
    {
        $genres = [
            ['genre_name' => 'Фэнтези'],
            ['genre_name' => 'Детективы'],
            ['genre_name' => 'Ужасы'],
            ['genre_name' => 'Приключения'],
            ['genre_name' => 'Поэзия'],
            ['genre_name' => 'Триллеры'],
            ['genre_name' => 'Проза'],
            ['genre_name' => 'Эротика'],
            ['genre_name' => 'Любовные романы'],
            ['genre_name' => 'Фантастика'],
        ];
        foreach($genres as $genre){
            Genres::create($genre);
        }
        //$genresList = Genres::create();

        return response()->json(['message' => 'Книга успешно создана'], 201);
    }
}
