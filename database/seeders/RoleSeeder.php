<?php
namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;
class RoleSeeder extends Seeder { public function run(): void { foreach ([['name'=>'Administrador','code'=>'admin'],['name'=>'Síndico','code'=>'sindico'],['name'=>'Fornecedor','code'=>'fornecedor']] as $role) Role::updateOrCreate(['code'=>$role['code']], $role); } }
