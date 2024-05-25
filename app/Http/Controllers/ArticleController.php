<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    public function create()
    {
        return view('articles/create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'body' => [
                'required',
                'string',
                'max:255'
            ],
        ]);

        Article::create(
            [
                'body' => $input['body'],
                'users_id' => Auth::id()
            ]
        );

        return redirect()->route('articles.index');
    }
    
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 3);
        $articles = Article::with('user')
        ->select('id','body', 'users_id', 'created_at')
        ->latest()
        ->paginate($perPage);


        return view('articles.index', [
            'articles' => $articles,
        ]);
    }

    public function show(Article $article)
    {
        return view('/articles.show', [
            'article' => $article
        ]);
    }

    public function edit(Article $article){
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Request $request, Article $article){
        $this->authorize('update', $article);

        $input = $request->validate([
            'body' => [
                'required',
                'string',
                'max:255',
                'min:5',
            ]
        ]);

        $article->body = $input['body'];
        $article->save();
    
        return redirect()->route('articles.show', ['article' => $article->id ]);
    }

    public function destroy(Article $article){
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('articles.index');
    }
}
