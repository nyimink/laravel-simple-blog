<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'detail');
    }

    public function index()
    {

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
        $data = Category::all();

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
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect("/articles");
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if(Gate::allows('article-delete', $article)) {
            $article->delete();
        } else {
            return redirect("/articles");

        }
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();

        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = Article::find($id);

        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect("/articles");
    }
}
