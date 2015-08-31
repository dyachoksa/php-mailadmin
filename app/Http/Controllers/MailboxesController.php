<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailboxRequest;
use App\Models\Mailbox;
use Response;

class MailboxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // todo: get pagination size from config
        $mailboxes = Mailbox::with('domain')->orderBy('email', 'asc')->paginate(25);

        return view('mailboxes.index', compact('mailboxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('mailboxes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MailboxRequest  $request
     * @return Response
     */
    public function store(MailboxRequest $request)
    {
        Mailbox::create($request->all());

        // todo: redirect to 'show' page
        return redirect()->route('mailboxes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $mailbox = Mailbox::findOrFail($id);

        return view('mailboxes.show', compact('mailbox'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $mailbox = Mailbox::findOrFail($id);

        return view('mailboxes.edit', compact('mailbox'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MailboxRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(MailboxRequest $request, $id)
    {
        $mailbox = Mailbox::findOrFail($id);

        $mailbox->update($request->all());

        // todo: redirect to 'show' page
        return redirect()->route('mailboxes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Mailbox::destroy($id);

        return redirect()->route('mailboxes.index');
    }
}
