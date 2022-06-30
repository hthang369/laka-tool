<?php

namespace Database\Seeders;

use App\Models\Menus\Menus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
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
            $this->runMenus($sections);
        });
    }

    private function runMenus($sections, $parent = null)
    {
        foreach($sections as $section) {
            $group = $section['group'];
            $data = [
                'parent_id' => $parent ? $parent->id : null,
                'group' => $group,
                'route_name' => data_get($section, 'link', ''),
                'link' => array_key_exists('children', $section) && count($section['children']) > 0 ? "#{$group}" : route($section['link'], [], false),
                'lang' => $section['name'],
                'description' => ''
            ];
            $result = $this->saveData($data, $parent);
            if (array_key_exists('children', $section) && is_array($section['children'])) {
                $this->runMenus($section['children'], $result);
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
