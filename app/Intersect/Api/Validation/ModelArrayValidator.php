<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 11/30/15
 * Time: 11:50 PM
 */

namespace Intersect\Api\Validation;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Intersect\Api\Exception\ApiException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class ModelArrayValidator
{
    protected $key;

    protected $request;

    protected $required = [];

    public function getKey()
    {
        return $this->key;
    }

    protected function rules()
    {
        return array();
    }

    public function validate(array $request)
    {
        $this->request = $request;

        if(isset($request[$this->key]))
        {
            $collection = Collection::make(array_keys($this->request));

            foreach ($this->required as $key)
            {
                if ( $collection->contains($key) === false )
                {
                    throw new ApiException("key attribute $key not found" , 400);
                }
            }

            foreach ($request[ $this->key ] as $order)
            {
                $v = Validator::make($order , $this->rules());

                if ( $v->fails() )
                {
                    throw new ApiException($v->errors());
                }
            }

            return true;
        }
        else
        {
            throw new BadRequestHttpException("$this->key object not found");
        }

    }




}