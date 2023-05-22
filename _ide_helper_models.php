<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Agenda
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AgendaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda query()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Agenda extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Annotation
 *
 * @property int $id
 * @property int $user_id
 * @property string $nom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AnnotationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imputation> $imputations
 * @property-read int|null $imputations_count
 */
	class Annotation extends \Eloquent {}
}

namespace App\Models{
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
	class Archive extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Correspondant
 *
 * @property int $id
 * @property int $structure_id
 * @property string $prenom
 * @property string $nom
 * @property string $fonction
 * @property string $phone
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read int|null $courriers_count
 * @property-read Structure $structure
 * @method static \Database\Factories\CorrespondantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereFonction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant withoutTrashed()
 * @property string|null $contact
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereContact($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read int|null $departs_count
 */
	class Correspondant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Courrier
 *
 * @property int $id
 * @property int $user_id
 * @property int $nature_id
 * @property int $correspondant_id
 * @property string $reference
 * @property string $numero
 * @property string $objet
 * @property string $priorite
 * @property string $confidentiel
 * @property string|null $observation
 * @property CourrierEnum|null $etat
 * @property string $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Correspondant $correspondant
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read int|null $departs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read int|null $documents_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, History> $histories
 * @property-read int|null $histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $imputations
 * @property-read int|null $imputations_count
 * @property-read Nature $nature
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read int|null $rapports_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read User $user
 * @method static \Database\Factories\CourrierFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereConfidentiel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereCorrespondantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereNatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereObjet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier wherePriorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read string $date_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Departement> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 */
	class Courrier extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Depart
 *
 * @property int $id
 * @property int $user_id
 * @property int $nature_id
 * @property int|null $courrier_id
 * @property int $correspondant_id
 * @property string $reference
 * @property string $numero
 * @property string $objet
 * @property string $priorite
 * @property string $confidentiel
 * @property string|null $observation
 * @property string|null $etat
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Courrier|null $courrier
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read int|null $documents_count
 * @property-read User $user
 * @method static \Database\Factories\DepartFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Depart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Depart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Depart onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Depart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereConfidentiel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereCorrespondantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereCourrierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereNatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereObjet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart wherePriorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Depart withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @mixin \Eloquent
 * @property-read \App\Models\Correspondant $correspondant
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read string $date_format
 * @property-read \App\Models\Nature $nature
 */
	class Depart extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Departement
 *
 * @property int $id
 * @property string $nom
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $imputations
 * @property-read int|null $imputations_count
 * @property-read Structure $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\DepartementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Departement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Departement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Departement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Departement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Departement withoutTrashed()
 * @property int $structure_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereStructureId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 */
	class Departement extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Document
 *
 * @property int $id
 * @property string $documentable_type
 * @property int $documentable_id
 * @property string $libelle
 * @property string $chemin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Model|\Eloquent $documentable
 * @method static \Database\Factories\DocumentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereChemin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDocumentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDocumentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Document withoutTrashed()
 * @mixin \Eloquent
 * @property string $user_id
 * @property string $type
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUserId($value)
 */
	class Document extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\History
 *
 * @property int $id
 * @property int $courrier_id
 * @property int $user_id
 * @property string $action
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Courrier $courrier
 * @method static \Database\Factories\HistoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|History newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History query()
 * @method static \Illuminate\Database\Eloquent\Builder|History whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereCourrierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereUserId($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|History onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|History whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|History withoutTrashed()
 */
	class History extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Imputation
 *
 * @property int $user_id
 * @property int $departement_id
 * @property int $courrier_id
 * @property string|null $delai
 * @property string $reference
 * @property string|null $fin_traitement
 * @property string|null $observation
 * @property ImputationEnum|null $etat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Courrier $courrier
 * @property-read Departement $departement
 * @method static \Database\Factories\ImputationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereCourrierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereDelai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereDepartementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereFinTraitement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $priorite
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Annotation> $annotations
 * @property-read int|null $annotations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation wherePriorite($value)
 */
	class Imputation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Interne
 *
 * @property int $id
 * @property int $user_id
 * @property int $nature_id
 * @property int $expediteur_id
 * @property int $destinataire_id
 * @property string|null $delai
 * @property string $reference
 * @property string $numero
 * @property string $objet
 * @property string $priorite
 * @property string $confidentiel
 * @property string|null $contenu
 * @property string|null $etat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $destinataire
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read int|null $documents_count
 * @property-read User $expediteur
 * @property-read User $user
 * @method static \Database\Factories\InterneFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Interne newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Interne newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Interne onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Interne query()
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereConfidentiel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereDelai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereDestinataireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereExpediteurId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereNatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereObjet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne wherePriorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Interne withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read string $date_format
 * @property-read \App\Models\Nature $nature
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reponse> $reponses
 * @property-read int|null $reponses_count
 */
	class Interne extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Journal
 *
 * @property int $id
 * @property int $user_id
 * @property string $libelle
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $user
 * @method static \Database\Factories\JournalFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal withoutTrashed()
 * @mixin \Eloquent
 */
	class Journal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Nature
 *
 * @property int $id
 * @property string $nom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read int|null $courriers_count
 * @method static \Database\Factories\NatureFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Nature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature query()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nature withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read int|null $departs_count
 */
	class Nature extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Rapport
 *
 * @property int $id
 * @property int $user_id
 * @property int $courrier_id
 * @property string $nom
 * @property string $type
 * @property string|null $contenu
 * @property string|null $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Courrier $courrier
 * @property-read User $user
 * @method static \Database\Factories\RapportFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereCourrierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport withoutTrashed()
 * @mixin \Eloquent
 */
	class Rapport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Reponse
 *
 * @property int $id
 * @property int $interne_id
 * @property int $user_id
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Interne $interne
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ReponseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereInterneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereUserId($value)
 */
	class Reponse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Structure
 *
 * @property int $id
 * @property string $nom
 * @property string|null $logo
 * @property string|null $email
 * @property string $contact
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Correspondant> $correspondants
 * @property-read int|null $correspondants_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $departements
 * @property-read int|null $departements_count
 * @method static \Database\Factories\StructureFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Structure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure query()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure withoutTrashed()
 * @property string $adresse
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Correspondant> $correspondants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $departements
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereAdresse($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Correspondant> $correspondants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Departement> $departements
 */
	class Structure extends \Eloquent {}
}

namespace App\Models{
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
 * @property int|null $imputation_id
 * @property int $createur_id
 * @property string|null $reference
 * @property-read \App\Models\Courrier|null $courrier
 * @property-read \App\Models\User $createur
 * @property-read \App\Models\Imputation|null $imputation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreateurId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereImputationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereReference($value)
 */
	class Task extends \Eloquent {}
}

namespace App\Models{
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
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Annotation> $annotations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read int|null $documents_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read int|null $histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imputation> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interne> $internes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Journal> $journals
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reponse> $reponses
 * @property-read int|null $reponses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 */
	class User extends \Eloquent {}
}

