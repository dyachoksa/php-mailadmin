<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Alias;
use App\Models\Domain;
use App\Models\Mailbox;

class DashboardController extends Controller
{
    public function index()
    {
        $latest_domains = Domain::latest()->take(5)->get();
        $latest_aliases = Alias::with('domain')->latest()->take(5)->get();
        $latest_mailboxes = Mailbox::with('domain')->latest()->take(5)->get();

        $total_domains = Domain::count();
        $total_active_domains = Domain::whereActive(true)->count();

        $total_aliases = Alias::count();
        $total_active_aliases = Alias::whereActive(true)->count();

        $total_mailboxes = Mailbox::count();
        $total_active_mailboxes = Mailbox::whereActive(true)->count();

        return view('dashboard.index', compact(
            'latest_domains',
            'total_domains',
            'total_active_domains',

            'latest_aliases',
            'total_aliases',
            'total_active_aliases',

            'latest_mailboxes',
            'total_mailboxes',
            'total_active_mailboxes'
        ));
    }
}
