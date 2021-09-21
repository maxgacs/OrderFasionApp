<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use DB;
use App\Models\order_detail;

class charts2 extends Component
{
    public function render()
    {
        
        $year=array();
        //$year = ['Bag', 'T-shirt','Poster','Keychain','Hat','brooch','Glass'];
       
        //echo count($product_type); die();
        $year[0]='ม.ค.';
        $year[1]='ก.พ.';
        $year[2]='มี.ค.';
        $year[3]='เม.ย.';
        $year[4]='พ.ค.';
        $year[5]='มิ.ย.';
        $year[6]='ก.ค.';
        $year[7]='ส.ค.';
        $year[8]='ก.ย.';
        $year[9]='ต.ค.';
        $year[10]='พ.ย.';
        $year[11]='ธ.ค.';
        

        $userarr=array();
        $mont=array();
          $user  = DB::connection('mysql')->select("SELECT SUBSTRING(orders.created_at,6,2) AS month, 
          SUM(products.productSoldMoney) AS totalAmount 
          FROM products 
          INNER JOIN order_details ON products.productID=order_details.productID
          INNER JOIN orders ON order_details.orderID=orders.orderID
          GROUP BY SUBSTRING(orders.created_at,6,2)
          ORDER BY SUBSTRING(orders.created_at,6,2) ASC");
       
       $y=0;
       foreach ($user as $key => $value) { 
                $userarr[$y] = $value->totalAmount ;
                $mont[$y] = $year[$value->month -1];
                $y++;
       }


    	return view('livewire.charts2')->with('year',json_encode($mont,JSON_NUMERIC_CHECK))->with('user',json_encode($userarr,JSON_NUMERIC_CHECK));
                            
            
    }
    
}
