<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Backup
 *
 * @property int $id
 * @property int $user_id
 * @property string $nom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static \Database\Factories\BackupFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Backup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Backup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Backup query()
 * @method static \Illuminate\Database\Eloquent\Builder|Backup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backup whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backup whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Backup extends Model
{
    use HasFactory;
}
