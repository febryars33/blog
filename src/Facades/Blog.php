<?php

namespace Snairbef\Blog\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Snairbef\Blog\Blog
 */
class Blog extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Snairbef\Blog\Blog::class;
    }
}
