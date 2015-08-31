<?php

use App\Models\Alias;
use App\Models\Domain;
use App\Models\Mailbox;

Breadcrumbs::register('dashboard', function($breadcrumbs) {
    $breadcrumbs->push(trans('pages.dashboard.title'), route('dashboard'));
});

// Aliases
Breadcrumbs::register('aliases.index', function($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('pages.aliases.title'), route('aliases.index'));
});

Breadcrumbs::register('aliases.create', function($breadcrumbs) {
    $breadcrumbs->parent('aliases.index');
    $breadcrumbs->push(trans('pages.aliases.create.title'), route('aliases.create'));
});

Breadcrumbs::register('aliases.show', function($breadcrumbs, $id) {
    $alias = Alias::findOrFail($id);
    $breadcrumbs->parent('aliases.index');
    $breadcrumbs->push($alias->source, route('aliases.show', $id));
});

Breadcrumbs::register('aliases.edit', function($breadcrumbs, $id) {
    $breadcrumbs->parent('aliases.show', $id);
    $breadcrumbs->push(trans('pages.aliases.edit.title'), route('aliases.edit', $id));
});

// Domains
Breadcrumbs::register('domains.index', function($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('pages.domains.title'), route('domains.index'));
});

Breadcrumbs::register('domains.create', function($breadcrumbs) {
    $breadcrumbs->parent('domains.index');
    $breadcrumbs->push(trans('pages.domains.create.title'), route('domains.create'));
});

Breadcrumbs::register('domains.show', function($breadcrumbs, $id) {
    $domain = Domain::findOrFail($id);
    $breadcrumbs->parent('domains.index');
    $breadcrumbs->push($domain->fqdn, route('domains.show', $id));
});

Breadcrumbs::register('domains.edit', function($breadcrumbs, $id) {
    $breadcrumbs->parent('domains.show', $id);
    $breadcrumbs->push(trans('pages.domains.edit.title'), route('domains.edit', $id));
});

// Mailboxes
Breadcrumbs::register('mailboxes.index', function($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('pages.mailboxes.title'), route('mailboxes.index'));
});

Breadcrumbs::register('mailboxes.create', function($breadcrumbs) {
    $breadcrumbs->parent('mailboxes.index');
    $breadcrumbs->push(trans('pages.mailboxes.create.title'), route('mailboxes.create'));
});

Breadcrumbs::register('mailboxes.show', function($breadcrumbs, $id) {
    $mailbox = Mailbox::findOrFail($id);
    $breadcrumbs->parent('mailboxes.index');
    $breadcrumbs->push($mailbox->email, route('mailboxes.show', $id));
});

Breadcrumbs::register('mailboxes.edit', function($breadcrumbs, $id) {
    $breadcrumbs->parent('mailboxes.show', $id);
    $breadcrumbs->push(trans('pages.mailboxes.edit.title'), route('mailboxes.edit', $id));
});
