<?php

namespace App\Http\Controllers;

use App\Http\Requests\AliasRequest;
use App\Models\Alias;
use Response;

class AliasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // todo: get pagination size from config
        $aliases = Alias::with('domain')->orderBy('source', 'asc')->paginate(25);

        return view('aliases.index', compact('aliases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('aliases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AliasRequest $request
     * @return Response
     */
    public function store(AliasRequest $request)
    {
        Alias::create($request->all());

        // todo: redirect to 'show' page
        return redirect()->route('aliases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $alias = Alias::findOrFail($id);

        return view('aliases.show', compact('alias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $alias = Alias::findOrFail($id);

        return view('aliases.edit', compact('alias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AliasRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(AliasRequest $request, $id)
    {
        $alias = Alias::findOrFail($id);

        $alias->update($request->all());

        return redirect()->route('aliases.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Alias::destroy($id);

        return redirect()->route('aliases.index');
    }
}
