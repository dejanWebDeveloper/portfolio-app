<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    protected $fillable = [
        'heading',
        'slug',
        'preheading',
        'text',
        'photo',
        'github_link',
        'demo_link',
        'additional_photo',
        'category_id',
        'author',
        'views',
        'enable',
        'priority'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tags', 'project_id', 'tag_id');
    }
    public function imageUrl()
    {
        if (!is_null($this->photo)) {
            //return asset('storage/photo/' . $this->photo);
            return Storage::url('photo/' . $this->photo);
        }

        // Default photo
        return asset('themes/front/img/featured-pic-1.jpeg');
    }
    public function additionalImageUrl()
    {
        if (!is_null($this->additional_photo)) {
            return asset('storage/photo/' . $this->additional_photo);
        }
        return asset('themes/front/img/featured-pic-2.jpeg');
    }
    public function scopeStandardRequest($query)
    {
        return $query->with('category', 'tags')
            ->where('enable', 1)
            ->orderBy('created_at', 'desc');
    }
    protected static function booted()
    {
        static::created(function ($project) {
            self::clearBlogCache();
        });

        static::updated(function ($project) {
            self::clearBlogCache();
        });

        static::deleted(function ($project) {
            self::clearBlogCache();
        });
    }

    /**
     * input cache key to index file
     */
    public static function addCacheKeyToIndex(string $key)
    {
        $indexFile = storage_path('framework/cache/index.json');

        $index = [];
        if (File::exists($indexFile)) {
            $index = json_decode(File::get($indexFile), true) ?: [];
        }

        if (!in_array($key, $index)) {
            $index[] = $key;
            File::put($indexFile, json_encode($index));
        }
    }

    /**
     * delete all files which exist in index
     */
    public static function clearBlogCache()
    {
        $indexFile = storage_path('framework/cache/index.json');

        if (!File::exists($indexFile)) {
            return;
        }

        $index = json_decode(File::get($indexFile), true) ?: [];

        foreach ($index as $key) {
            Cache::forget($key);
        }

        // Reset index
        File::put($indexFile, json_encode([]));
    }
    public static function clearBlogCacheForProject($rojectId)
    {
        $indexFile = storage_path('framework/cache/index.json');

        if (!File::exists($indexFile)) {
            return;
        }

        $index = json_decode(File::get($indexFile), true) ?: [];
        $updatedIndex = [];

        foreach ($index as $key) {
            if (
                str_contains($key, "singleProject_{$projectId}") ||
                str_contains($key, "blogProjects_page_") ||
                str_contains($key, "categoryProjects_page_")
            ) {
                Cache::forget($key);
            } else {
                $updatedIndex[] = $key;
            }
        }

        File::put($indexFile, json_encode($updatedIndex));
    }

}
