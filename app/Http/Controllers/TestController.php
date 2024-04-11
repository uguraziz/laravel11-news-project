<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TestController extends Controller
{
    public function test_metodu()
    {
        // $user = $this->create_user();

        // $categori_modeli = Category::create([
        //     'name' => 'Test Kategori',
        //     'slug' => 'test-kategori '. rand(1, 1000),
        //     'image' => 'test.jpg',
        // ]);

        // News::create([
        //     'title' => 'Test Haber',
        //     'slug' => 'test-haber '.rand(1, 1000),
        //     'content' => 'Test Haber İçeriği',
        //     'image' => 'test.jpg',
        //     'category_id' => $categori_modeli->id,
        //     'user_id' => $user->id,
        //     'is_active' => 1,
        // ]);

        // softDelete
        // $haber = News::find(1)->delete();

        // all news
        // $haber = News::with('category', 'user')
        // ->withTrashed()
        // ->get();

        // $haber = News::with('category', 'user')->get();

        // reletaionship test
        // $user = User::find(3);
        // $news = $user->news()->first();
        // $images = $news->images()->first();
        // dd($images->image);

        dd('Test started!');
    }

    public function create_user(): User
    {
        return User::firstOrCreate([
            'name' => 'Test User'
        ], [
            'email' => 'aziz_altun93@hotmail.com',
            'password' => Hash::make('123'),
        ]);
    }
}
