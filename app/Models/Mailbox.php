<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mailbox whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mailbox whereDomainId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mailbox whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mailbox wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mailbox whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mailbox whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mailbox whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mailbox whereLastLogin($value)
 */
class Mailbox extends Model
{
    /**
     * The attributes that aren't mass assignable.
     * 
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get associated domain
     */
    public function domain()
    {
        return $this->belongsTo('App\Models\Domain');
    }
}
