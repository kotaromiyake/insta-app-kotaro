<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private $user;

    public function __construct(User $user)
    {
      $this->user = $user;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->user->name = 'John Doe';
        $this->user->email = 'johndoe@email.com';
        $this->user->password = Hash::make('john12345');
        $this->user->role_id = User::USER_ROLE_ID;
        $this->user->save();

    }
}
