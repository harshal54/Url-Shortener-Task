<?php

namespace App\Http\Controllers;

use App\Services\InvitationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function __construct(
        private InvitationService $invitationService
    ) {}

    public function create()
    {
        $user = Auth::user();
        // echo '<pre>';
        // print_r($user);
        // die;
        return view('invitations.create', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

       if ($user->isSuperAdmin()) {

            $validated = $request->validate([
                'email'        => ['required', 'email', 'unique:users,email'],
                'company_name' => ['required', 'string', 'max:255'],
            ]);

            $invitation = $this->invitationService
                    ->createAdminInvitation($user, $validated['email'], $validated['company_name']);

            $inviteUrl = route('invitations.accept', $invitation->token);

            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    "Invitation sent to {$validated['email']}. Invitation link: {$inviteUrl}"
                );
        }

        if ($user->isAdmin()) {
            $validated = $request->validate([
                'email' => ['required', 'email', 'unique:users,email'],
            ]);

            $invitation = $this->invitationService->createMemberInvitation($user,$validated['email']);
            $inviteUrl = route('invitations.accept', $invitation->token);
            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    "Invitation sent to {$validated['email']}. Invitation link: {$inviteUrl}"
                );
        }
        abort(403, 'Unauthorized action.');
    }

    public function showAcceptForm(string $token)
    {
        $invitation = $this->invitationService->findValidInvitation($token);
         // echo '<pre>';
        // print_r($invitation);
        // die;
        if (!$invitation) {
            return redirect()->route('login')->with('error', 'This invitation is invalid or has expired.');
        }

        return view('invitations.accept', compact('invitation'));
    }


    public function accept(Request $request, string $token)
    {
        $invitation = $this->invitationService->findValidInvitation($token);

        // print_r($invitation);exit;
        if (!$invitation) {
            return redirect()
                ->route('login')
                ->with('error', 'This invitation is invalid or has expired.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $this->invitationService->acceptInvitation($invitation,$validated['name'],$validated['password']);

        Auth::login($user);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Welcome! Your account has been created successfully.');
    }
}
