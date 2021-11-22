<?php

namespace App\Http\Controllers\LogRelease;

use App\Http\Controllers\Controller;
use App\Models\DeployServer;
use App\Services\LogRelease\LogReleaseService;
use Illuminate\Http\Request;

class LogReleaseController extends Controller
{

    private $logReleaseService;

    public function __construct(LogReleaseService $logReleaseService)
    {
        parent::__construct();
        $this->logReleaseService = $logReleaseService;
    }

    public function getLogReleaseList(Request $request)
    {
        $deploy_server = DeployServer::get();

        $perPage = $request->input('perPage');
        if ($perPage == null) {
            $perPage = 5;
        }
        $logReleaseList = $this->logReleaseService->getLogReleaseList()->paginate($perPage);
        $currentRoute = $request->route()->getName();

        return view('logs-release.list', compact('logReleaseList', 'deploy_server', 'currentRoute', 'perPage'));
    }

    public function getLogReleaseByUserId($user_id, Request $request)
    {

        $deploy_server = DeployServer::get();
        $perPage = $request->input('perPage');
        $currentRoute = $request->route()->getName();

        if ($perPage == null) {
            $perPage = 5;
        }
        $logReleaseList = $this->logReleaseService->getLogReleaseByUserId($user_id)->paginate($perPage);
        return view('logs-release.list', compact('logReleaseList', 'user_id', 'deploy_server', 'currentRoute', 'perPage', 'user_id'));
    }

    public function searchLogRelease(Request $request)
    {
        $deploy_server = DeployServer::get();

        $currentRoute = $request->route()->getName();

        $perPage = $request->input('perPage');
        if ($perPage == null) {
            $perPage = 5;
        }
        $logReleaseList = $this->logReleaseService->searchLogRelease($request)->paginate($perPage);

        $user_id = $request->input('user_id');
        $user_name = $request->input('user_name');
        $redmine_id = $request->input('redmine_id');
        $version = $request->input('version');
        $release_type = $request->input('release_type');

        $environment = $request->input('environment');
        $deploy_server_id = $request->input('deploy_server_id');
        return view('logs-release.list', compact('logReleaseList', 'deploy_server', 'deploy_server_id', 'user_id', 'user_name', 'redmine_id', 'version', 'release_type', 'environment', 'currentRoute', 'perPage', 'user_id'));
    }
}
