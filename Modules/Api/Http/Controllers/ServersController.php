<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Laka\Core\Http\Controllers\BaseController;
use Modules\Api\Repositories\ServersRepository;
use Modules\Api\Validators\ServersValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class ServersController extends BaseController
{
    protected $permissionActions = [
        'store' => 'public',
    ];

    public function __construct(ServersRepository $repository, ServersValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/configs/",
     *  description="Get all config data",
     *  operationId="GetAllConfigData",
     *  tags={"Config"},
     *  @OA\Response(response=200, description="Success", @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *          @OA\Property(
     *              property="success",
     *              description="Status",
     *              type="boolean",
     *              example="true"
     *          ),
     *          @OA\Property(
     *              property="message",
     *              description="Message",
     *              type="string",
     *              example="Success!"
     *          ),
     *          @OA\Property(
     *              property="data",
     *              description="Data",
     *              type="object",
     *              example="{...}"
     *          ),
     *      )
     *      )
     *  )
     * )
     */
    public function getAllData(Request $request)
    {
        // $data = array_only(config('api'), ['source_url', 'list_sv', 'list_type', 'list_func', 'list_util']);
        $data = $this->repository->getAllData();
        return $this->response->data($request, $data);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/servers/list-data/{name}",
     *  description="Get all server by service type",
     *  operationId="getListData",
     *  tags={"Servers"},
     * @OA\Parameter(
     *      description="Service type mysql|sql server|...",
     *      in="path",
     *      name="name",
     *      required=true,
     *      @OA\Schema(type="string"),
     *      @OA\Examples(example="array", value="mysql", summary="[mysql,sql_server]"),
     *  ),
     *  @OA\Response(response=200, description="Success", @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *          @OA\Property(
     *              property="success",
     *              description="Status",
     *              type="boolean",
     *              example="true"
     *          ),
     *          @OA\Property(
     *              property="message",
     *              description="Message",
     *              type="string",
     *              example="Success!"
     *          ),
     *          @OA\Property(
     *              property="data",
     *              description="Data",
     *              type="object",
     *              example="{...}"
     *          ),
     *      )
     *      )
     *  )
     * )
     */
    public function getListData(Request $request, $name)
    {
        // return $this->repository->getConfig('list_sv');
        $data = $this->repository->getServersByService($name);
        return $this->response->data($request, $data);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/servers/list-type",
     *  description="Get all servers",
     *  operationId="getListType",
     *  tags={"Servers"},
     *  @OA\Response(response=200, description="Success", @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *          @OA\Property(
     *              property="success",
     *              description="Status",
     *              type="boolean",
     *              example="true"
     *          ),
     *          @OA\Property(
     *              property="message",
     *              description="Message",
     *              type="string",
     *              example="Success!"
     *          ),
     *          @OA\Property(
     *              property="data",
     *              description="Data",
     *              type="object",
     *              example="{...}"
     *          ),
     *      )
     *      )
     *  )
     * )
     */
    public function getListType(Request $request)
    {
        return $this->repository->getConfig('list_type');
    }

    /**
     * @OA\Post(
     *  path="/api/v1/servers/list-db",
     *  description="Get all database by server name",
     *  operationId="getListDB",
     *  tags={"Servers"},
     * @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="id",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                 example={"id": "a3fb6", "name": "Jessica Smith", "phone": 12345678}
     *             )
     *         )
     *     ),
     *  @OA\Response(response=200, description="Success", @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *          @OA\Property(
     *              property="success",
     *              description="Status",
     *              type="boolean",
     *              example="true"
     *          ),
     *          @OA\Property(
     *              property="message",
     *              description="Message",
     *              type="string",
     *              example="Success!"
     *          ),
     *          @OA\Property(
     *              property="data",
     *              description="Data",
     *              type="object",
     *              example="{...}"
     *          ),
     *      )
     *      )
     *  )
     * )
     */
    public function getListDB(Request $request)
    {
        $this->validator($request->all(), ServersValidator::RULE_LOAD);

        $data = $this->repository->getListDb($request->all());

        return $this->response->data($request, $data);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/servers/list-table",
     *  description="Get all table by database",
     *  operationId="getListTable",
     *  tags={"Servers"},
     *  @OA\Response(response=200, description="Success", @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *          @OA\Property(
     *              property="success",
     *              description="Status",
     *              type="boolean",
     *              example="true"
     *          ),
     *          @OA\Property(
     *              property="message",
     *              description="Message",
     *              type="string",
     *              example="Success!"
     *          ),
     *          @OA\Property(
     *              property="data",
     *              description="Data",
     *              type="object",
     *              example="{...}"
     *          ),
     *      )
     *      )
     *  )
     * )
     */
    public function getListTable(Request $request)
    {
        $serverInfo = $request->only(['type', 'server_type', 'server_name', 'database']);
        $data = $this->repository->getListTable($serverInfo);

        return $this->response->data($request, $data);
    }

    public function getListService(Request $request)
    {
        $data = $this->repository->getListService();

        return $this->response->data($request, $data);
    }

    public function execActionService(Request $request)
    {
        $this->validator($request->all(), ServersValidator::RULE_SERVICE);

        $data = $this->repository->execActionService($request->get('action'), $request->get('name'));

        return $this->response->data($request, $data);
    }

    public function getStrategy(Request $request)
    {
        $srv_info = $request->headers->get('srv-info');
        parse_str($srv_info, $params);
        $data = $this->repository->getStrategyData($params, $request->all());
        return $this->response->data($request, $data);
    }
}
