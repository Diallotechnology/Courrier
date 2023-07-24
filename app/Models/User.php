<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\RoleEnum;
use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property int $departement_id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $photo
 * @property string $poste
 * @property RoleEnum $role
 * @property int $etat
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Annotation> $annotations
 * @property-read int|null $annotations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read int|null $courriers_count
 * @property-read Departement $departement
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read int|null $departs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Interne> $internes
 * @property-read int|null $internes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Journal> $journals
 * @property-read int|null $journals_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read int|null $rapports_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 *
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDepartementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePoste($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Annotation> $annotations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Imputation> $imputations
 * @property-read int|null $imputations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Interne> $internes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Journal> $journals
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property string $userable_type
 * @property int $userable_id
 * @property int $change_password
 * @property int $two_factor_enabled
 * @property int|null $two_factor_code
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Annotation> $annotations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $createurs
 * @property-read int|null $createurs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Interne> $destinataires
 * @property-read int|null $destinataires_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read int|null $documents_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Interne> $expediteurs
 * @property-read int|null $expediteurs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, History> $histories
 * @property-read int|null $histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Imputation> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Interne> $internes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Journal> $journals
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Reponse> $reponses
 * @property-read int|null $reponses_count
 * @property-read \Creagia\LaravelSignPad\Signature|null $signature
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $userable
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User whereChangePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserableType($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Annotation> $annotations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $createurs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Interne> $destinataires
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Interne> $expediteurs
 * @property-read string $date_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Imputation> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Journal> $journals
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Reponse> $reponses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 *
 * @method static Builder|User byStructure()
 * @method static Builder|User structureUser()
 * @method static Builder|User userDepartement()
 * @method static Builder|User userSubDepartement()
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Annotation> $annotations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $createurs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Departement> $departements
 * @property-read int|null $departements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interne> $destinataires
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interne> $expediteurs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imputation> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Journal> $journals
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $pivot_values
 * @property-read int|null $pivot_values_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reponse> $reponses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Annotation> $annotations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $createurs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Departement> $departements
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interne> $destinataires
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interne> $expediteurs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imputation> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Journal> $journals
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $pivot_values
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reponse> $reponses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, DateFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'poste',
        'etat',
        'role',
        'two_factor_enabled',
        'two_factor_code',
        'userable_id',
        'userable_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => RoleEnum::class,
    ];

    /**
     * Get the parent documentable model (Department or SubDepartment).
     */
    public function userable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope to get department users.
     */
    public function scopeUserDepartement(Builder $query): Builder
    {
        return $query->whereUserableType(Departement::class);
    }

    /**
     * Scope to get sub-department users.
     */
    public function scopeUserSubDepartement(Builder $query): Builder
    {
        return $query->whereUserableType(SubDepartement::class);
    }

    /**
     * Get the user's structure ID.
     */
    public function structure(): int
    {
        return $this->userable->structure_id ?? $this->userable->departement->structure_id;
    }

    /**
     * Get the user's structure MODEL.
     */
    public function user_structure(): Structure
    {
        $id = $this->userable->structure_id ?? $this->userable->departement->structure_id;

        return Structure::findOrFail($id);
    }

    /**
     * Check the user parent.
     */
    public function ParentCheck(User $model): bool
    {
        return Auth::user()->userable_id === $model->userable_id and Auth::user()->userable_type === $model->userable_type;
    }

    /**
     * Scope to get all users in the structure.
     */
    public function scopeStructureUser(Builder $query): Builder
    {
        $depIds = Structure::findOrFail(Auth::user()->structure())->departements()->pluck('id');
        $subIds = SubDepartement::whereIn('departement_id', $depIds)->pluck('id');

        return $query->where(function ($query) use ($depIds) {
            $query->userDepartement()
                ->whereIn('userable_id', $depIds);
        })->orWhere(function ($query) use ($subIds) {
            $query->userSubDepartement()
                ->whereIn('userable_id', $subIds);
        });
    }

    /**
     * Check if the user has the superadmin role.
     */
    public function isSuperadmin(): bool
    {
        return $this->role === RoleEnum::SUPERADMIN;
    }

    /**
     * Check if the user has the admin role.
     */
    public function isAdmin(): bool
    {
        return $this->role === RoleEnum::ADMIN;
    }

    /**
     * Check if the user has the superuser role.
     */
    public function isSuperuser(): bool
    {
        return $this->role === RoleEnum::SUPERUSER;
    }

    /**
     * Check if the user has the secretaire role.
     */
    public function isStandard(): bool
    {
        return $this->role === RoleEnum::STANDARD;
    }

    /**
     * Get all of the imputations for the User
     */
    public function imputations(): HasMany
    {
        return $this->hasMany(Imputation::class);
    }

    /**
     * Get all of the journals for the User
     */
    public function journals(): HasMany
    {
        return $this->hasMany(Journal::class);
    }

    /**
     * Get all of the annotations for the User
     */
    public function annotations(): HasMany
    {
        return $this->hasMany(Annotation::class);
    }

    /**
     * Get all of the rapports for the User
     */
    public function rapports(): HasMany
    {
        return $this->hasMany(Rapport::class);
    }

    /**
     * Get all of the comments for the User
     */
    public function destinataires(): HasMany
    {
        return $this->hasMany(Interne::class, 'destinataire_id');
    }

    /**
     * Get all of the expediteurs for the User
     */
    public function expediteurs(): HasMany
    {
        return $this->hasMany(Interne::class, 'expediteur_id');
    }

    /**
     * Get all of the departs for the User
     */
    public function departs(): HasMany
    {
        return $this->hasMany(Depart::class);
    }

    /**
     * Get all of the courriers for the User
     */
    public function courriers(): HasMany
    {
        return $this->hasMany(Courrier::class);
    }

    /**
     * Get all of the createurs for the User
     */
    public function createurs(): HasMany
    {
        return $this->hasMany(Task::class, 'createur_id');
    }

    /**
     * Get all of the histories for the User
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }

    /**
     * The departements that belong to the User
     */
    public function departements(): BelongsToMany
    {
        return $this->belongsToMany(Departement::class)->withPivot('type');
    }

    public function departement_pivot_value(string $value): BelongsToMany
    {
        return $this->belongsToMany(Task::class)->wherePivot('type', $value);
    }

    /**
     * The tasks that belong to the User
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class)->withPivot('etat');
    }

    public function pivot_values(): BelongsToMany
    {
        return $this->belongsToMany(Task::class)->wherePivot('etat', 0);
    }

    /**
     * Get all of the documents for the User
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get all of the reponses for the User
     */
    public function reponses(): HasMany
    {
        return $this->hasMany(Reponse::class);
    }
}
