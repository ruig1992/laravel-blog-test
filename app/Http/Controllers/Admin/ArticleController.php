<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogArticle;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = \App\Article::with('category')
            ->select('id', 'category_id', 'title', 'slug', 'is_published', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->view('admin.articles.index', [
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::orderBy('name')->get();

        return response()->view('admin.articles.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBlogArticle $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBlogArticle $request)
    {
        $article = new Article([
            'category_id' => $request->get('category_id'),
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title')),
            'description' => $request->get('description'),
            'content' => $request->get('content'),
            'published_at' => $request->get('published_at') ?? Carbon::now(),
            'is_published' => $request->has('is_published'),
        ]);
        $article->save();

        return redirect()->route('admin.articles.index')->with('status', 'Article created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = \App\Category::orderBy('name')->get();

        return response()->view('admin.articles.edit', [
            'article' => $article,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBlogArticle $request
     * @param Article $article
     * @return void
     */
    public function update(StoreBlogArticle $request, Article $article)
    {
        $article->category_id = $request->get('category_id');
        $article->title = $request->get('title');
        $article->slug = Str::slug($request->get('title'));
        $article->description = $request->get('description');
        $article->content = $request->get('content');
        $article->published_at = $request->get('published_at') ?? Carbon::now();
        $article->is_published = $request->has('is_published');
        $article->save();

        return redirect()->route('admin.articles.edit', $article)->with('status', 'Article updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')->with('status', 'Article deleted!');
    }
}
