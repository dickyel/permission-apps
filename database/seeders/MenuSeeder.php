<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Konfigurasi\Menu;
use App\Models\Permission;
use App\Traits\HasMenuPermission;

class MenuSeeder extends Seeder
{
    use HasMenuPermission;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         //master menu

        $mm  = Menu::firstOrcreate([
            'url' => 'konfigurasi'
        ],[
            'name' => 'konfigurasi',
            'category' => 'MASTER DATA',
            'icon' => 'setting'
        ]);


        $this->attachMenupermission($mm, ['read'],['ceo']);


        // submenu
        $sm = $mm->subMenus()->create([
            'name' => 'Menu',
            'url' => $mm->url. '/menu',
            'category' => $mm->category
        ]);

        $this->attachMenupermission($sm, null, ['ceo']);
    }
}
