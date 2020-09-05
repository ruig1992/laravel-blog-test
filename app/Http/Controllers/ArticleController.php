<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('category')
            ->select('id', 'category_id', 'title', 'slug', 'description', 'published_at')
            ->onlyPublished()
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $categories = Category::orderBy('name')->get();

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
    public function byCategory(string $slug)
    {
        $selectedCategory = Category::where('slug', $slug)->firstOrFail();

        $articles = Article::select('id', 'category_id', 'title', 'slug', 'description', 'published_at')
            ->onlyPublished()
            ->where('category_id', $selectedCategory->id)
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $categories = Category::orderBy('name')->get();

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
        $article = Article::with('category')
            ->bySlug($slug)
            ->onlyPublished()
            ->firstOrFail();

        return response()->view('blog.show', [
            'article' => $article,
        ]);
    }
}
