<?php

class DomainsController extends \BaseController {

    public function __construct() {
        parent::__construct();

        $this->beforeFilter('csrf', array('on' => 'post'));
    }

	/**
	 * Display a listing of domains
	 *
	 * @return Response
	 */
	public function index() {
        $paginate_by = Config::get('mailadmin.paginate_by', 25);

		$domains = Domain::paginate($paginate_by);

		return View::make('domains.index', compact('domains'));
	}

	/**
	 * Show the form for creating a new domain
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('domains.create');
	}

	/**
	 * Store a newly created domain in storage.
	 *
	 * @return Response
	 */
	public function store() {
        $rules = Domain::$rules;
        $rules['fqdn'] = array_merge(Domain::$rules['fqdn'], ["unique:domains,fqdn"]);

		$validator = Validator::make($data = Input::all(), $rules, Domain::$messages);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Domain::create($data);

        $msg = Lang::get('mailadmin.domain_success_created', ['fqdn' => $data['fqdn']]);
        Session::flash('success_message', $msg);

		return Redirect::route('domains.index');
	}

	/**
	 * Display the specified domain.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function show($id) {
        /** @var $domain \Domain */
        $domain = Domain::findOrFail($id);

        $mailboxes = $domain->mailboxes()->orderBy('created_at', 'desc')->take(10)->get();

        $aliases = $domain->aliases()->orderBy('created_at', 'desc')->take(10)->get();

        return View::make('domains.show', compact('domain', 'mailboxes', 'aliases'));
    }

    /**
     * Display mailboxes of the specified domain.
     *
     * @param int $id
     * @return Response
     */
    public function showMailboxes($id) {
        /** @var $domain \Domain */
        $domain = Domain::findOrFail($id);

        $paginate_by = Config::get('mailadmin.paginate_by', 25);

        $mailboxes = $domain->mailboxes()->paginate($paginate_by);

        return View::make('domains.mailboxes', compact('domain', 'mailboxes'));
    }

    /**
     * Display aliases of the specified domain.
     *
     * @param int $id
     * @return Response
     */
    public function showAliases($id) {
        /** @var $domain \Domain */
        $domain = Domain::findOrFail($id);

        $paginate_by = Config::get('mailadmin.paginate_by', 25);

        $aliases = $domain->aliases()->paginate($paginate_by);

        return View::make('domains.aliases', compact('domain', 'aliases'));
    }

    /**
	 * Show the form for editing the specified domain.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($id) {
        $domain = Domain::find($id);

        return View::make('domains.edit', compact('domain'));
    }

    /**
	 * Update the specified domain in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$domain = Domain::findOrFail($id);

        $rules = Domain::$rules;
        $rules['fqdn'] = array_merge(Domain::$rules['fqdn'], ["unique:domains,fqdn,{$id}"]);
		$validator = Validator::make($data = Input::all(), $rules, Domain::$messages);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$domain->update($data);

        $msg = Lang::get('mailadmin.domain_success_updated', ['fqdn' => $data['fqdn']]);
        Session::flash('success_message', $msg);

		return Redirect::route('domains.index');
	}

	/**
	 * Remove the specified domain from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id) {
        Domain::destroy($id);

        return Redirect::route('domains.index');
    }

    /**
     * Shows confirmation question before deleting
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function destroy_question($id) {
        $domain = Domain::findOrFail($id);

        return View::make('domains.delete', compact('domain'));
    }
}
