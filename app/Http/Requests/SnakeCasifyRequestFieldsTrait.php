<?php


namespace App\Http\Requests;

use Illuminate\Support\Str;

/**
 * Trait SnakeCasifyRequestFieldsTrait
 *
 * @package App\Http\Requests
 */
trait SnakeCasifyRequestFieldsTrait
{
    /**
     * Converts all keys name to snake case before validation
     */
    public function convertParamsToSnakeCase()
    {
        foreach ($this->request as $key => $value)
        {
            if (Str::snake($key) === $key) {
                continue;
            }
            $this->request->set(Str::snake($key), $value);
            $this->request->remove($key);
        }
    }
}
