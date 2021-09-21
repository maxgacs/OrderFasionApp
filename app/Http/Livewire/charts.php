<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use DB;
use App\Models\order_detail;

class charts extends Component
{
    public function render()
    {
        
            $year=array();
            $product = DB::connection('mysql')->select('select products.productName ,SUM(products.productSoldMoney) as count from products
            GROUP BY products.productName  ');
            $i=0;
            foreach ($product as $key => $value) { 
                    $year[$i] = $value->productName;
                    $i++;
            }

            $userarr=array();
            $user  = DB::connection('mysql')->select("select SUM(products.productSoldMoney) as count from products
                  GROUP BY products.productName ");
         $y=0;
         foreach ($user as $key => $value) { 
                  $userarr[$y] = $value->count;
                  $y++;
         }
    
    
            return view('livewire.charts')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($userarr,JSON_NUMERIC_CHECK));
            
            
    }
    
}
