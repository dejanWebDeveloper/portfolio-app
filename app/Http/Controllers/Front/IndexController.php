<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Front\ProjectRepository;

class IndexController extends Controller
{
    protected $projects;

    public function __construct(ProjectRepository $projects)
    {
        $this->projects = $projects;
    }

    public function index()
    {
        $latestProjectsSlider = $this->projects->getLatestProjects();

        return view('front.index_page.index', compact(
          'latestProjectsSlider'
        ));
    }
    public function getLinksPage()
    {
        return view('front.links_page.links_page');
    }
}
