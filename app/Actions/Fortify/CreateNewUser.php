<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'firstName' => ['required', 'string', 'max:255'],
            'secondName' => ['required', 'string', 'max:255'],
            'ghostmail' => ['required', 'string',  'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'password_confirmation' => ['required'],
        ])->validate();

        return User::create([
            'firstName' => $input['firstName'],
            'secondName' => $input['secondName'],
            'ghostmail' => $input['ghostmail'].'@ghost.com',
            'password' => Hash::make($input['password']),
        ]);
    }

}
