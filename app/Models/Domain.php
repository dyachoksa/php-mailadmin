<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Mail domains
 *
 * @property integer $id
 * @property string $fqdn
 * @property boolean $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Mailbox[] $mailboxes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Alias[] $aliases
 * @method static Builder|Domain whereId($value)
 * @method static Builder|Domain whereFqdn($value)
 * @method static Builder|Domain whereActive($value)
 * @method static Builder|Domain whereCreatedAt($value)
 * @method static Builder|Domain whereUpdatedAt($value)
 */
class Domain extends Model
{
    /**
     * The attributes that aren't mass assignable.
     * 
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get domain mailboxes
     */
    public function mailboxes()
    {
        return $this->hasMany('App\Models\Mailbox');
    }

    public function aliases()
    {
        return $this->hasMany('App\Models\Alias');
    }
}
