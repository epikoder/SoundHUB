<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DEV extends Controller
{
    public function up()
    {
        $user = new User(
            [
                'name' => 'Efedua Believe',
                'email' => 'efed@gmail.com',
                'password' => bcrypt('beLL1923')
            ]
        );
        $user->save();
        $user->artists()->create([
            'name' => 'Mr Bell'
        ]);

        $user->roles()->attach(1);
    }

    public function make()
    {
        $user = User::find(1);
        $user->roles()->sync([2, 3, 4]);
        $user->admins()->create([
            'uuid' => (string) Str::uuid()
        ]);
    }
}
