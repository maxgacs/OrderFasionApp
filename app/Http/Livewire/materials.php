<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\material;
use App\Models\materialType;
use Livewire\WithPagination;
use DB;
use Livewire\WithFileUploads;

class materials extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $confirmMaterialDeletion = false;
    public $material;
    public $materialType;
    public $confirmMaterialAdd = false;
    public $confirmMaterialTypeAdd = false;
    public $confirmMaterialEdit = false;
    public $materialTypeName;
    public $materialName;
    public $materialColor;
    public $materialSize;
    public $cutRate;
    public $materialTypeID= null;
    public $materialImage;

    protected $rules2 = [
        'materialType.materialTypeName' => 'required'
    ];

    protected $rules = [
        'material.materialName' => 'required',
        'material.materialColor' => 'required',
        'material.materialSize' => 'required',
        'material.cutRate' => 'required',
        'material.materialTypeID' => 'required',
    ];

    public function render()
    {
        $sql="SELECT * FROM materials
        INNER JOIN material_types ON materials.materialTypeID  = material_types.materialTypeID
        ORDER BY materialID DESC " ;
        $materials=DB::select($sql);   

        return view('livewire.materials', [
            'materials' => $materials
        ]);
    }

    //Delete
    public function confirmMaterialDeletion($material)
    {
        $this->confirmMaterialDeletion = $material;
    }

    public function deleteMaterial(material $material)
    {
         $material->delete();
         $this->confirmMaterialDeletion = false;
         session()->flash('message','ลบผ้าสำเร็จ');
    }

    //edit
    public function goMaterialEdit(material $material)
    {
         $this->material = $material;
         $this->confirmMaterialEdit = true;
    }


    public function saveEditMaterial()
    {
        $this->validate();
            $this->material->save();
            session()->flash('message','แก้ไขสำเร็จ');
        
        $this->confirmMaterialEdit = false;
    }

    //ADD Type

    public function confirmMaterialTypeAdd()
    {
        $this->resetInputFields();
        $this->reset(['materialType']);
        $this->confirmMaterialTypeAdd = true;
        $this->confirmMaterialAdd = false;
    }

    public function saveAddMaterialType()
    {
        $this->validate();
        $this->confirmMaterialTypeAdd = false;
    }

    public function resetInputFields2()
    {
        $this->materialTypeName='';
    }

    public function store2()
    {
        $validatesData = $this->validate([
            'materialTypeName' => 'required'
        ]);

        materialType::create($validatesData);
        session()->flash('message','เพิ่มผ้าสำเร็จ');
        $this->resetInputFields2();
        $this->confirmMaterialTypeAdd = false;
        
        $this->confirmMaterialAdd = true;
    }


    //ADD mat

    public function confirmMaterialAdd()
    {
        $this->resetInputFields();
        $this->reset(['material']);
        $this->confirmMaterialAdd = true;
    }

    public function saveAddMaterial()
    {
        $this->validate();
        $this->confirmMaterialAdd = false;
    }

    public function resetInputFields()
    {
        $this->materialName='';
        $this->materialColor='';
        $this->materialSize='';
        $this->materialTypeID='';
        $this->cutRate='';
        $this->materialImage='';
    }

    public function store()
    {
        $validatesData = $this->validate([
            'materialName' => 'required',
            'materialColor' => 'required',
            'materialSize' => 'required',
            'materialTypeID' => 'required',
            'cutRate' => 'required',
            'materialImage' => 'required'
        ]);
        $name=md5($this->materialImage.microtime()).'.'.$this->materialImage->extension();
        $validatesData['materialImage'] = $this->materialImage->storeAs('',$name);

        material::create($validatesData);
        session()->flash('message','เพิ่มสำเร็จ');
        $this->resetInputFields();
        $this->confirmMaterialAdd = false;
    }
}
