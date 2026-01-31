<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Str;

class InvitationService
{
    public function createAdminInvitation(User $superAdmin, string $email, string $companyName): Invitation
    {
        $token = Str::random(64);
        // echo $token;

        return Invitation::create([
            'company_id' => null,
            'inviter_id' => $superAdmin->id,
            'email' => $email,
            'company_name' => $companyName,
            'role' => 'admin',
            'token' => $token,
            'expires_at' => now()->addDays(7),
        ]);
    }


    public function createMemberInvitation(User $admin, string $email): Invitation
    {
        $token = Str::random(64);

        return Invitation::create([
            'company_id' => $admin->company_id,
            'inviter_id' => $admin->id,
            'email' => $email,
            'company_name' => null,
            'role' => 'member',
            'token' => $token,
            'expires_at' => now()->addDays(7),
        ]);
    }

    public function acceptInvitation(Invitation $invitation, string $name, string $password): User
    {
        if ($invitation->company_name) {
            $company = Company::create([
                'name' => $invitation->company_name,
            ]);
            $companyId = $company->id;
        } else {
            $companyId = $invitation->company_id;
        }

        $user = User::create([
            'name' => $name,
            'email' => $invitation->email,
            'password' => $password,
            'role' => $invitation->role,
            'company_id' => $companyId,
        ]);

        $invitation->markAsAccepted();

        return $user;
    }


    public function findValidInvitation(string $token): ?Invitation
    {
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation || !$invitation->isValid()) {
            return null;
        }

        return $invitation;
    }
}
