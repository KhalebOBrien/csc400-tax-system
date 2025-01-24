<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Number;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'last_name' => ['required', 'string', 'max:255'],
            'other_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_no' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:15'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user =  User::create([
            'last_name' => $input['last_name'],
            'other_name' => $input['other_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone_no' => $input['phone_no'],
            'address' => $input['address'],
            'status' => 'active',
            'tin' => Number::random(10)
        ]);

        $user->forceFill([
            'profile_photo_path' => 'profile-photos/default.png',
            'email_verified_at' => now(),
        ])->save();

        return $user;
    }
}
