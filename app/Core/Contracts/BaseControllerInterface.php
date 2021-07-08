<?php

namespace App\Core\Contracts;

use Illuminate\Http\Request;

/**
 * Interface BaseControllerInterface
 * @package App\Contracts
 */
interface BaseControllerInterface
{
    /**
     * @param $data
     * @param $rules
     * @return mixed
     */
    public function validator($data, $rules);

    /**
     * @param $id
     * @return mixed
     */
    public function view($id);

    /**
     * @return mixed
     */
    public function index();

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request);

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id);

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);
}
