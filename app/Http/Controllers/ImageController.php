<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function test()
    {
        $json = json_encode(['name' => 'Uğur ALTUN', 'age' => 30, 'state' => 'Türkiye']);
        Storage::disk('public')->put('test.json', $json);

        $temp_url = Storage::disk('public')->temporaryUrl('test.json', now()->addSecond(10));

        return response()->json(['url' => $temp_url]);
    }

    public function download(Request $request)
    {
        abort_if(!Storage::disk('public')->exists($request->path), 404, 'File not found');
        abort_if(!$request->hasValidSignature(), 403, 'Time expired or invalid signature');
        return Storage::disk('public')->download($request->path);
    }
}
