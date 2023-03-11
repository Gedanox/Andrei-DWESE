<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Service\Provider;


class AjaxShopController extends Controller {

    const ORDER_BY = 'name';
    const ORDER_TYPE = 'asc';
    const ITEMS_PER_PAGE = 4;
    private function getOrder($orderArray, $order, $default) {
        $value = array_search($order, $orderArray);
        if(!$value) {
            return $default;
        }
        return $value;
    }

    private function getOrderBy($order) {
        return $this->getOrder($this->getOrderBys(), $order, self::ORDER_BY);
    }

    private function getOrderBys() {
        return [
            'name'            => 'c1',
            'price'        => 'c2',
            'created_at'        => 'c3',
        ];
    }

    private function getOrderType($order) {
        return $this->getOrder($this->getOrderTypes(), $order, self::ORDER_TYPE);
    }

    private function getOrderTypes() {
        return [
            'asc'  => 't1',
            'desc' => 't2',
        ];
    }
    
    private function getOrderUrls($oBy, $oType, $q) {
        $urls = [];
        $orderBys = $this->getOrderBys();
        $orderTypes = $this->getOrderTypes();
        foreach($orderBys as $indexBy => $by) {
            foreach($orderTypes as $indexType => $type) {
                if($oBy == $indexBy && $oType == $indexType) {
                    $urls[$indexBy][$indexType] = url()->full() . '#';
                } else {
                    $urls[$indexBy][$indexType] = route('index.index',[
                                                        'orderby' => $by,
                                                        'ordertype' => $type,
                                                        'q' => $q]);
                }
            }
        }
        return $urls;
    }
    
    
    
    function fetchData(Request $request) {
        //consulta, ordenación y tipo de ordenación
        $q = $request->input('q', '');
        $orderby = $request->input('orderby', 'name');
        $ordertype = $request->input('ordertype', 'asc');
        
        $orderby = $this->getOrderBy($request->input('orderby'));
        $ordertype = $this->getOrderType($request->input('ordertype'));
        
        
        
        //construcción de la consulta
        $item = DB::table('items')
                    ->select('*');

        //agregando condición a la consulta, si la hay
        if($q != '') {
            $item = $item->where('name', 'like', '%' . $q . '%')
                            ->orWhere('description', 'like', '%' . $q . '%')
                            ->orWhere('price', 'like', '%' . $q . '%');
        }

        //agregando el orden a la consulta
        $item = $item->orderBy($orderby, $ordertype);
        if($orderby != self::ORDER_BY) {
            $item = $item->orderBy(self::ORDER_BY, self::ORDER_TYPE);
        }

        //ejecutar la consulta, usando la paginación
        $items = $item->paginate(self::ITEMS_PER_PAGE)->withQueryString();
        
        //dd($items);
        return response()->json(['items'    => $items,
                                 'csrf'     => csrf_token(),
                                 'user'     => Auth::user()],
                                 200);
    }
    
    function index(Request $request) {
        return view('index');
    }
}