<?php


namespace LaravelModel\Handler\Traits;


trait SetterAndGetterTrait
{
    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        return $this->$name = $value;
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    /**
     * @param $method
     * @param $args
     * @return mixed|null
     */
    public function __call($method, $args)
    {
        $prefix = substr(lcfirst($method),0,3);
        $property = lcfirst(substr($method, 3));
        switch ($prefix) {
            case 'set':
                return $this->$property = $args[0];
            case 'get':
                if (property_exists($this, $property)) {
                    return $this->$property;
                }
                return null;
        }

    }

}