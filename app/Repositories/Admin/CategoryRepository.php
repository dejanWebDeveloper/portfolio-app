<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryRepository
{
    public function getFilteredCategory()
    {
        $query = Category::query();

        $name = request()->name;
        if ($name) {
            $query->where('name', 'like', "%{$name}%");
        }

        return $query;
    }
    public function store($data)
    {
        $data['slug'] = Str::slug($data['name']);
        $data['created_at'] = now();
        $newCategory = new Category();
        $newCategory->fill($data)->save();
    }
    public function delete($data)
    {
        $category = Category::findOrFail($data['category_for_delete_id']);
        $category->delete();
    }
}
