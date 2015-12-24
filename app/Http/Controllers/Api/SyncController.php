<?php

namespace App\Http\Controllers\Api;

use Intersect\Api;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intersect\Api\Sync\SyncManager;

class SyncController extends Controller
{
    public function index(Request $request)
    {

        try
        {
            $keys = (array_keys($request->all()));

            $manager = new SyncManager($request);

            foreach ($keys as $key)
            {
                $class = $manager->getClassName($key);

                $results[] = $manager->checkSyncedItems($class , $request->input($key) , true);
            }

            return Api::response(['message_info' => "sync completed",'message_data' => $results]);
        }
        catch (\Exception $e)
        {
            return Api::response(['message_info' => $e->getMessage(),'error'=>true]);
        }
    }

    public function users()
    {
        echo "Users function";
    }
}
