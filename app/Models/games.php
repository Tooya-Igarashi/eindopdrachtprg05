<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class games extends Model
{
    //

    protected $fillable = [
        'name',
        'genre_id',
        'description',
        'trophies',
        'time',
        'difficulty',
        'validation_check',
    ];

    public function genre(): BelongsTo
    {
        return $this->belongsTo(genres::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comments::class, 'game_id');
    }
}
//$games = new games();
//$games->name = 'The Legend of Zelda: Breath of the Wild';
//$games->genre = 'Action-adventure';
