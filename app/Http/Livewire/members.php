<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\member;
use Livewire\WithPagination;
use DB;

class members extends Component
{
    use WithPagination;

    public function render()
    {
        /*
        $sql="SELECT * FROM members
            WHERE members.userTypeID=1";
        $members=DB::select($sql);   
       */
        $sql="SELECT * FROM members
        ORDER BY memberID DESC";
         $members=DB::select($sql);  
            

        return view('livewire.members', [
            'members' => $members
        ]);
    }
}
