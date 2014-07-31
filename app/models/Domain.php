<?php

/**
 * Email domain model
 *
 * @property integer $id
 * @property string $fqdn
 * @property boolean $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\Domain whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Domain whereFqdn($value)
 * @method static \Illuminate\Database\Query\Builder|\Domain whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\Domain whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Domain whereUpdatedAt($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Mailbox[] $mailboxes
 * @property-read \Illuminate\Database\Eloquent\Collection|\Alias[] $aliases
 */
class Domain extends Eloquent {

	public static $rules = [
		'fqdn' => ['required', 'max:50']
	];

    public static $messages = [
        'required' => 'This field is required',
        'max' => 'Length must be less than :size characters',
        'fqdn.unique' => 'Domain with this name already exists',
    ];

	protected $guarded = ['id'];

    /**
     * Get associated mailboxes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Query\Builder
     */
    public function mailboxes() {
        return $this->hasMany('Mailbox');
    }

    /**
     * Get associated aliases
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Query\Builder
     */
    public function aliases() {
        return $this->hasMany('Alias');
    }
}
