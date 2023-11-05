<?php

namespace App\Repositories;

interface RepositoryInterface {
    public function get();
    public function getPaginate($howMany);
    public function find($id);
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
}