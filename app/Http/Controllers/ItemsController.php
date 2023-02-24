<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Service\Provider;
use Carbon\Carbon;

class ItemsController extends Controller
{
    
    

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
        $items = $item->paginate(self::YACHTS_PER_PAGE)->withQueryString();
        
        //dd($items);
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q', '');
        
        $orderby = $this->getOrderBy($request->input('orderby'));
        $ordertype = $this->getOrderType($request->input('ordertype'));
        
        $route = route('index.index',[
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
                            ->orWhere('price', 'like', '%' . $q . '%');
        }
                
        $items = $item->paginate(self::ITEMS_PER_PAGE)->withQueryString();
        //dd($items);
        return view('items.index', [  'order'     => $this->getOrderUrls($orderby, $ordertype, $q),
                                'orderby'   => $request->input('orderby'),
                                'ordertype' => $request->input('ordertype'),
                                'q'         => $q,
                                'items'     => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function store(Request $request)
    {
        $items = new Items();
        $items->iduser = 1;
        $items->idcategory = $request->category;
        $items->name = $request->name;
        
        if($request->hasFile('photo') && $request->file('photo')->isValid())
        	{
        		 $file = $request->file('photo');
        		 
        		 $target = 'storage/';
        		 $date = (string)Carbon::parse(Carbon::now())->format('YmdHis');
        		 $name = $date . $file->getClientOriginalName();
        		 
        
        		 $file->move($target, $name);
        		 
        	}
		
        $items->photo = $target.$name;
        $items->description = $request->description;
        $items->price = $request->price;
        //dd($items);
        
        $items->save();
        
        return redirect('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Items::find($id);
        return view('items.show', ['items' => $items]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
