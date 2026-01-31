<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\ShortUrlService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        private ShortUrlService $shortUrlService
    ) {}


    public function index()
    {
        $user = Auth::user();
    //    echo '<pre>'
    //    print_r($user);die;

        if ($user->isSuperAdmin()) {
            $companies = Company::withCount(['users', 'shortUrls'])->get();
            //    echo '<pre>'
            //    print_r($companies);die;
            $shortUrls = $this->shortUrlService->getVisibleUrls($user);
            // print_r($shortUrls);die;
            return view('dashboard.superadmin', compact('companies', 'shortUrls'));
        }

        if ($user->isAdmin()) {
            $shortUrls = $this->shortUrlService->getVisibleUrls($user);
            $teamMembers = $user->company->users;

            return view('dashboard.admin', compact('shortUrls', 'teamMembers'));
        }

        $shortUrls = $this->shortUrlService->getVisibleUrls($user);
        return view('dashboard.member', compact('shortUrls'));
    }
}
