<?php

namespace Snairbef\Blog\Models;

use App\Models\User;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Snairbef\Blog\Enums\Status;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogPost extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory, HasSEO, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'blog_category_id',
        'title',
        'slug',
        'body',
        'status',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'blog_category',
        'tags',
        'user',
        'seo',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'excerpt',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }

    /**
     * Get the user that owns the Post
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tags that belong to the Post
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class);
    }

    /**
     * Get the category that owns the BlogPost
     */
    public function blog_category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    protected function excerpt(): Attribute
    {
        return Attribute::make(get: function () {
            return Str::limit(strip_tags($this->body), 250);
        });
    }

    public function getDynamicSEOData(): SEOData
    {
        // $pathToFeaturedImageRelativeToPublicPath = // ..;

        // Override only the properties you want:
        return new SEOData(
            title: $this->title,
            description: Str::limit(strip_tags($this->body), 150),
            // image: $pathToFeaturedImageRelativeToPublicPath,
        );
    }
}
