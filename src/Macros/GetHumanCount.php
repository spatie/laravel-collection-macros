<?php

namespace Spatie\CollectionMacros\Macros;

class GetHumanCount
{
    /**
     * Get the second item from the collection.
     *
     * @param mixed $index
     *
     * @return mixed
     */
    public function second()
    {
        return function () {
            return $this->get(1);
        };
    }

    /**
     * Get the third item from the collection.
     *
     * @param mixed $index
     *
     * @return mixed
     */
    public function third()
    {
        return function () {
            return $this->get(2);
        };
    }

    /**
     * Get the fourth item from the collection.
     *
     * @param mixed $index
     *
     * @return mixed
     */
    public function fourth()
    {
        return function () {
            return $this->get(3);
        };
    }

    /**
     * Get the fifth item from the collection.
     *
     * @param mixed $index
     *
     * @return mixed
     */
    public function fifth()
    {
        return function () {
            return $this->get(4);
        };
    }

    /**
     * Get the sixth item from the collection.
     *
     * @param mixed $index
     *
     * @return mixed
     */
    public function sixth()
    {
        return function () {
            return $this->get(5);
        };
    }

    /**
     * Get the seventh item from the collection.
     *
     * @param mixed $index
     *
     * @return mixed
     */
    public function seventh()
    {
        return function () {
            return $this->get(6);
        };
    }

    /**
     * Get the eighth item from the collection.
     *
     * @param mixed $index
     *
     * @return mixed
     */
    public function eighth()
    {
        return function () {
            return $this->get(7);
        };
    }

    /**
     * Get the ninth item from the collection.
     *
     * @param mixed $index
     *
     * @return mixed
     */
    public function ninth()
    {
        return function () {
            return $this->get(8);
        };
    }

    /**
     * Get the tenth item from the collection.
     *
     * @param mixed $index
     *
     * @return mixed
     */
    public function tenth()
    {
        return function () {
            return $this->get(9);
        };
    }
}
