<?php

namespace App\Actions\Fortify;

use App\Models\User;
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
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'campaign' => ['required', 'string', 'max:255'],
            'signup_reason' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user =  User::create([
            'full_name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'campaign' => $input['campaign'],
            'signup_reason' => $input['signup_reason'],
            'status' => 'active',
        ]);

        $user->forceFill([
            'profile_photo_path' => 'profile-photos/default.png',
            'email_verified_at' => now(),
        ])->save();

        return $user;
    }
}
