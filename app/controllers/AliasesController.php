<?php

class AliasesController extends \BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
	 * Display a listing of aliases
	 *
	 * @return Response
	 */
	public function index() {
        $paginate_by = Config::get('mailadmin.paginate_by', 25);

		$aliases = Alias::paginate($paginate_by);

		return View::make('aliases.index', compact('aliases'));
	}

	/**
	 * Show the form for creating a new alias
	 *
	 * @return Response
	 */
	public function create() {
        $domains = Domain::all();

        $domains_list = [];
        foreach ($domains as $domain) {
            $domains_list[$domain->id] = $domain->fqdn;
        }

		return View::make('aliases.create', compact('domains_list'));
	}

	/**
	 * Store a newly created alias in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$validator = Validator::make($data = Input::all(), Alias::$rules);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Alias::create($data);

        Session::flash('success_message', "Alias <em>{$data['source']}</em> successfully created.");

		return Redirect::route('aliases.index');
	}

	/**
	 * Display the specified alias.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$alias = Alias::findOrFail($id);

		return View::make('aliases.show', compact('alias'));
	}

	/**
	 * Show the form for editing the specified alias.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$alias = Alias::find($id);

        $domains = Domain::all();

        $domains_list = [];
        foreach ($domains as $domain) {
            $domains_list[$domain->id] = $domain->fqdn;
        }

        return View::make('aliases.edit', compact('alias', 'domains_list'));
	}

	/**
	 * Update the specified alias in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$alias = Alias::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Alias::$rules);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$alias->update($data);

        Session::flash('success_message', "Alias <em>{$data['source']}</em> successfully updated.");

		return Redirect::route('aliases.index');
	}

	/**
	 * Remove the specified alias from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
        $alias = Alias::findOrFail($id);
        $alias_source = $alias->source;

		$alias->delete();

        Session::flash('success_message', "Alias <em>{$alias_source}</em> successfully updated.");

		return Redirect::route('aliases.index');
	}

    /**
     * Shows confirmation question before deleting
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function destroy_question($id) {
        $alias = Alias::findOrFail($id);

        return View::make('aliases.delete', compact('alias'));
    }
}
