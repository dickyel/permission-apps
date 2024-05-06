<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\MenuDataTable;
use App\Http\Controllers\Controller;
use App\Models\Konfigurasi\Menu;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\MenuRepository;
use App\Http\Requests\Konfigurasi\MenuRequest;

class MenuController extends Controller
{


    public function __construct(private MenuRepository $repository)
    {
        $this->repository = $repository;

    }

    /**
     * Display a listing of the resource.
     */
    public function index(MenuDataTable $menuDataTable)
    {
        //        
        $this->authorize('read konfigurasi/menu');
        return $menuDataTable->render('pages.konfigurasi.menu');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Menu $menu)
    {
        //

        $this->authorize('create konfigurasi/menu');

        return view('pages.konfigurasi.menu-create',[
            'action' => route('konfigurasi.menu.store'),
            'data' => $menu,
            'mainMenus' => $this->repository->getMainMenus()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request, Menu $menu)
    {
        //
        $this->authorize('create konfigurasi/menu');


        $menu->fill($request->validated());
        $menu->fill([
            'orders' => $request->orders,
            'icon' => $request->icon,
            'category' => $request->category,
            'main_menu_id' => $request->main_menu,
        ]);

        $menu->save();

        foreach($request->permissions as $permission) {
            Permission::create(['name' => $permission. " { $menu->url}"])->menus()->attach($menu);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'buat data sudah tersimpan'
        ]);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $this->authorize('update konfigurasi/menu');

        return view('pages.konfigurasi.menu-edit',[
            'action' => route('konfigurasi.menu.update', $menu->id),
            'data' => $menu,
            'mainMenus' => $this->repository->getMainMenus()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {

        //

        $this->authorize('update konfigurasi/menu');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
