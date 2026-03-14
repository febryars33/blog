<?php

namespace Snairbef\Blog\Blog;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Trait for models that can be blogged.
 *
 * This trait adds a `slug` attribute to the model, which is
 * automatically generated based on the model's title.
 *
 * The `slug` attribute is used to generate a unique URL for the
 * model, which can be used to display a single model instance.
 *
 * @see HasSlug
 */
class Blogable extends Model
{
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
