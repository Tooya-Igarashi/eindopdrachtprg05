<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class genres extends Model
{
    //
    public function games(): HasMany|genres
    {
        return $this->hasMany(games::class);
    }
}
