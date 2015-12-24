<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/22/15
 * Time: 9:18 PM
 */

namespace Intersect\Api\Request;

use Illuminate\Support\Facades\DB;

 class QueryBuilder
{
    protected $query;

    protected $model;

    public function __construct($model)
    {
        $this->query = DB::table($model->getTable());
    }

    public function applyFilters($array)
    {
      if($array != null)
      {
          $this->query->select($array);
      }

    }

    public function applyParameters($array)
    {
      foreach($array as $key => $value)
      {
          $this->query->where($key,$value);
      }
    }

    public function get()
    {
      return $this->query->get();
    }

}
