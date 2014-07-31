<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);

Route::resource('domains', 'DomainsController');
Route::get('domains/{id}/delete', ['as' => 'domains.delete', 'uses' => 'DomainsController@destroy_question']);
Route::get('domains/{id}/mailboxes', ['as' => 'domains.mailboxes', 'uses' => 'DomainsController@showMailboxes']);
Route::get('domains/{id}/aliases', ['as' => 'domains.aliases', 'uses' => 'DomainsController@showAliases']);

Route::resource('mailboxes', 'MailboxesController');
Route::get('mailboxes/{id}/delete', ['as' => 'mailboxes.delete', 'uses' => 'MailboxesController@destroy_question']);

Route::resource('aliases', 'AliasesController');
Route::get('aliases/{id}/delete', ['as' => 'aliases.delete', 'uses' => 'AliasesController@destroy_question']);
