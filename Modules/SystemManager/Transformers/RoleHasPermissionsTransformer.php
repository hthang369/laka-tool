<?php

namespace Modules\SystemManager\Transformers;

class RoleHasPermissionsTransformer
{
    protected $menuList = [
        ['sectionCode' => 'company', 'text' => 'modules.company'],
        ['sectionCode' => 'bussiness-plan', 'text' => 'modules.bussiness_plan'],
        ['sectionCode' => 'user-management', 'text' => 'modules.user_management'],
        ['sectionCode' => 'laka-user-management', 'text' => 'modules.laka_user_management'],
        ['sectionCode' => 'role-management', 'text' => 'modules.role_management'],
        ['sectionCode' => 'version', 'text' => 'modules.version'],
        ['sectionCode' => 'version-deploy', 'text' => 'modules.version_deploy'],
        ['sectionCode' => 'permission-role', 'text' => 'modules.permission_role'],
        ['sectionCode' => 'laka-log', 'text' => 'modules.laka_log'],
        ['sectionCode' => 'repair-data', 'text' => 'modules.repair_data'],
        ['sectionCode' => 'log-activity', 'text' => 'modules.log_activity'],
        ['sectionCode' => 'laka-log-s3', 'text' => 'modules.laka_log_s3'],
        ['sectionCode' => 'laka-parse-log', 'text' => 'modules.laka_parse_log'],
        ['sectionCode' => 'laka-user-company', 'text' => 'modules.laka_user_company'],
        ['sectionCode' => 'laka-user-disable', 'text' => 'modules.laka_user_disable'],
        ['sectionCode' => 'deploy-development', 'text' => 'modules.deploy_development'],
        ['sectionCode' => 'deploy-production', 'text' => 'modules.deploy_production'],
        ['sectionCode' => 'deploy-staging', 'text' => 'modules.deploy_staging'],
    ];
    protected $language = [
    ];
    protected $languageLine;

    /**
     * @param $data
     * @return array
     */
    public function transformList($data)
    {
        $actions = config('permission.actions');
        $sectionAction = config('permission.section_action');
        $customSectionActions = config('permission.custom_section_action');

        $data->transform(function($item, $key) use($data, $actions, $sectionAction, $customSectionActions) {
            $json = json_decode($item->permission);

            foreach ($actions as $action) {
                $item->{$action} = (bool)$json->$action;
            }

            $available_actions = collect($sectionAction[$item->section_code] ?? $actions);

            foreach ($customSectionActions as $section => $customActions) {
                if ($item->section_code != $section) continue;

                foreach ($customActions as $action) {
                    list($actionKey, $sectionCode) = explode('_', $action);
                    $subItem = $data->firstWhere('section_code', $sectionCode);
                    if (blank($subItem)) continue;
                    $json = json_decode($subItem->permission);
                    $item->$action = (bool)$json->{$actionKey};
                    $available_actions->push($action);
                }
            }

            $item->available_actions = $available_actions->toArray();

            $item->section_name = $this->translateSectionCode($this->menuList, $item->section_code);

            return $item;
        });

        $data = $this->filterData($data);

        return $data->toFlatTree(null);
    }

    protected function filterData($results)
    {
        $results = $results->filter(function($item) {
            return count($item->available_actions) > 0;
        });

        $query = json_decode(request()->input('query'), true);

        foreach ($query as $key => $value) {
            $key = str_replace('__like', '', $key);
            $results = $results->filter(function ($item) use ($key, $value) {
                $section_name = strtolower($item[$key]);
                return (str_contains(strtolower(vn_to_str($section_name)), $value) || str_contains($section_name, $value));
            });
        }

        return $results;
    }

    protected function translateSectionCode($menuList, $code, $parentText = '')
    {
        $translated = $this->translateLabel($code);
        if ($translated)
            return ucfirst($translated);

        foreach ($menuList as $item) {
            $label = ($parentText ? $parentText . ' > ' : '') . trans($item['text']);
            if (array_has($item, 'childrens')) {
                $newParentText = $label;
                $translated = $this->translateSectionCode($item['childrens'], $code, $newParentText);
                if ($translated != $code)
                    return ucfirst($translated);
            }

            if (!array_has($item, 'sectionCode') || !array_has($item, 'text'))
                continue;

            if ($item['sectionCode'] != $code)
                continue;

            return ucfirst($label);
        }

        return $code;
    }

    protected function translateLabel($key)
    {
        if (array_has($this->language, $key)) {
            $keys = array_get($this->language, $key, []);
            if (is_string($keys))
                $keys = [$keys];
            return implode(' ', array_map(function ($item) {
                return trans($item);
            }, $keys));
        }
        return false;
    }
}
