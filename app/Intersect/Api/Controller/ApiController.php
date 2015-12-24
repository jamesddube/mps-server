<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/9/15
 * Time: 2:21 PM
 */

namespace Intersect\Api\Controller;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intersect\Api\Request\QueryBuilder;
use Intersect\Api\Response\Json;
use JavaScript;

class ApiController extends Controller
{
    protected $model;
    protected $requestValidator;
    protected $modelArray;

    public function __construct()
    {
        if($this->model == null)
        {
            $this->setModel('\App\\'.str_replace("Controller",'',class_basename($this)));
        }

        if($this->modelArray == null)
        {
            $this->setModelArray('\Intersect\Api\Validation\ModelValidators\\'.str_replace("Controller",'',class_basename($this)).'Array');
        }

        if($this->requestValidator == null)
        {
            $this->requestValidator = ('\Intersect\Api\Validation\RequestValidators\\'.str_replace("Controller",'',class_basename($this)).'Request');
        }



    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        /*@todo Query Parameters should consist of a model's attribute, in other words get the attributes of a model dynamically and use them as query params!
        */

        $OrderQueryBuilder = new QueryBuilder(new $this->model);

        $OrderQueryBuilder->applyParameters($request->all());

        return $OrderQueryBuilder->get();
    }

    public function show($id)
    {
        $c = $this->model;
        $a = ($c::find($id));

        return is_null($a) ? Json::response(['error'=>true,'message_info' => 'resource not found']) : Json::response(['message_data' => $a]);
    }

    public function store(Request $request)
    {
        //Validate Request
        $validator = new $this->modelArray($request);

        $validator->validate($request->all());

        $model = new $this->model;

        $key = $this->getModelArrayKey();

        $data = $request->input($key);

        //Store in the database
        DB::table($model->getTable())->insert($data);
    }

    private function setModelArray($string)
    {
        $this->modelArray = $string;
    }

    private function getModelArrayKey()
    {
        $m = new $this->modelArray();

        return $m->getKey();
    }

    private function getModelAttributes()
    {
        $m = new $this->model();

        return ($m->getFillable());
    }

}
