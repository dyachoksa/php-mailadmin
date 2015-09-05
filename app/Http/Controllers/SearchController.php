<?php

namespace App\Http\Controllers;

use App\Models\Mailbox;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $mailboxes = null;
        $has_results = false;

        if (!empty($q)) {
            $mailboxes = Mailbox::where('email', 'like', "%{$q}%")->latest()->take(10)->get();
            $has_results = true;
        }

        return view('search.index', compact('q', 'mailboxes', 'has_results'));
    }
}
