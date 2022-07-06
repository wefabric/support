<?php

namespace Wefabric\Support\Concerns;

/**
 * Use as a trait in your Eloquent Model (Laravel).
 */
trait NextPreviousModel
{
    /**
     * 
     * Returns the next model item based on the current model primary key (must be an integer to work).
     * Be aware with sorting of retrieving the current model. If you sorted with the primary key descending, use the previous method to get the next model item.
     * @return mixed
     */
    public function next()
    {
        return self::query()->where($this->primaryKey, '>', $this->getAttribute($this->primaryKey))->orderBy($this->primaryKey,'asc')->first();
    }

    /**
     * Returns the previous model item based on the current model primary key (must be an integer to work).
     * Be aware with sorting of retrieving the current model. If you sorted with the primary key descending, use the next method to get the previous model item.
     * @return mixed
     */
    public  function previous()
    {
        return self::query()->where($this->primaryKey, '<',  $this->getAttribute($this->primaryKey))->orderBy($this->primaryKey,'desc')->first();
    }
}
