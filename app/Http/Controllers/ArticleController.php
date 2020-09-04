<?php

namespace App\Http\Controllers;

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
            ->select('id', 'category_id', 'title', 'slug', 'description', 'published_at')
            ->onlyPublished()
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $categories = \App\Category::orderBy('name')->get();

        return response()->view('blog.index', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    /**
     * Display a listing of the resource by the category.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function indexByCategory(string $slug)
    {
        $selectedCategory = \App\Category::where('slug', $slug)->firstOrFail();

        $articles = \App\Article::select('id', 'category_id', 'title', 'slug', 'description', 'published_at')
            ->onlyPublished()
            ->where('category_id', $selectedCategory->id)
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $categories = \App\Category::orderBy('name')->get();

        return response()->view('blog.index', [
            'articles' => $articles,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $article = \App\Article::with('category')
            ->bySlug($slug)
            ->onlyPublished()
            ->firstOrFail();

        return response()->view('blog.show', [
            'article' => $article,
        ]);
    }
}
