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
            foreach($sections as $index => $section) {
                $sectionCode = $section['code'];
                $data = [
                    'parent_id' => null,
                    'group' => $sectionCode,
                    'route_name' => "{$sectionCode}.{$section['name']}",
                    'link' => count($section['children']) > 0 ? "#{$sectionCode}" : route("{$sectionCode}.{$section['name']}", [], false),
                    'lang' => 'menu.'.str_replace('-', '_', $sectionCode),
                    'description' => __('menu.description.'.str_replace('-', '_', $sectionCode))
                ];
                $result = Menus::findGroup($sectionCode);
                if (is_null($result)) {
                    $result = Menus::make($data);
                }
                $result->saveAsRoot();
                foreach($section['children'] as $idx => $item) {
                    $dataItem = [
                        'parent_id' => $result->id,
                        'group' => $sectionCode,
                        'route_name' => "{$sectionCode}.{$item}",
                        'link' => route("{$sectionCode}.{$item}", [], false),
                        'lang' => 'menu.'.str_replace('-', '_', $sectionCode).'_'.str_replace('-', '_', $item),
                        'description' => __('menu.description.'.str_replace('-', '_', $sectionCode))
                    ];
                    $resultItem = Menus::where([
                            'group' => $sectionCode,
                            'parent_id' => $result->id,
                            'route_name' => "{$sectionCode}.{$item}"
                        ])->first();
                    if (is_null($resultItem)) {
                        $resultItem = Menus::make($dataItem);
                    }
                    $result->appendNode($resultItem);
                }
            }
        });
    }
}
