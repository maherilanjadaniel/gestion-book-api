<?php 
namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;


abstract class EloquentBaseRepository implements BaseRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model An instance of the Eloquent Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @param  int    $id
     * @return object
     */
    public function find($id)
    {
       return $this->model->find($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    /**
     * @param  mixed  $data
     * @return object
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $model
     * @param  array  $data
     * @return object
     */
    public function update($data)
    {
        $model= $this->model->update($data);

        return $model;
    }

    /**
     * @param  Model $model
     * @return bool
     */
    public function destroy($model)
    {
        return $model->delete();
    }

    /**
     * Find a resource by an array of attributes
     * @param  array  $attributes
     * @return object
     */
    public function findByAttributes(array $attributes)
    {
        $query = $this->buildQueryByAttributes($attributes);

        return $query->first();
    }

    /**
     * Get resources by an array of attributes
     * @param array $attributes
     * @param null|string $orderBy
     * @param string $sortOrder
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc')
    {
        $query = $this->buildQueryByAttributes($attributes, $orderBy, $sortOrder);

        return $query->get();
    }

    /**
     * Build Query to catch resources by an array of attributes and params
     * @param array $attributes
     * @param null|string $orderBy
     * @param string $sortOrder
     * @return \Illuminate\Database\Query\Builder object
     */
    private function buildQueryByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc')
    {
        $query = $this->model->query();

        foreach ($attributes as $field => $value) {
            $query = $query->where($field, $value);
        }

        if (null !== $orderBy) {
            $query->orderBy($orderBy, $sortOrder);
        }

        return $query;
    }

    /**
     * Return a collection of elements who's ids match
     * @param array $ids
     * @return mixed
     */
    public function findByMany(array $ids)
    {
        $query = $this->model->query();
        
        // Ensure the ids are unique and not empty
        $ids = array_filter(array_unique($ids));

        if (empty($ids)) {
            return $query->get();
        }
        return $query->whereIn("id", $ids)->get();
    }

    /**
     * Clear the cache for this Repositories' Entity
     * @return bool
     */
    public function clearCache()
    {
        return true;
    }

    public function orderBy($orderBy = null, $sortOrder = 'asc'){
        $query = $this->model->query();

        if (null !== $orderBy) {
           return $query->orderBy($orderBy, $sortOrder)->get();
        }

        //return $query;
    }
}