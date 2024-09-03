<?php

namespace Modules\Home\Http\Controllers\Versions;

use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Laka\Core\Http\Controllers\BaseController;
use Illuminate\Support\Facades\View;
use Laka\Core\Facades\Common;
use Laka\Core\Responses\BaseResponse;
use Modules\Home\Repositories\Versions\VersionRepository;
use Modules\Home\Validators\Versions\VersionValidator;

/**
 * Class VersionController
 * @package Modules\Home\Http\Controllers\Versions
 * @property VersionRepository versionRepository
 */
class VersionController extends BaseController
{
    protected $listViewName = [
        'index'     => 'home::version.list',
        'viewData'  => 'home::version.data'
    ];

    public function __construct(VersionRepository $repository, VersionValidator $validator, BaseResponse $response) {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('version.page_title'));
        View::share('headerPage', 'version.page_header');
    }

    public function crawData(Request $request)
    {
        // $response = Http::get('https://truyen3.one/truyen-con-re-quyen-quy-truong-thac-lam-ngu-lam-full/');

        // dd($response->body());

        $url = 'https://truyen3.one/truyen-con-re-quyen-quy-truong-thac-lam-ngu-lam-full/chuong-%d.html/';


        $min = 2310;
        $max = 2348;

        // for ($i = $min; $i <= $max; $i++) {
            $client = new Client();
            $crawler = $client->request('GET', sprintf($url, 2348));

            $content = $crawler->filter('.chapter-content')->html();

            Storage::disk('public')->append('data.txt', '<div class="chapter-content">'.$content.'</div>');
        // }
    }

    public function viewData(Request $request)
    {
        $data = Storage::disk('public')->get('data.txt');

        return $this->response->data($request, compact('data'), $this->getViewName(__FUNCTION__));
    }
}
