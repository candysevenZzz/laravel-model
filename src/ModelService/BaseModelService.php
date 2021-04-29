<?php


namespace LaravelModel\ModelService;

use Exception;
use LaravelModel\Entity\BaseEntity;
use Illuminate\Database\Eloquent\Model;
use LaravelModel\Contracts\ModelServiceContract;

abstract class BaseModelService implements ModelServiceContract
{

    /**
     * @var string $model
     */
    public static $model;

    private static $modelPath = 'App\\Model\\';

    /**
     * @var static $modelInstance
     */
    private static $modelInstance;

    /**
     * @var static $modelServiceInstance
     */
    private static $modelServiceInstance;

    public function __construct()
    {
    }

    public function __clone()
    {
    }

    public function __wakeup()
    {
    }

    /**
     * @param string $modelName
     * @return Model
     * @throws Exception
     */
    public static function getModelInstance($modelName = ''): Model
    {
        if (!self::$modelInstance) {
            $modelName = self::$modelPath . self::getModelName($modelName);
            self::$modelInstance = new $modelName;
        }
        return self::$modelInstance;
    }

    /**
     * @return static
     */
    public static function getModelServiceInstance(): BaseModelService
    {
        if (!self::$modelServiceInstance) {
            $modelServiceName = get_called_class();
            self::$modelServiceInstance = new $modelServiceName;
        }
        return self::$modelServiceInstance;
    }

    public function setData(BaseEntity $baseEntity)
    {
        // TODO: Implement setData() method.
    }

    public function add(array $dataArr)
    {
        // TODO: Implement add() method.
    }

    public function update(array $dataArr)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $pk)
    {
        // TODO: Implement delete() method.
    }

    private static function getModelName(string $className = ''): string
    {
        if ($className) return $className;

        if (static::$model) return static::$model;

        $name = get_called_class();
        $modelName = substr($name, strripos($name,'\\') + 1, strpos($name,'Service'));
        if (!class_exists(self::$modelPath . $modelName)) throw new Exception( 'Class ' . self::$modelPath . $modelName . ' not found');
        return $modelName;
    }
}