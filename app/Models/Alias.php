<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alias whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alias whereDomainId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alias whereSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alias whereDestination($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alias whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alias whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alias whereUpdatedAt($value)
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
