<?php

namespace App\Models;

use App\Models\User;
use App\Enum\TaskEnum;
use App\Models\Courrier;
use App\Helper\DateFormat;
use App\Models\Imputation;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int|null $courrier_id
 * @property string $nom
 * @property string $description
 * @property string $type
 * @property TaskEnum|null $etat
 * @property string|null $debut
 * @property string|null $fin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\TaskFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCourrierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Task withoutTrashed()
 * @property-read string $debut_format
 * @property-read string $fin_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @mixin \Eloquent
 */
class Task extends Model
{
    use HasFactory, DateFormat;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'courrier_id',
        'createur_id',
        'imputation_id',
        'reference',
        'description',
        'nom',
        'type',
        'debut',
        'fin',
        'etat',
        'date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'etat' => TaskEnum::class,
        'debut' => 'datetime',
        'fin' => 'datetime',
    ];

    public function getDebutFormatAttribute(): string
    {
        return Carbon::parse($this->debut)->format('d/m/Y H:i');
    }

    public function getFinFormatAttribute(): string
    {
        return Carbon::parse($this->fin)->format('d/m/Y H:i');
    }

    /**
     * Get the user that owns the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function imputation(): BelongsTo
    {
        return $this->belongsTo(Imputation::class);
    }

    /**
     * Get the courrier that owns the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }
    /**
     * The users that belong to the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the user that owns the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'createur_id');
    }

    public function Complet()
    {
        return $this->etat == TaskEnum::TERMINE;
    }
    public function No_complet()
    {
        return $this->etat == TaskEnum::NON_TERMINE;
    }

    public function Pending()
    {
        return $this->etat == TaskEnum::EN_ATTENTE;
    }

    public function Progress()
    {
        return $this->etat == TaskEnum::EN_COURS;
    }
}
