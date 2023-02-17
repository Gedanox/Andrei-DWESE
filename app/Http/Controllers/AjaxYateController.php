<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Service\Provider;
use Carbon\Carbon;


class AjaxYateController extends Controller {

    const ORDER_BY = 'name';
    const ORDER_TYPE = 'asc';
    const ITEMS_PER_PAGE = 10;

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
                    $urls[$indexBy][$indexType] = route('index',[
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
        
        //construcción de la consulta
        $item = DB::table('items')
                    ->select('*');

        //agregando condición a la consulta, si la hay
        if($q != '') {
            $item = $item->where('name', 'like', '%' . $q . '%')
                            ->orWhere('description', 'like', '%' . $q . '%')
                            ->orWhere('price', 'like', '%' . $q . '%')
                            ->orWhere('category', 'like', '%' . $q . '%');
        }

        //agregando el orden a la consulta
        $item = $item->orderBy($orderby, $ordertype);
        if($orderby != self::ORDER_BY) {
            $item = $item->orderBy(self::ORDER_BY, self::ORDER_TYPE);
        }

        //ejecutar la consulta, usando la paginación
        $items = $item->paginate(self::YACHTS_PER_PAGE)->withQueryString();
        
        //dd($items);
    }
    
    
    
    
    
    
    
    
    
    
    
    function index(Request $request) {
        $q = $request->input('q', '');
        
        $orderby = $this->getOrderBy($request->input('orderby'));
        $ordertype = $this->getOrderType($request->input('ordertype'));
        
        $route = route('index',[
                                    'orderby' => $request->input('orderby'),
                                    'ordertype' => $request->input('ordertype')]);
                                    
        
        $item = DB::table('items')
                    ->select('*');
                             
        $item = $item->orderBy($orderby, $ordertype);
        if($orderby != self::ORDER_BY) {
            $item = $item->orderBy(self::ORDER_BY, self::ORDER_TYPE);
        }       
        
        if($q != '') {
            $item = $item->where('name', 'like', '%' . $q . '%')
                            ->orWhere('description', 'like', '%' . $q . '%')
                            ->orWhere('price', 'like', '%' . $q . '%')
                            ->orWhere('category', 'like', '%' . $q . '%');
        }
                
        $items = $item->paginate(self::ITEMS_PER_PAGE)->withQueryString();
        //dd($items);
        return view('index', [ 'order'     => $this->getOrderUrls($orderby, $ordertype, $q),
                                    'orderby'   => $request->input('orderby'),
                                    'ordertype' => $request->input('ordertype'),
                                    'q'         => $q,
                                    'items'     => $items]);
    }
    
    public function show(Item $item)
    {
        return view('show', ['item' => $item]);
    }
    
    function upload(Request $request) 
    {
    	if($request->hasFile('file') && $request->file('file')->isValid())
    	{
			 $file = $request->file('file');
			 
			 $target = 'storage/';
			 $date = (string)Carbon::parse(Carbon::now())->format('YmdHis');
			 $name = $date . $file->getClientOriginalName();
			 

			 $file->move($target, $name);
			 
		}
    }
}