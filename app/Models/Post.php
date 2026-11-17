<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes; 

class Post extends Model 
{ 
    use SoftDeletes;
    
    
    protected $fillable = ['title', 'slug', 'short_description', 'description', 'status', 'post_date', 'category_id', 'thumbnail'];
    // #[Fillable(['title', 'slug', 'short_description', 'description', 'status', 'post_date', 'category_id', 'thumbnail'])]

    public function scopePublished(Builder $query): Builder
   {
       return $query->where('status', 'published');
   }

   public function scopeDraft(Builder $query): Builder
   {
       return $query->where('status', 'draft');
   }

   public function images()
    {
        return $this->hasMany(PostImage::class)->orderBy('sort_order');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}


