<?php

namespace App\Repositories\Front;

use App\Models\Project;
use Illuminate\Support\Facades\Cache;

class ProjectRepository
{
    /**
     * index page
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
