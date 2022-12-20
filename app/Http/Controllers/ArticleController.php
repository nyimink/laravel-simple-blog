<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        // dd("Articles controller index");
        // return view('articles.index');

        // $data = [
        //     ['id' => 1, 'title' => 'First Article'],
        //     ['id' => 2, 'title' => 'Second Article'],
        // ];

        // $data = Article::all();

        $data = Article::latest()->paginate(5);

        return view('articles.index', [
            'articles' => $data,         // now you will have $articles in view(index.php)
        ]);

    }

    public function detail($id)
    {
        // dd("Article details - $id");
        $data = Article::find($id);

        return view('articles.detail', [
            'article' => $data,
        ]);
    }

    public function add()
    {
        $data = [
            ['id' => 1, 'name' => 'News'],
            ['id' => 2, 'name' => "Tech"],
        ];

        return view('articles.add', [
            'categories' => $data,
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        // get data from FORM (request method or $request can be used)
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->save();

        return redirect("/articles");
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect("/articles")->with('info', "An Article \"$article->title\" is Deleted.");
    }
}
