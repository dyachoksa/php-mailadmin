<?php

namespace App\Models;

use Eloquent;
use Hash;
use Illuminate\Database\Query\Builder;

/**
 * Mail users
 *
 * @property integer $id
 * @property integer $domain_id
 * @property string $email
 * @property string $password
 * @property boolean $active
 * @property string $last_login
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Domain $domain
 * @method static Builder|Mailbox whereId($value)
 * @method static Builder|Mailbox whereDomainId($value)
 * @method static Builder|Mailbox whereEmail($value)
 * @method static Builder|Mailbox wherePassword($value)
 * @method static Builder|Mailbox whereActive($value)
 * @method static Builder|Mailbox whereCreatedAt($value)
 * @method static Builder|Mailbox whereUpdatedAt($value)
 * @method static Builder|Mailbox whereLastLogin($value)
 */
class Mailbox extends Eloquent
{
    /**
     * The attributes that aren't mass assignable.
     * 
     * @var array
     */
    protected $guarded = ['id'];

    protected $dates = ['last_login'];

    /**
     * Get associated domain
     */
    public function domain()
    {
        return $this->belongsTo('App\Models\Domain');
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        } else {
            unset($this->attributes['password']);
        }
    }
}
