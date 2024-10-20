<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct(Model $_model)
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    // final private function isConnected(){
    //     try{
    //         app('db')->connection()->getPdo();
    //         return true;
    //     }catch(\Exception $e){
    //         return false;
    //     }
    // }
    /**
     * Set model
     */
    public function setModel()
    {
        // if(!$this->isConnected()){
        //     app('connection')->setDriver('backup');
        // }
        // $model = $this->_model;
        // if(!app()->make($model)){
        //     app()->singleton($model, function() use ($model){
        //         return new $model;
        //     });
        // }
        // if(!$this->isConnected()){
        //     config(['database.default' => 'backup']);
        // }
        $this->_model = app()->make(
            $this->getModel()
        );
    }


    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {

        return $this->_model->all();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);

        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

}
