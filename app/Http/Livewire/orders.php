<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\order;
use Livewire\WithPagination;
use DB;

class orders extends Component
{
    use WithPagination;

    public $confirmingEmpDeletion = false;

    public function render()
    {
        $sql="SELECT * FROM orders
        INNER JOIN members ON members.memberID  = orders.memberID  
        INNER JOIN stepstatus ON stepstatus.stepStatusID  = orders.stepStatusID
        ORDER BY orderID DESC ";
         $order=DB::select($sql);   

        return view('livewire.orders', [
            'orders' => $order
        ]);
    }

   
}
