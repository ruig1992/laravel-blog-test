<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'content',
        'image',
        'published_at',
        'is_published',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    /**
     * Get the category that owns the article.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
