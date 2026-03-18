<?php

namespace App\Repositories\Interfaces;

interface CourseRepositoryInterface {
    public function getAll();
    public function findByTd($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}