<?php

namespace App\Traits;

use App\Models\Historique;
use Illuminate\Support\Facades\Auth;

trait HasHistorique
{
    protected static function bootHasHistorique()
    {
        static::created(function ($model) {
            self::recordHistory($model, 'created', null, $model->toArray());
        });

        static::updated(function ($model) {
            self::recordHistory($model, 'updated', $model->getOriginal(), $model->getChanges());
        });

        static::deleted(function ($model) {
            self::recordHistory($model, 'deleted', $model->toArray(), null);
        });
    }

    protected static function recordHistory($model, $action, $oldValues, $newValues)
    {
        Historique::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'description' => self::generateDescription($model, $action),
        ]);
    }

    protected static function generateDescription($model, $action)
    {
        $modelName = class_basename($model);
        $identifier = $model->id;

        // Attempt to get a more descriptive identifier if available
        if (isset($model->nom)) {
            $identifier = $model->nom;
        } elseif (isset($model->titre)) {
            $identifier = $model->titre;
        } elseif (isset($model->email)) {
            $identifier = $model->email;
        }

        switch ($action) {
            case 'created':
                return "Création de {$modelName} (ID: {$identifier})";
            case 'updated':
                return "Mise à jour de {$modelName} (ID: {$identifier})";
            case 'deleted':
                return "Suppression de {$modelName} (ID: {$identifier})";
            default:
                return "Action inconnue sur {$modelName} (ID: {$identifier})";
        }
    }
}
