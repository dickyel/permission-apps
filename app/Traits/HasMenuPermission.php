<?php

namespace App\Traits;


use App\Models\Permission;
use App\Models\Konfigurasi\Menu;

trait HasMenuPermission
{

    public function attachMenupermission(Menu $menu, array | null $permissions, array | null $roles )
    {
        if(!is_array($permissions))
        {
            $permissions = ['create', 'read', 'update', 'delete'];
        }

        foreach($permissions as $item){
            $permission = Permission::create([
                'name' => $item. " {$menu->url}"
            ]);

            $permission->menus()->attach($menu);
            
            if($roles)
            {
                $permission->assignRole($roles);
            }
        }
    }
}