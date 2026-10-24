<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::Create(['name'=>'userCrud']);
        Permission::Create(['name'=>'addInfoCrud']);
        Permission::Create(['name'=>'announcementCrud']);
        Permission::Create(['name'=>'eventCrud']);
        Permission::Create(['name'=>'articleCrud']);
        Permission::Create(['name'=>'articleCategoryCrud']);
        Permission::Create(['name'=>'articleOrderCrud']);
        Permission::Create(['name'=>'cartCrud']);
        Permission::Create(['name'=>'historyCrud']);
        Permission::Create(['name'=>'orderCrud']);
        Permission::Create(['name'=>'paymentCrud']);
        Permission::Create(['name'=>'permissionCrud']);
        Permission::Create(['name'=>'promotionCrud']);
        Permission::Create(['name'=>'roleCrud']);
        Permission::Create(['name'=>'supportMessageCrud']);
        Permission::Create(['name'=>'supportMessageCategoryCrud']);
    }
}
