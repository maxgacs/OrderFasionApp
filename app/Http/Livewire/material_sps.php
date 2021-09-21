<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\material_sp;
use Livewire\WithPagination;
use DB;

class material_sps extends Component
{
    use WithPagination;

    public $material_sp;
    public $material_spName;
    public $material_spSize;
    public $material_spPrice;
    public $material_spQuan;
    public $confirmMaterialspAdd = false;
    public $confirmMaterialspDeletion = false;
    public $confirmMaterialspEdit = false;

    protected $rules = [
        'material_sp.material_spName' => 'required',
        'material_sp.material_spSize' => 'required',
        'material_sp.material_spPrice' => 'required',
        'material_sp.material_spQuan' => 'required'
    ];

    public function render()
    {
        
        $sql="SELECT * FROM material_sps
        ORDER BY material_spID DESC";
         $material_sps=DB::select($sql);  
            

        return view('livewire.material_sps', [
            'material_sps' => $material_sps
        ]);
    }

    //ADD mat

    public function confirmMaterialspAdd()
    {
        $this->resetInputFields();
        $this->reset(['material_sp']);
        $this->confirmMaterialspAdd = true;
    }

    public function saveAddMaterialsp()
    {
        $this->validate();
        $this->confirmMaterialspAdd = false;
    }

    public function resetInputFields()
    {
        $this->material_spName='';
        $this->material_spSize='';
        $this->	material_spPrice='';
        $this->material_spQuan='';
    }

    public function store()
    {
        $validatesData = $this->validate([
            'material_spName' => 'required',
            'material_spSize' => 'required',
            'material_spPrice' => 'required',
            'material_spQuan' => 'required'
        ]);

        material_sp::create($validatesData);
        session()->flash('message','เพิ่มวัสดุสำเร็จ');
        $this->resetInputFields();
        $this->confirmMaterialspAdd = false;
    }

    //Delete
    public function confirmMaterialspDeletion($material_sp)
    {
        $this->confirmMaterialspDeletion = $material_sp;
    }

    public function deleteMaterialsp(material_sp $material_sp)
    {
         $material_sp->delete();
         $this->confirmMaterialspDeletion = false;
         session()->flash('message','ลบวัสดุสำเร็จ');
    }

    //edit
    public function goMaterialspEdit(material_sp $material_sp)
    {
         $this->material_sp = $material_sp;
         $this->confirmMaterialspEdit = true;
    }


    public function saveEditMaterialsp()
    {
        $this->validate();
            $this->material_sp->save();
            session()->flash('message','แก้ไขสำเร็จ');
        
        $this->confirmMaterialspEdit = false;
    }
}
