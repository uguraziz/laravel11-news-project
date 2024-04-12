<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function get_news(int $id = 0)
    {
        if($id != 0) {
            $news = News::find($id);
        } else {
            $news = News::all();
        }

        if(!$news) {
            return response()->json([
                'status' => false,
                'message' => 'News not found'
            ], 400);
        }

        return response()->json([
            'status' => true,
            'message' => 'News listed successfully',
            'data' => $news
        ]);
    }

    public function create_news(Request $request)
    {
        $news = new News();
        $news->title = $request->title;
        $news->slug = Str::slug($request->title);
        $news->content = $request->content;
        $news->image_id = $request->image_id;
        $news->user_id = $request->user_id;
        $news->category_id = $request->category_id;
        $news->save();

        return response()->json([
            'status' => true,
            'message' => 'News created successfully',
            'data' => $news
        ]);
    }

    public function update_news(Request $request, int $id)
    {
        $news = News::findOrFail($id);

        $news->title = $request->title ?? $news->title;
        $news->slug = Str::slug($request->title) ?? $news->slug;
        $news->content = $request->content ?? $news->content;
        $news->image_id = $request->image_id ?? $news->image_id;
        $news->user_id = $request->user_id ?? $news->user_id;
        $news->category_id = $request->category_id ?? $news->category_id;
        $news->save();

        return response()->json([
            'status' => true,
            'message' => 'News updated successfully',
            'data' => $news
        ]);
    }

    public function delete_news(int $id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return response()->json([
            'status' => true,
            'message' => 'News deleted successfully'
        ]);
    }
}
