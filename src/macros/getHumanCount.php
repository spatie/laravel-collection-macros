<?php

use Illuminate\Support\Collection;

/*
 * Get the second item from the collection.
 *
 * @param mixed $index
 *
 * @return mixed
 */
Collection::macro('second', function () {
    return $this->get(1);
});

/*
 * Get the third item from the collection.
 *
 * @param mixed $index
 *
 * @return mixed
 */
Collection::macro('third', function () {
    return $this->get(2);
});

/*
 * Get the fourth item from the collection.
 *
 * @param mixed $index
 *
 * @return mixed
 */
Collection::macro('fourth', function () {
    return $this->get(3);
});

/*
 * Get the fifth item from the collection.
 *
 * @param mixed $index
 *
 * @return mixed
 */
Collection::macro('fifth', function () {
    return $this->get(4);
});

/*
 * Get the sixth item from the collection.
 *
 * @param mixed $index
 *
 * @return mixed
 */
Collection::macro('sixth', function () {
    return $this->get(5);
});

/*
 * Get the seventh item from the collection.
 *
 * @param mixed $index
 *
 * @return mixed
 */
Collection::macro('seventh', function () {
    return $this->get(6);
});

/*
 * Get the eighth item from the collection.
 *
 * @param mixed $index
 *
 * @return mixed
 */
Collection::macro('eighth', function () {
    return $this->get(7);
});

/*
 * Get the ninth item from the collection.
 *
 * @param mixed $index
 *
 * @return mixed
 */
Collection::macro('ninth', function () {
    return $this->get(8);
});

/*
 * Get the tenth item from the collection.
 *
 * @param mixed $index
 *
 * @return mixed
 */
Collection::macro('tenth', function () {
    return $this->get(9);
});
