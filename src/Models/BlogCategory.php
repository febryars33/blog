<?php

namespace Snairbef\Blog\Models;

use Database\Factories\BlogCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Snairbef\Blog\Blog\Blogable;

class BlogCategory extends Blogable
{
    /** @use HasFactory<BlogCategoryFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get all of the posts for the BlogCategory
     */
    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }
}
