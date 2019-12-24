<?php


namespace App\Modules;


interface ModelInterface {

    /**
     * Create a new Model instance in DB
     * @return void
     */
    public function create();

    /**
     * Update a Model instance in DB
     * @return void
     */
    public function update();

    /**
     * Retrieve a Model instance from DB
     *
     * @param int $id
     * @return object
     */
    public function get(int $id);

    /**
     * Delete a Model instance from DB
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id);

    /**
     * Retrieve all entries of Model from DB
     *
     * @return array
     */
    public function all();

}