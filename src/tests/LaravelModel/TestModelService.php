<?php

namespace LaravelModel\Test;

use Exception;
use LaravelModel\Entity\BaseEntity;
use LaravelModel\ModelService\BaseModelService;

class TestModelService extends BaseModelService
{
    public function setData(BaseEntity $baseEntity)
    {
        if ($baseEntity->isUpdate) {
            $model = self::getModelInstance()->where('id', $baseEntity->id)->first();
            if (!$model) {
                throw new Exception('This Data Record Can Not Found');
            }
        }
        return $baseEntity->toArray();
    }

    public function add(array $data): int
    {
        return self::getModelInstance()->add($data);
    }

    public function update($data)
    {
        return self::getModelInstance()->update($data);
    }

}