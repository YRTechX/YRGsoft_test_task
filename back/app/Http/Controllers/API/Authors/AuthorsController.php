<?php

namespace App\Http\Controllers\API\Authors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Authors;

class AuthorsController extends Controller
{
    public function index(){
        $authors = Authors::all();
        return $authors;
    }
    public function create(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);
        
        $author = Authors::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        return response()->json(['message' => 'Автор успешно создан', 'author' => $author], 201);
    }
    public function update(Request $request, $id){
        $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
        ]);
        $author = Authors::find($id);

        if (!$author) {
            return response()->json(['message' => 'Автор не найден'], 404);
        }
        $author->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        return response()->json(['message' => 'Данные автора успешно обновлены'], 200);
    }
    public function delete($id)
    {
        $author = Authors::find($id);

        if (!$author) {
            return response()->json(['message' => 'Автор не найден'], 404);
        }

        $author->delete();

        return response()->json(['message' => 'Автор успешно удален']);
    }
}
