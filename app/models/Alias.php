<?php

/**
 * Alias
 *
 * @property integer $id
 * @property integer $domain_id
 * @property string $source
 * @property string $destination
 * @property boolean $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Domain $domain
 * @method static \Illuminate\Database\Query\Builder|\Alias whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Alias whereDomainId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Alias whereSource($value) 
 * @method static \Illuminate\Database\Query\Builder|\Alias whereDestination($value) 
 * @method static \Illuminate\Database\Query\Builder|\Alias whereActive($value) 
 * @method static \Illuminate\Database\Query\Builder|\Alias whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Alias whereUpdatedAt($value) 
 */
class Alias extends Eloquent {

	public static $rules = [
		'domain_id' => 'required',
        'source' => ['required', 'max:100'],
        'destination' => ['required', 'email', 'max:100'],
	];

    public static $messages = [
        'required' => 'This field is required',
        'email' => 'Please enter valid email',
        'max' => 'Length must be less than :size characters',
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
