<?php
namespace App\Contracts;

interface Services
{
    public function create($data): Entities;
    public function getAll() :array;
    public function delete(int $id) : void;
    public function getById(int $id): ?Entities;
    public function update(Entities $entities,$data) : Entities;
}
