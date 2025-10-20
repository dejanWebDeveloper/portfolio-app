<?php

namespace App\Repositories\Admin;

use App\Models\Project;
use App\Models\Category;
use App\Models\Tag;

class IndexRepository
{
    public function getDashboardStats(): array
    {
        return [
            'numberOfProjects' => Project::count(),
            'numberOfCategories' => Category::count(),
            'numberOfTags' => Tag::count()
        ];
    }
}
