<?php

namespace App\Repositories\Front;

use App\Models\Project;
use Illuminate\Support\Facades\Cache;

class ProjectRepository
{
    /**
     * index page
     */

    public function getLatestProjects()
    {
        $cacheKeyLatest = "latestProjectsSlider";
        $latestProjectsSlider = Cache::remember($cacheKeyLatest, 1200, function () {
            return Project::standardRequest()
                ->limit(12)
                ->get();
        });
        Project::addCacheKeyToIndex($cacheKeyLatest);
        return $latestProjectsSlider;
    }

    /**
     * blog pages
     */
    public function getBlogProjects()
    {
        $page = request('page', 1);
        $cacheKey = "blogProjects_page_{$page}";
        $blogProjects = Cache::remember($cacheKey, 600, function () {
            return Project::standardRequest()
                ->paginate(12);
        });
        Project::addCacheKeyToIndex($cacheKey);
        return $blogProjects;
    }

    public function getCategoryProjects($categoryId)
    {
        $page = request('page', 1);
        $cacheKey = "categoryProjects_{$categoryId}_page_{$page}";
        $categoryProjects = Cache::remember($cacheKey, 400, function () use ($categoryId) {
            return Project::with('category')
                ->where('category_id', $categoryId)
                ->where('enable', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(4);
        });
        Project::addCacheKeyToIndex($cacheKey);
        return $categoryProjects;
    }

    public function getSingleProject($id, $slug)
    {
        $cacheKey = "singleProject_{$id}";
        $singleProject = Cache::remember($cacheKey, 300, function () use ($id, $slug) {
            return Project::where('slug', $slug)
                ->where('id', $id)
                ->where('enable', 1)
                ->firstOrFail();
        });
        Project::addCacheKeyToIndex($cacheKey);
        return $singleProject;
    }
    public function incrementProjectViews($project)
    {
        $sessionKey = 'project_' . $project->id . '_viewed';
        if (!session()->has($sessionKey)) {
            $project->increment('views');
            session([$sessionKey => true]);
        }
    }

    public function getPrevProject($id, $singleProject)
    {
        $cacheKeyPrev = "prevProject_{$id}";
        $prevProject = Cache::remember($cacheKeyPrev, 300, function () use ($id, $singleProject) {
            return Project::where('id', '<', $singleProject->id)
                ->where('enable', 1)
                ->orderBy('id', 'desc')
                ->first();
        });
        Project::addCacheKeyToIndex($cacheKeyPrev);
        return $prevProject;
    }

    public function getNextProject($id, $singleProject)
    {
        $cacheKeyNext = "nextProject_{$id}";
        $nextProject = Cache::remember($cacheKeyNext, 300, function () use ($id, $singleProject) {
            return Project::where('id', '>', $singleProject->id)
                ->where('enable', 1)
                ->orderBy('id', 'asc')
                ->first();
        });
        Project::addCacheKeyToIndex($cacheKeyNext);
        return $nextProject;
    }
    public function getTagProjects($id, $tag)
    {
        $page = request('page', 1);
        $cacheKey = "tagProjects_{$id}_page_{$page}";
        $tagProjects = Cache::remember($cacheKey, 400, function () use ($tag) {
            return $tag->projects()
                ->with('category')
                ->where('enable', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(4);
        });
        Project::addCacheKeyToIndex($cacheKey);
        return $tagProjects;
    }
    public function getProjectsResult($query)
    {
        $page = request('page', 1);

        $cacheKey = "searchResults_" . md5($query) . "_page_{$page}";
        $results = Cache::remember($cacheKey, 300, function () use ($query) {
            return Project::where('heading', 'like', '%' . $query . '%')
                ->orWhere('preheading', 'like', '%' . $query . '%')
                ->orWhere('text', 'like', '%' . $query . '%')
                ->paginate(4);
        });
        Project::addCacheKeyToIndex($cacheKey);
        return $results;
    }
}
