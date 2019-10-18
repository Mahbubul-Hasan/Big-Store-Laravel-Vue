<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SubImage
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $sub_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubImage whereSubImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SubImage extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
