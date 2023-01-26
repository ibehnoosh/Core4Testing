<?php
namespace App\Contracts;

interface Services
{
    public function create($data);
    public function getAll();
    public function delete(int $id);
    public function getById(int $id);
    public function update(Entities $entities,$data);
}
