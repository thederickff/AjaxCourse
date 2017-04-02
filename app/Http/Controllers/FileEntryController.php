<?php

namespace App\Http\Controllers;

use App\Fileentry;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileEntryController extends Controller
{
    //
    public function index()
    {
        $entries = Fileentry::all();

        return view('fileentries.index', compact('entries'));
    }

    public function add(Request $request) {


        $file = $request->file('filefield');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
        $entry = new Fileentry();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename().'.'.$extension;

        $entry->save();

        return redirect('fileentry');

    }
    public function get($filename){

        $entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);

        return (new Response($file, 200))
            ->header('Content-Type', $entry->mime);
    }
}
