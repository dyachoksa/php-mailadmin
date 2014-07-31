<?php

class HomeController extends BaseController {

    /**
     * PHPMailAdmin Index page
     */
    public function index() {
        $domains = Domain::orderBy('created_at', 'desc')->take(5)->get();

        $mailboxes = Mailbox::orderBy('created_at', 'desc')->take(10)->get();

        $aliases = Alias::orderBy('created_at', 'desc')->take(10)->get();

        return View::make('index', compact('domains', 'mailboxes', 'aliases'));
    }
}
