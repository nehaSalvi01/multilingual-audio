<?php

namespace App\Http\Controllers;

use App\Models\AudioFile;
use App\Models\Collection;
use Illuminate\Http\Request;

class AudioFileController extends Controller
{
    public function index()
    {
        $collections = Collection::all();
        return view('audio.list', compact('collections'));
    }
    public function create()
    {
        return view('audio.add');
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'collection_name' => 'required|string|max:255',
            'files.*' => 'required|file|mimes:mp3,wav|max:20480',
            'language.*' => 'required|string|max:255',
        ]);


        $collection = Collection::create([
            'name' => $validatedData['collection_name'],
            'description' => $request->description,
        ]);

        $filePaths = [];
        $language = $request->language;

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $filePaths[] = $file->store('audio', 'public');
            }
        }

        foreach ($filePaths as $index => $filePath) {
            AudioFile::create([
                'file_path' => $filePath,
                'language' => $language[$index] ?? null,
                'collection_id' => $collection->id,
            ]);
        }
        // dd($request->all());
        return redirect()->back()->with('success', 'Audio files uploaded successfully!');
    }


    public function edit($id)
    {
        $collection = Collection::with('audioFiles')->findOrFail($id);
        return view('audio.edit', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'collection_name' => 'required|string|max:255',
            'files.*' => 'nullable|file|mimes:mp3,wav|max:20480',
            'language.*' => 'required|string|max:255',
        ]);

        $collection = Collection::findOrFail($id);
        $collection->update([
            'name' => $validatedData['collection_name'],
            'description' => $request->description,
        ]);

        $filePaths = [];
        $languages = $request->language;

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $filePaths[] = $file->store('audio', 'public');
            }

            foreach ($filePaths as $index => $filePath) {
                AudioFile::create([
                    'file_path' => $filePath,
                    'language' => $languages[$index] ?? null,
                    'collection_id' => $collection->id,
                ]);
            }
        }


        foreach ($collection->audioFiles as $index => $audioFile) {
            if (isset($languages[$index])) {
                $audioFile->update([
                    'language' => $languages[$index],
                ]);
            }
        }

        return redirect()->route('audio.index')->with('success', 'Audio files updated successfully!');
    }



    public function show($id)
    {
        $collection = Collection::with('audioFiles')->findOrFail($id);
        return view('audio.view', compact('collection'));
    }

    public function showView($id)
    {
        return view('audio.view', ['id' => $id]);
    }

    public function destroy($id)
    {
        $collection = Collection::with('audioFiles')->findOrFail($id);
        $collection->delete();
        return response()->json(null, 204);
    }
}
