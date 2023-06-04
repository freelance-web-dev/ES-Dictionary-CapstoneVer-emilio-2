<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordsController extends Controller
{
    public function index()
    {
        $words = Word::all();
        return response()->json($words);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'word' => 'required|unique:words',
            'definition' => 'required',
            'part_of_speech' => 'required',
            'image_url' => 'nullable|url',
        ]);

        $word = Word::create($data);
        return response()->json($word, 201);
    }

    public function show($id)
    {
        $word = Word::findOrFail($id);
        return response()->json($word);
    }

    public function update(Request $request, $id)
    {
        $word = Word::findOrFail($id);

        $data = $request->validate([
            'word' => 'required|unique:words,word,' . $id,
            'definition' => 'required',
            'part_of_speech' => 'required',
            'image_url' => 'nullable|url',
        ]);

        $word->update($data);
        return response()->json($word);
    }

    public function destroy($id)
    {
        $word = Word::findOrFail($id);
        $word->delete();
        return response()->json(null, 204);
    }
}
