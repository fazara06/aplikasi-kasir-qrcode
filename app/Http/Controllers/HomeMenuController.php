<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Meja;

class HomeMenuController extends HomeBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        // Get the table if provided
        $tableName = $request->query('mejaId');
        $table = null;

        if ($tableName) {
            $table = Meja::where('unique_code', $tableName)->first();
        }

        // Get all active menu categories
        $menuCategories = Kategori::where('is_active', true)->get();

        // Filters
        $categoryId = $request->query('category', 0);
        $tipemenu   = $request->query('tipemenu', null);

        // Get filtered menus
        $menus = $this->getFilteredMenus($categoryId, $tipemenu);

        // For UI highlighting
        $currentCategoryId = $categoryId;
        $currentTipeMenu   = $tipemenu;

        return view('home.index', compact(
            'menus',
            'menuCategories',
            'table',
            'currentCategoryId',
            'currentTipeMenu'
        ));
    }

    private function getFilteredMenus($categoryId, $tipemenu)
    {
        $query = Menu::active();

        // Filter kategori
        if ($categoryId != 0) {
            $query->where('menu_category_id', $categoryId);
        }

        // Filter tipemenu
        if (!empty($tipemenu)) {
            $query->where('tipemenu', $tipemenu);
        }

        return $query->get();
    }
}
