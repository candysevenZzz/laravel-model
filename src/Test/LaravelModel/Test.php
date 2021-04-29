<?php

namespace LaravelModel\Test;

class Test
{
    public function test()
    {
        /** @var TestModelService $modelService */
        $modelService = TestModelService::getModelServiceInstance();

//        $model = TestModelService::getModelInstance();

        /** @var TestEntity $entity */
        $entity = TestEntity::getEntityInstance();
        $entity->id = 111;
        $entity->name = 'Candy Seven';
        $entity->age = 18;

        //拓展的访问方式
        $entity->addr = '成都';
        $entity->setCccccc(11);
        $entity['dddddd'] = 1212;

//        $arr1 = $entity->toArray(false);//动态属性+默认属性
//        $arr2 = $entity->toArray();//默认属性
//        var_dump($arr1,$arr2);

        $data = $modelService->setData($entity);
        $modelService->add($data);//新增

        $entity->isUpdate = true;
        $arr = $modelService->setData($entity);
        $modelService->update($arr);//编辑
    }


}