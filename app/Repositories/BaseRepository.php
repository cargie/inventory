<?php

namespace App\Repositories;

use Exception;
use Prettus\Repository\Events\RepositoryEntityDeleted;

abstract class BaseRepository extends \InfyOm\Generator\Common\BaseRepository
{
	public function updateRelations($model, $attributes)
	{
	    foreach ($attributes as $key => $val) {
	        if (isset($model) &&
	            method_exists($model, $key) &&
	            is_a(@$model->$key(), 'Illuminate\Database\Eloquent\Relations\Relation')
	        ) {
	            $methodClass = get_class($model->$key($key));
	            switch ($methodClass) {
	                case 'Illuminate\Database\Eloquent\Relations\BelongsToMany':
	                    $new_values = array_get($attributes, $key, []);
	                    if (array_search('', $new_values) !== false) {
	                        unset($new_values[array_search('', $new_values)]);
	                    }
	                    $model->$key()->sync($new_values);
	                    break;
	                case 'Illuminate\Database\Eloquent\Relations\BelongsTo':
	                    $model_key = $model->$key()->getQualifiedForeignKey();
	                    $new_value = array_get($attributes, $key, null);
	                    $new_value = $new_value == '' ? null : $new_value;
	                    $model->$model_key = $new_value;
	                    break;
	                case 'Illuminate\Database\Eloquent\Relations\HasOne':
	                    break;
	                case 'Illuminate\Database\Eloquent\Relations\HasOneOrMany':
	                    break;
	                case 'Illuminate\Database\Eloquent\Relations\HasMany':
	                    $new_values = array_get($attributes, $key, []);
	                    if (array_search('', $new_values) !== false) {
	                        unset($new_values[array_search('', $new_values)]);
	                    }

	                    list($temp, $model_key) = explode('.', $model->$key($key)->getQualifiedForeignKeyName());

	                    foreach ($model->$key as $rel) {
	                        if (!in_array($rel->id, $new_values)) {
	                            $rel->$model_key = null;
	                            $rel->save();
	                        }
	                        unset($new_values[array_search($rel->id, $new_values)]);
	                    }

	                    if (count($new_values) > 0) {
	                        $related = get_class($model->$key()->getRelated());
	                        foreach ($new_values as $val) {
	                            $rel = $related::find($val);
	                            $rel->$model_key = $model->id;
	                            $rel->save();
	                        }
	                    }
	                    break;
	                case 'Illuminate\Database\Eloquent\Relations\MorphToMany':
	                	$new_values = array_get($attributes, $key, []);
	                    if (array_search('', $new_values) !== false) {
	                        unset($new_values[array_search('', $new_values)]);
	                    }
	                    $model->$key()->sync($new_values);
	                    break;
	            }
	        }
	    }

	    return $model;
	}

	public function findByUid($id, $columns = ['*'])
    {
        try {
            return $this->model->where('uid', $id)->first($columns);
        } catch (Exception $e) {
            return;
        }
    }

    public function deleteByUid($id)
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->findWhere([['uid', '=', $id]])->first();
        $originalModel = clone $model;

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        $deleted = $model->delete();

        event(new RepositoryEntityDeleted($this, $originalModel));

        return $deleted;
    }
}
