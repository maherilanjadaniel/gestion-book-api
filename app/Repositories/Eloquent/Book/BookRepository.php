<?php 
namespace App\Repositories\Eloquent\Book;

use Illuminate\Database\Eloquent\Builder;
use App\Repositories\EloquentBaseRepository;
use App\Repositories\BaseRepository;
use App\Models\Book;

class BookRepository extends EloquentBaseRepository implements BaseRepository{

	public function __construct(Book $mod){
		$this->model = $mod;
	}

    public function getById($id){
		return $this->model->query()->find($id);
	}

    /**
     * Get all records
     * @param string $limit
     * @param string $offset
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll($limit=null, $offset=null){
        return $this->model->query()
                ->when($limit, function($q) use ($limit){
                    $q->limit($limit);
                })
                ->when($offset, function($q) use ($offset){
                    $q->offset($offset);
                })
                ->get();
    }

    /**
     * Search books by title or summary
     * @param string|null $str                  
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchBy($str=null){
        return $this->model->query()
            ->when($str,function($q) use($str){
                return $q->where('title','LIKE','%'.$str.'%')
                        ->orWhere('summary','LIKE','%'.$str.'%');
            })->get();
    }

    /**
     * Count all records
     * @return int
     */
    public function countAll()
    {
        return $this->model
            ->count();
    }

   
    /**
     * @param  mixed  $data
     * @return object
     */
    public function create($data)
    {
        if (!is_array($data)) {
            
        }
        $model = $this->model->create($data);
        return $model;
    }

    /**
     * @param $model
     * @param  array  $data
     * @return object
     */
    public function update($data)
    {
       
        $id = $data['id'];
        unset($data['id']);
        $model = $this->model->query()->where('id','=',$id)->update($data);
        return $model;
    }

    public function destroy($model)
    {
       
        return $model->delete();
    }
}