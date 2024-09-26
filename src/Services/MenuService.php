<?php

namespace App\Services;

use App\Models\Panel\AuthModules;
use Illuminate\Support\Facades\DB;
use App\Models\Panel\AuthGroupUsers;
use Illuminate\Http\Request;

class MenuService
{
    public static function getMenu()
    {
        $menu_prefix = 'panel';

        $control = DB::select('select am.id as parentMenuId, am.amName as parentMenuName, amm.id as menuId, amm.amName as menuName, amm.amSlug as slug
                                from auth_modules am
                                inner join auth_modules amm on amm.amParentMenuId = am.id
                                where amm.amSlug = :slug', ['slug' => 'events']);

        $allMenus = DB::select('
        select am.id as parentMenuId, am.amName as parentMenuName,  am.amSlug as parentMenuSlug, am.amIcon as parentMenuIcon,
        amm.id as menuId, amm.amName as menuName, amm.amSlug as menuSlug, amm.amIcon as menuIcon
        from auth_modules am
        inner join auth_modules amm on amm.amParentMenuId = am.id
        inner join auth_group_modules agm on agm.agmModuleId = amm.id
        inner join auth_group_users agu on agu.aguGroupId = agm.agmGroupId
        where agu.aguUserId = :userId and am.amStatus = 1 and amm.amStatus = 1 and amm.amShowMenu = 1
        order by am.amOrder, amm.amOrder, concat(am.id + if(amm.amParentMenuId, amm.amParentMenuId , 0), amm.id)
        ', ['userId' => auth()->id()]);

        $prevId = '';
        $menu_html = '';
        foreach ($allMenus as $key => $menu){
            $isParentActive = request()->is($menu_prefix . '/' . $menu->menuSlug) ? 'hover show' : null;
            $isParentShow = request()->is($menu_prefix . '/' . $menu->menuSlug) ? 'show' : null;
            $isChildActive = request()->is($menu_prefix . '/' . $menu->menuSlug) ? 'active' : null;

            if($prevId != $menu->parentMenuId){
                $prevId = $menu->parentMenuId;
                if($key != array_key_first($allMenus)){
                    $menu_html .= '    </div>'.PHP_EOL;
                    $menu_html .= '</div>'.PHP_EOL;
                }

                $menu_html .= '<div data-kt-menu-trigger="click" class="menu-item menu-accordion '. $isParentActive .'">'.PHP_EOL;
                $menu_html .= '    <span class="menu-link">'.PHP_EOL;
                $menu_html .= '        <span class="menu-icon">'.PHP_EOL;
                $menu_html .= '            <i class="bi bi-'. $menu->parentMenuIcon .' fs-2"></i>'.PHP_EOL;
                $menu_html .= '        </span>'.PHP_EOL;
                $menu_html .= '        <span class="menu-title">'. $menu->parentMenuName .'</span>'.PHP_EOL;
                $menu_html .= '        <span class="menu-arrow"></span>'.PHP_EOL;
                $menu_html .= '    </span>'.PHP_EOL;
                $menu_html .= '    <div class="menu-sub menu-sub-accordion '. $isParentShow .'">'.PHP_EOL;
            }

            $menu_html .= '        <div class="menu-item">'.PHP_EOL;
            $menu_html .= '            <a class="menu-link '. $isChildActive .'" href="'. route($menu->menuSlug) .'">'.PHP_EOL;
            $menu_html .= '                <span class="menu-bullet">'.PHP_EOL;
            $menu_html .= '                    <span class="bullet bullet-dot"></span>'.PHP_EOL;
            $menu_html .= '                </span>'.PHP_EOL;
            $menu_html .= '                <span class="menu-title">'. $menu->menuName .'</span>'.PHP_EOL;
            $menu_html .= '            </a>'.PHP_EOL;
            $menu_html .= '        </div>'.PHP_EOL;

            if($key == array_key_last($allMenus)){
                $menu_html .= '    </div>'.PHP_EOL;
                $menu_html .= '</div>'.PHP_EOL;
            }
        }

        echo $menu_html;
    }
}
