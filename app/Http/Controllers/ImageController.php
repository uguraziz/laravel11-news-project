<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends Controller
{
    private $disk_name = 'public';
    private $disk = null;
    public function __construct()
    {
        $this->disk = Storage::disk($this->disk_name);
    }

    public function test()
    {
        $json = json_encode(['name' => 'Uğur ALTUN', 'age' => 30, 'state' => 'Türkiye']);
        $this->disk->put('test.json', $json);

        $temp_url = $this->disk->temporaryUrl('test.json', now()->addSecond(10));

        return response()->json(['url' => $temp_url]);
    }

    public function download(Request $request)
    {
        abort_if(!$this->disk->exists($request->path), 404, 'File not found');
        abort_if(!$request->hasValidSignature(), 403, 'Time expired or invalid signature');
        return $this->disk->download($request->path);
    }

    public function upload(UploadRequest $request)
    {
        $year = now()->format('Y');
        $month = now()->format('m');

        $path = $request->file('file')->store("images", $this->disk_name);
        try {
            $image = new Image();
            $image->name = $request->name;
            $image->path = $path;
            $image->save();
            return response()->json([
                'status' => true,
                'message' => 'Image uploaded successfully'
            ]);
        } catch (\Exception $e) {
            $this->disk->delete($path);
            $image->delete();
            return response()->json([
                    'status' => true,
                    'message' => $e->getMessage()
            ]);
        }
    }

    public function find_by_name(Request $request)
    {
        $image = Image::where('name', 'like', "%$request->name%")->get();

        if ($image->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Images not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Images found',
            'data' => $image
        ]);
    }


    public function delete(Request $request)
    {
        $image = Image::find($request->id);

        try {
            if (!$image) {
                throw new \Exception('Image not found', 404);
            }

            $this->disk->delete($image->path);
            $image->delete();

            return response()->json([
                'status' => true,
                'message' => 'Image deleted successfully'
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function update_image(Request $request)
    {
        $image = Image::find($request->id);

        try {
            if (!$image) {
                throw new \Exception('Image not found', 404);
            }

            $this->disk->delete($image->path);
            $path = $request->file('file')->store("images", $this->disk_name);
            $image->path = $path;
            $image->save();

            return response()->json([
                'status' => true,
                'message' => 'Image updated successfully'
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
