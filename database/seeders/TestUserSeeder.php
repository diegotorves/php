<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Administrador de Teste', 'email' => 'admin@dcd.test', 'role' => 'admin'],
            ['name' => 'Síndico de Teste', 'email' => 'sindico@dcd.test', 'role' => 'sindico'],
            ['name' => 'Fornecedor de Teste', 'email' => 'fornecedor@dcd.test', 'role' => 'fornecedor'],
        ];

        foreach ($users as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                ['name' => $data['name'], 'password' => 'password', 'active' => true],
            );

            $role = Role::where('code', $data['role'])->firstOrFail();
            $user->roles()->sync([$role->id]);
        }
    }
}
