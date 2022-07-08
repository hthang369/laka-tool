<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Laka\Core\Database\BaseSeeder;
use Modules\Common\Entities\Menus\Menus;

class MenuSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = config('menu');
        DB::transaction(function () use($sections) {
            $this->outputWithProgressBar(count(array_flatten($sections)), function($progress) use($sections) {
                $this->runMenus($progress, $sections);
            });
        });
        $this->command->newLine();
    }

    private function runMenus($progress, $sections, $parent = null)
    {
        foreach ($sections as $section) {
            $group = $section['group'];
            $data = [
                'parent_id' => $parent ? $parent->id : null,
                'group' => $group,
                'section_code' => data_get($section, 'section_code'),
                'route_name' => data_get($section, 'link', ''),
                'link' => array_key_exists('children', $section) && count($section['children']) > 0 ? "#{$group}" : route($section['link'], [], false),
                'lang' => $section['name'],
                'description' => ''
            ];
            $result = $this->saveData($data, $parent);

            $progress->advance();

            if (array_key_exists('children', $section) && is_array($section['children'])) {
                $this->runMenus($progress, $section['children'], $result);
            }
        }
    }

    private function saveData($data, $parent = null)
    {
        if (is_null($parent)) {
            $result = Menus::findGroup($data['group']);
            if (is_null($result)) {
                $result = Menus::make($data);
            }
            $result->saveAsRoot();
            return $result;
        } else {
            $resultItem = Menus::where([
                'group' => $data['group'],
                'parent_id' => $data['parent_id'],
                'route_name' => $data['route_name']
            ])->first();
            if (is_null($resultItem)) {
                $resultItem = Menus::make($data);
            }
            $parent->appendNode($resultItem);
            return $resultItem;
        }
    }
}
