<?php


namespace App\Modules;


interface ModelInterface {

    /**
     * Create a new Model instance in DB
     * @return mixed
     */
    public function create();

    /**
     * Update a Model instance in DB
     * @return mixed
     */
    public function update();

    /**
     * Retrieve a Model instance from DB
     *
     * @param int $id
     * @return mixed
     */
    public static function get(int $id);

    /**
     * Delete a Model instance from DB
     *
     * @param int $id
     * @return mixed
     */
    public static function delete(int $id);

}