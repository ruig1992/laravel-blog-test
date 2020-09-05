<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);

        return response()->view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBlogCategory $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBlogCategory $request)
    {
        $category = new Category([
            'name' => $request->get('name'),
        ]);
        $category->save();

        return redirect()->route('admin.categories.index')->with('status_success', 'Category created!');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Category $category)
    {
        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return response()->view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBlogCategory $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreBlogCategory $request, Category $category)
    {
        $category->name = $request->get('name');
        $category->save();

        return redirect()->route('admin.categories.edit', $category)->with('status_success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')
                ->with('status_error', 'Failed to delete category! Perhaps some articles use it.');
        }

        return redirect()->route('admin.categories.index')->with('status_success', 'Category deleted!');
    }
}
