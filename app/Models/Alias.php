<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Mail aliases
 *
 * @property integer $id
 * @property integer $domain_id
 * @property string $source
 * @property string $destination
 * @property boolean $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property-read \App\Models\Domain $domain
 * 
 * @method static Builder|Alias whereId($value)
 * @method static Builder|Alias whereDomainId($value)
 * @method static Builder|Alias whereSource($value)
 * @method static Builder|Alias whereDestination($value)
 * @method static Builder|Alias whereActive($value)
 * @method static Builder|Alias whereCreatedAt($value)
 * @method static Builder|Alias whereUpdatedAt($value)
 */
class Alias extends Model
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
