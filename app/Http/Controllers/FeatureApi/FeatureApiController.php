<?php

namespace App\Http\Controllers\FeatureApi;

use App\Http\Controllers\Controller;
use App\Services\FeatureApi\FeatureApiService;

class FeatureApiController extends Controller
{

    private $featureApiService;

    /**
     * FeatureApiController constructor.
     * @param FeatureApiService $featureApiService
     */
    public function __construct(FeatureApiService $featureApiService)
    {
        $this->featureApiService = $featureApiService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->featureApiService->list();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        return $this->featureApiService->delete($id);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAllRoutesToDB()
    {
        return $this->featureApiService->saveAllRoutesToDB();
    }
}
