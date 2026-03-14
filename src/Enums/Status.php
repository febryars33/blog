<?php

namespace Snairbef\Blog\Enums;

enum Status: string
{
    case ARCHIVED = 'archived';
    case DRAFT = 'draft';
    case PUBLISHED = 'publised';
}
