<?php

/**
 * Mailbox
 *
 * @property integer $id
 * @property integer $domain_id
 * @property string $email
 * @property string $password
 * @property boolean $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Domain $domain
 * @method static \Illuminate\Database\Query\Builder|\Mailbox whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Mailbox whereDomainId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Mailbox whereEmail($value) 
 * @method static \Illuminate\Database\Query\Builder|\Mailbox wherePassword($value) 
 * @method static \Illuminate\Database\Query\Builder|\Mailbox whereActive($value) 
 * @method static \Illuminate\Database\Query\Builder|\Mailbox whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Mailbox whereUpdatedAt($value) 
 */
class Mailbox extends Eloquent {

	public static $rules = [
		'domain_id' => 'required',
        'email' => ['required', 'email'],
        'password' => ['required', 'min:6']
	];

    public static $messages = [
        'required' => 'This field is required',
        'email' => 'Please enter valid email',
        'max' => 'Length must be less than :size characters',
        'password.min' => 'Password must be at least 6 characters',
        'email.unique' => 'Mailbox with this name already exists',
    ];

    protected $guarded = ['id'];

    /**
     * Get associated domain
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function domain() {
        return $this->belongsTo('Domain');
    }
}
