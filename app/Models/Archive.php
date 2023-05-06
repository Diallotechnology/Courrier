<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Archive
 *
 * @property int $id
 * @property int $courrier_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ArchiveFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Archive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Archive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Archive query()
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereCourrierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Archive extends Model
{
    use HasFactory;
}
