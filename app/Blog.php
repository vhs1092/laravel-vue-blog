<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use Favouritable, Filter;

    protected $table = 'blogs';

    protected $fillable = ['user_id', 'title', 'slug', 'body'];

    protected $casts = ['body' => 'json'];

    protected $with = ['author'];

    protected $appends = ['favourite_url', 'is_favourited', 'favourites_count'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latestBlogs', function ($builder) {
            $builder->orderBy('id', 'desc');
        });

        static::addGlobalScope('commentsCount', function ($builder) {
            $builder->withCount('comments');
        });

        static::creating(function ($model) {
            $model->slug = $model->title;
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function setBodyAttribute($value)
    {
        if ($value) {
            $this->attributes['body'] = json_encode(json_decode($value, true));
        }
    }

    public function scopeHasSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeForAuthor($query, string $nickname)
    {
        return $query->whereHas('author', function ($q) use ($nickname) {
            $q->where('nickname', $nickname);
        });
    }

    public function scopeSaveComment($query, $body)
    {
        return $this->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $body,
        ]);
    }

    public function getFavouriteUrlAttribute()
    {
        return "/v1/blogs/{$this->slug}/favourites";
    }
}
