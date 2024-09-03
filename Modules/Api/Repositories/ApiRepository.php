<?php

namespace Modules\Api\Repositories;

use Carbon\CarbonPeriod;
use Modules\Api\Entities\ApiModel;
use Modules\Api\Grids\ApiGrid;
use Laka\Core\Repositories\CoreRepository;

class ApiRepository extends CoreRepository
{
    protected $presenterClass = ApiGrid::class;

    protected $modelClass = ApiModel::class;

    protected $level = 2;
    protected $lstKeys = ['channel_1','channel_2','channel_3'];

    protected function paginateData($data = null, string $method = "paginate", int $limit = null, array $columns = [])
    {
        return config('api');
    }

    public function execCommand($command)
    {
        return shell_exec($command);
    }

    public function getPhasing($data)
    {
        $lstChannel = collect(data_get($data, 'list_channels'));
        $newData = $lstChannel->map(function($item) {
            return array_only(array_combine($this->lstKeys, $item), array_slice($this->lstKeys, 0, $this->level));
        });
        $channels = $this->groupPhasing($newData, 1);
        $itemData = $lstChannel->map(function($item) {
            return [str_slug(join('_', array_map(snake_case, array_slice($item, 0, $this->level))), '_') => 0];
        })->collapse();
        $now = today();
        $data = collect();
        $period = CarbonPeriod::create($now->startOfMonth(), '1 day', $now->clone()->endOfMonth())->toArray();
        foreach($period as $date) {
            $item = clone $itemData;
            $data->push($item->put('date', $date));
        }
        dd($data);
    }

    public function groupPhasing($data, $level)
    {
        return $data->groupBy(array_slice($this->lstKeys, $level - 1, 1))->map(function($item, $name) use($level) {
            $res = $item;
            if ($level < $this->level - 1) {
                $res = $this->groupPhasing($item, $level + 1);
            }
            $newValue = $res->first();
            if ($level === $this->level - 1) {
                data_set($newValue, 'name', data_get($newValue, head(array_slice($this->lstKeys, $level, 1))));
            }

            return [
                'name' => $name,
                'children' => $newValue
            ];
        })->values();
    }
}
