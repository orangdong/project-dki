<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\staffCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'staff_code' => ['required', 'string', new staffCode],
            'password' => $this->passwordRules(),
            'nip' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:255'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'nip' => $input['nip'],
            'jabatan' => $input['jabatan'],
            'unit' => $input['unit'],
        ]);
    }
}
