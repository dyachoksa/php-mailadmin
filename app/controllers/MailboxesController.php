<?php

class MailboxesController extends \BaseController {

    public function __construct() {
        parent::__construct();

        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
	 * Display a listing of mailboxes
	 *
	 * @return Response
	 */
	public function index() {
        $paginate_by = Config::get('mailadmin.paginate_by', 25);

		$mailboxes = Mailbox::paginate($paginate_by);

		return View::make('mailboxes.index', compact('mailboxes'));
	}

	/**
	 * Show the form for creating a new mailbox
	 *
	 * @return Response
	 */
	public function create() {
        $domains = Domain::all();

        $domains_list = [];
        foreach ($domains as $domain) {
            $domains_list[$domain->id] = $domain->fqdn;
        }

        return View::make('mailboxes.create', compact('domains_list'));
	}

	/**
	 * Store a newly created mailbox in storage.
	 *
	 * @return Response
	 */
	public function store() {
        $rules = Mailbox::$rules;
        $rules['email'] = array_merge(Mailbox::$rules['email'], ["unique:mailboxes,email"]);

		$validator = Validator::make($data = Input::all(), $rules, Mailbox::$messages);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $data['password'] = Hash::make($data['password']);

		Mailbox::create($data);

        $msg = Lang::get('mailadmin.mailbox_success_created', ['email' => $data['email']]);
        Session::flash('success_message', $msg);

		return Redirect::route('mailboxes.index');
	}

	/**
	 * Display the specified mailbox.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$mailbox = Mailbox::findOrFail($id);

		return View::make('mailboxes.show', compact('mailbox'));
	}

	/**
	 * Show the form for editing the specified mailbox.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$mailbox = Mailbox::find($id);

        $domains = Domain::all();

        $domains_list = [];
        foreach ($domains as $domain) {
            $domains_list[$domain->id] = $domain->fqdn;
        }

        return View::make('mailboxes.edit', compact('mailbox', 'domains_list'));
	}

	/**
	 * Update the specified mailbox in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$mailbox = Mailbox::findOrFail($id);

        $data = Input::all();

        $rules = Mailbox::$rules;
        $rules['email'] = array_merge(Mailbox::$rules['email'], ["unique:mailboxes,email,{$id}"]);

        if (empty($data['password'])) {
            unset($rules['password']);
        }

        $validator = Validator::make($data, $rules, Mailbox::$messages);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
		$mailbox->update($data);

        $msg = Lang::get('mailadmin.mailbox_success_updated', ['email' => $data['email']]);
        Session::flash('success_message', $msg);

		return Redirect::route('mailboxes.index');
	}

	/**
	 * Remove the specified mailbox from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Mailbox::destroy($id);

		return Redirect::route('mailboxes.index');
	}

    /**
     * Shows confirmation question before deleting
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function destroy_question($id) {
        $mailbox = Mailbox::findOrFail($id);

        return View::make('mailboxes.delete', compact('mailbox'));
    }
}
