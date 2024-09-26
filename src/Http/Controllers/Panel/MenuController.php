<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function getMenu(Request $request)
    {
        $userId = auth()->id();
        $menu = MenuService::getMenu($userId);
        return $menu;
    }
}
