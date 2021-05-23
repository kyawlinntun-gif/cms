<?php

namespace App;

use App\Tag;
use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = [
        'published_at'
    ];
    
    protected $fillable=[
        'title', 'description', 'content', 'image', 'published_at', 'category_id'
    ];

    /**
     * Delete storage image
     *
     * @param [type] $image
     * @return void
     */
    public function deleteImage($image)
    {
        Storage::delete($image);
    }

    /**
     * Model relation belongsTo category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Model relation belongsToMany tag
     *
     * @return void
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Model relation belongTo user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if (!$search) {
            return $query;
        }

        return $query->published()->where('title', 'like', "%{$search}%");
    }
}
