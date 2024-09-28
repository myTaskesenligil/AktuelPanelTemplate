<?php

namespace Database\Seeders;

use App\Models\AuthGroupModules;
use App\Models\AuthGroups;
use App\Models\AuthGroupUsers;
use App\Models\AuthModules;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Modül yönetimi modülünü oluşturuyoruz
        $modules = [
            [
                'amName' => 'Yönetici İşlemleri',
                'amSlug' => null,
                'amIcon' => 'gear',
                'amParentMenuId' => 0,
                'amStatus' => 1,
                'amShowMenu' => 1,
                'amOrder' => 999,
            ],
            [
                'amName' => 'Modül Yönetimi',
                'amSlug' => 'module-settings',
                'amIcon' => null,
                'amParentMenuId' => 1,
                'amStatus' => 1,
                'amShowMenu' => 1,
                'amOrder' => null,
            ],
        ];
        foreach ($modules as $module) {
            AuthModules::create($module);
        }

        // Grupları oluşturuyoruz
        $groups = [
            [
                'agName' => 'Süper Admin',
                'agDesc' => 'Sadece yazılım geliştiricilerin yer aldığı en yetkili grup.',
            ],[
                'agName' => 'Yönetici',
                'agDesc' => 'Sistem kullanıcıları içinde yetkili grup',
            ],[
                'agName' => 'Personel',
                'agDesc' => 'Çalışanların yer aldığı grup',
            ],
        ];
        foreach ($groups as $group) {
            AuthGroups::create($group);
        }

        // Kullanıcıları gruplarla ilişkilendiriyoruz
        $userGroups = [
            [
                'aguUserId' => 1,
                'aguGroupId' => 1,
            ],
        ];
        foreach ($userGroups as $userGroup) {
            AuthGroupUsers::create($userGroup);
        }

        // Modülleri gruplarla ilişkilendiriyoruz
        $groupModules = [
            [
                'agmModuleId' => 2,
                'agmGroupId' => 1,
            ],
        ];
        foreach ($groupModules as $groupModule) {
            AuthGroupModules::create($groupModule);
        }
    }
}
