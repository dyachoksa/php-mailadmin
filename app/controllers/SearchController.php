<?php

class SearchController extends BaseController {

    /**
     * Search and results page
     */
    public function search() {
        $mailboxes = null;
        $q = null;

        if (Input::has('q')) {
            $q = Input::get('q');
            $mailboxes = Mailbox::where('email', 'LIKE', "%{$q}%")->get();
        }

        return View::make('search', compact('mailboxes', 'q'));
    }

}