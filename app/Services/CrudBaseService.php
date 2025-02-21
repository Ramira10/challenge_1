<?php

namespace App\Services;

use Error;
use Illuminate\Database\Eloquent\Model;

abstract class CrudBaseService
{
    public $model = null;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return array Model
     */
    public function getAll()
    {
        try {
            return $this->model::latest()->customPaginate();
        } catch (Error $err) {
            throw $err;
        }
    }

    public function getOne($id)
    {
        try {
            $element = $this->model::where('id', $id)->firstOrFail();
            if (!$element) {
                abort(404);
            }
            return $element;
        } catch (Error $err) {
            throw $err;
        }
    }

    public function save(array $data)
    {
        try {
            $element = $this->model::create($data);
            return $element;
        } catch (Error $err) {
            throw $err;
        }
    }

    public function update($id, $data)
    {
        try {

            $element = $this->model::where('id', $id)->first();

            if (!$element) {
                abort(404);
            }
            foreach ($data as $field => $value) {
                $element[$field] = $value;
            }
            $element->save();

            return $element;
        } catch (Error $err) {
            throw $err;
        }
    }

    public function delete($id)
    {
        try {
            $element = $this->model::where('id', $id)->first();

            if (!$element) {
                abort(404);
            }

            $element->delete();
            return $element;
        } catch (Error $err) {
            throw $err;
        }
    }
}
