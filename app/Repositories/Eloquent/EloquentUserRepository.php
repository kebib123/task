<?php


namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;

class EloquentUserRepository implements \App\Repositories\Contracts\UserRepository
{
    /**
     * Get's a record by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {

    }


    /**
     * Get's all records.
     *
     * @return mixed
     */
    public function all()
    {

    }


    public function store($request)
    {


        }




    /**
     * Deletes a record.
     *
     * @param int
     */
    public function delete($id)
    {
        Form::destroy($id);
        return true;
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data)
    {

    }

}
