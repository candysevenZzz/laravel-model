<?php


namespace LaravelModel\Handler\Traits;


trait ArrayAccessTrait
{
    /**
     * @param $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        if (property_exists($this, $offset)) {
            return true;
        }
        return false;
    }

    /**
     * @param $offset
     * @return null|mixed
     */
    public function offsetGet($offset)
    {
        if (property_exists($this, $offset)) {
            return $this->$offset;
        }
        return null;
    }

    /**
     * @param $offset
     * @param $value
     * @return mixed
     */
    public function offsetSet($offset, $value)
    {
        return $this->$offset = $value;
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
}