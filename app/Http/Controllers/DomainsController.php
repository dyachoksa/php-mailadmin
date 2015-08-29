<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomainRequest;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class DomainsController
 * @package App\Http\Controllers
 */
class DomainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $domains = Domain::orderBy('fqdn', 'asc')->get();

        return view('domains.index')
            ->with('domains', $domains);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('domains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DomainRequest $request
     * @return Response
     */
    public function store(DomainRequest $request)
    {
        Domain::create($request->all());

        return redirect()->route('domains.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $domain = Domain::findOrFail($id);

        return view('domains.show', compact('domain'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $domain = Domain::findOrFail($id);

        return view('domains.edit', compact('domain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DomainRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(DomainRequest $request, $id)
    {
        $domain = Domain::findOrFail($id);

        $domain->update($request->all());

        return redirect()->route('domains.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Domain::destroy($id);

        return redirect()->route('domains.index');
    }
}
