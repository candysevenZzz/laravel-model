<?php


namespace LaravelModel\Contracts;


use LaravelModel\Entity\BaseEntity;

interface ModelServiceContract
{
    public function setData(BaseEntity $baseEntity);

    public function add(array $dataArr);

    public function update(array $dataArr);

    public function delete(int $pk);
}