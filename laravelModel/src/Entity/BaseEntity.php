<?php


namespace LaravelModel\Entity;

use Exception;
use Reflector;
use ArrayAccess;
use ReflectionClass;
use ReflectionObject;
use ReflectionProperty;
use ReflectionException;
use LaravelModel\Contracts\ArrayAbleContracts;
use LaravelModel\Handler\Traits\ArrayAccessTrait;
use LaravelModel\Handler\Traits\SetterAndGetterTrait;


class BaseEntity implements ArrayAccess, ArrayAbleContracts
{
    use ArrayAccessTrait, SetterAndGetterTrait;

    /**
     * @var static $entityInstance
     */
    private static $entityInstance;

    /**
     * @var string 创建时间
     */
    public $createdAt;

    /**
     * @var string 更新时间
     */
    public $updatedAt;

    /**
     * @var bool 是否为更新标记
     */
    public $isUpdate = false;

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
     * @param string $entityName
     * @return BaseEntity
     * @throws Exception
     */
    public static function getEntityInstance($entityName = ''): BaseEntity
    {
        if (!self::$entityInstance) {
            $entityName = get_called_class();
            self::$entityInstance = new $entityName;
        }
        return self::$entityInstance;
    }

    /**
     * @param bool $isDefault 标识是否获取默认属性
     * @return array|void
     * @throws ReflectionException
     */
    public function toArray($isDefault = true): array
    {
        $instance = $this->getReflectionInstance($isDefault);
        $properties = [];
        if ($isDefault) {
            //获取默认属性信息
            $reflectProperties = $instance->getDefaultProperties();
            foreach ($reflectProperties as $property => $value) {
                $properties[$property] = $instance->getProperty($property)->getValue($this);
            }
        } else {
            //获取默认+动态属性信息

            //$filter可选参数（多个参数用'|'分割）:
            //ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE
            $reflectProperties = $instance->getProperties(ReflectionProperty::IS_PUBLIC);
            foreach ($reflectProperties as $property) {
                $properties[$property->getName()] = $property->getValue($this);
            }
        }
        return $properties;
    }

    /**
     * @param bool $isDefault
     * @return ReflectionClass|ReflectionObject
     * @throws ReflectionException
     */
    private function getReflectionInstance($isDefault = true):Reflector
    {
        if ($isDefault) {
            return new ReflectionClass(get_class($this));//无法获取动态增加的属性
        }
        return new ReflectionObject($this);

    }
}