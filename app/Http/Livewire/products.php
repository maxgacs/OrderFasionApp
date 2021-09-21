<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\product;
use App\Models\choose_mat;
use App\Models\choose_mat_sp;
use Livewire\WithPagination;
use DB;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class products extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $confirmProductDeletion = false;
    public $product;
    public $confirmProductAdd = false;
    public $confirmProductEdit = false;
    public $confirmProductPrice = false;
    public $confirmProductMat = false;
    public $confirmProductMatsp = false;

    public $productName;
    public $productPriceSizeF;
    public $productPriceSizeS;
    public $productPriceSizeM;
    public $productPriceSizeL;
    public $productPriceSizeXL;
    public $productPriceSize2XL;
    public $productPriceSize3XL;
    public $productImage;
    public $material;
    public $materialName;
    public $materialID = null;
    public $material_spID = null;
    public $mainProductTypeID = null;
    public $productTypeID =null;
    public $productID=null;
    public $choose_mat = null;
    public $choose_matID = null;
    public $choose_mat_sp =null;
    public $choose_mat_spID =null;
    public $quanRate;

    //ของEdit
    protected $rules = [
        'product.productName' => 'required',
        'product.productPriceSizeF' => 'required',
        'product.productPriceSizeS' => 'required',
        'product.productPriceSizeM' => 'required',
        'product.productPriceSizeL' => 'required',
        'product.productPriceSizeXL' => 'required',
        'product.productPriceSize2XL' => 'required',
        'product.productPriceSize3XL' => 'required',
        'product.productImage' => 'required',
        'product.mainProductTypeID' => 'required',
        'product.productTypeID' => 'required',
    ];
    
    public function render()
    {

        $sql="SELECT * FROM products
        INNER JOIN product_types ON products.productTypeID  = product_types.productTypeID
        INNER JOIN main_product_types ON  products.mainProductTypeID =  main_product_types.mainProductTypeID
        ORDER BY productID DESC  "  ;
        $products=DB::select($sql); 

        return view('livewire.products', [
            'products' => $products
        ]);
    }


    //delete
    public function goProductDeletion($product)
    {
        $this->confirmProductDeletion = $product;
    }

    public function deleteProduct(product $product)
    {
         $product->delete();
         $this->confirmProductDeletion = false;
         session()->flash('message','ลบสินค้าสำเร็จ');
    }

    //view price
    public function confirmProductPrice()
    {
        $this->reset(['product']);
        $this->confirmProductPrice = true;
    }

    public function ProductPrice(product $product)
    {
         $this->product = $product;
         $this->confirmProductPrice = true;
    }

    //edit
    public function goProductEdit(product $product)
    {
         $this->product = $product;
         $this->confirmProductEdit = true;
    }


    public function saveEditProduct()
    {
        $this->validate();
            $this->product->save();
            session()->flash('message','แก้ไขสำเร็จ');
        
        $this->confirmProductEdit = false;
    }

    //ADD Product

    public function confirmProductAdd()
    {
        $this->resetInputFields();
        $this->reset(['product']);
        $this->confirmProductAdd = true;
    }

    public function saveAddProduct()
    {
        $this->validate();
        $this->confirmProductAdd = false;
        
    }

    public function resetInputFields()
    {
        $this->productName='';
        $this->productPriceSizeF='';
        $this->productPriceSizeS='';
        $this->productPriceSizeM='';
        $this->productPriceSizeL='';
        $this->productPriceSizeXL='';
        $this->productPriceSize2XL='';
        $this->productPriceSize3XL='';
        $this->productImage='';
        $this->mainProductTypeID='';
        $this->productTypeID='';
    }

   
    public function store()
   {
       
    $validatesData = $this->validate([
        'productName' => 'required',
        'productPriceSizeF' => 'required',
        'productPriceSizeS' => 'required',
        'productPriceSizeM' => 'required',
        'productPriceSizeL' => 'required',
        'productPriceSizeXL' => 'required',
        'productPriceSize2XL' => 'required',
        'productPriceSize3XL' => 'required',
        'productImage' => 'required|image|max:2048',
        'mainProductTypeID' => 'required',
        'productTypeID' => 'required',
       ]);
        $name=md5($this->productImage.microtime()).'.'.$this->productImage->extension();
        $validatesData['productImage'] = $this->productImage->storeAs('',$name);
        

        product::create($validatesData);
        session()->flash('message','เพิ่มสำเร็จ');
        $this->resetInputFields();
        $this->confirmProductAdd = false;
        $this->confirmProductMat = true;
    }

    //Add matt
    public function confirmProductMat()
    {
        $this->resetInputFieldsMat();
        $this->reset(['choose_mat']);
        $this->confirmProductMat = true;
    }

    public function saveAddMat()
    {
        $this->validate();
        $this->confirmProductMat = false;
        
    }

    public function resetInputFieldsMat()
    {
        $this->productID='';
        $this->materialID='';
    }

    public function resetInputFieldsMatAgain()
    {
        $this->materialID='';
    }

    public function storeMat()
   {
       
    $validatesData = $this->validate([
        'productID' => 'required',
        'materialID' => 'required',
       ]);
        

        choose_mat::create($validatesData);
        session()->flash('message','เลือกผ้าสำเร็จ');
        $this->resetInputFieldsMat();
        $this->confirmProductMat = false;
    }

    public function storeMatAgain()
   {
       
    $validatesData = $this->validate([
        'productID' => 'required',
        'materialID' => 'required',
       ]);
        

        choose_mat::create($validatesData);
        session()->flash('message','เลือกผ้าสำเร็จ');
        $this->resetInputFieldsMatAgain();
        $this->confirmProductMat = false;
        $this->confirmProductMat = true;
    }

    public function storeMatNext()
   {
       
    $validatesData = $this->validate([
        'productID' => 'required',
        'materialID' => 'required',
       ]);
        

        choose_mat::create($validatesData);
        session()->flash('message','เลือกผ้าสำเร็จ');
        $this->resetInputFieldsMat();
        $this->confirmProductMat = false;
        $this->confirmProductMatsp = true;
    }

    //Add mattSP
    public function confirmProductMatsp()
    {
        $this->resetInputFieldsMatsp();
        $this->reset(['choose_mat_sp']);
        $this->confirmProductMatsp = true;
    }

    public function saveAddMatsp()
    {
        $this->validate();
        $this->confirmProductMatsp = false;
        
    }

    public function resetInputFieldsMatsp()
    {
        $this->productID='';
        $this->material_spID='';
        $this->quanRate='';
    }

    public function resetInputFieldsMatspAgain()
    {
        $this->material_spID='';
        $this->quanRate='';
    }

    public function storeMatsp()
   {
       
    $validatesData = $this->validate([
        'productID' => 'required',
        'material_spID' => 'required',
        'quanRate' => 'required',
       ]);
        

        choose_mat_sp::create($validatesData);
        session()->flash('message','เลือกวัสดุย่อยสำเร็จ');
        $this->resetInputFieldsMatsp();
        $this->confirmProductMatsp = false;
    }

    public function storeMatspAgain()
   {
       
    $validatesData = $this->validate([
        'productID' => 'required',
        'material_spID' => 'required',
        'quanRate' => 'required',
       ]);
        
        choose_mat_sp::create($validatesData);
        session()->flash('message','เลือกวัสดุย่อยสำเร็จ');
        $this->resetInputFieldsMatspAgain();
        $this->confirmProductMatsp = false;
        $this->confirmProductMatsp = true;
    }

}
