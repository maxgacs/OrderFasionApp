<?php $parts = DB::connection('mysql')->select('select * from product_types');?> 
<?php $parts2 = DB::connection('mysql')->select('select * from main_product_types');?> 
<?php $parts3 = DB::connection('mysql')->select('select * from materials');?> 
<?php $parts4 = DB::connection('mysql')->select('select * from material_sps');?>                                                     
<?php $parts5 = DB::connection('mysql')->select('select * from products');?> 

<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    @if(session()->has('message'))
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md relative" role="alert" x-data="{show:true}" x-show="show">
        <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                    <p class="font-bold">แจ้งเตือน</p>
                    <p class="text-sm">{{session('message')}}</p>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show=false">
                        <svg class="fill-current h-6 w-6 text-black-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            </div>
    </div>
    @endif

    <div class="mt-8 text-2xl flex justify-between">
        <div>จัดการสินค้า</div>

        <div class="mr-2">
            <x-jet-button wire:click="confirmProductMat" class="bg-pink-500 hover:bg-pink-400 ">
                Add New Fabric 
            </x-jet-button>
            <x-jet-button wire:click="confirmProductMatsp" class="bg-pink-500 hover:bg-pink-400 ">
                Add New sub 
            </x-jet-button>
            <x-jet-button wire:click="confirmProductAdd" class="bg-green-500 hover:bg-green-400 ">
                Add New Product
            </x-jet-button>
         </div>

    </div>

    <div class="mt=6">
        <table class="table-auto w-full  mt-2">
            <thead>
                <tr>
                     <th class="px-4 py-2">
                        <div class="flex items-center">-</div>
                    </th>
                    
                    <th class="px-4 py-2">
                        <div class="flex items-center">รูปสินค้า</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ID</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ชื่อสินค้า</div>
                    </th>
                    <th class="px-4 py-2">
                         <div class="flex items-center">ประเภท</div>
                    </th>
                    <th class="px-4 py-2">
                         <div class="flex items-center">ความยาว</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ขายได้</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ราคาเหมา</div>
                    </th>
                    <th class="px-4 py-2">
                        แก้ไขข้อมูล
                    </th>
                    <th class="px-4 py-2">
                        ลบข้อมูล
                    </th>
                </tr>
            </thead>
            <tbody>
                 @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ url('/') }}/storage/{{ $product->productImage  }} " alt="" style="width:64px; height:64px;"></td>
                        <td class="border px-4 py-2">{{ $product->productID }}</td>
                        <td class="border px-4 py-2">{{ $product->productName}}</td>
                        <td class="border px-4 py-2">{{ $product->mainProductTypeName}}</td>
                        <td class="border px-4 py-2">{{ $product->typeName}}</td>
                        <td class="border px-4 py-2">{{ $product->productSold}}</td>
                        <td class="border px-4 py-2">
                            <x-jet-button wire:click="ProductPrice({{$product->productID}})" class="bg-blue-500 hover:bg-blue-400 ">
                                Price
                            </x-jet-button>
                        </td>
                        <td class="border px-4 py-2 ">

                            <x-jet-button wire:click="goProductEdit({{$product->productID}})" class="bg-yellow-500 hover:bg-yellow-400 ">
                                Edit
                             </x-jet-button>

                            
                        </td>
                        <td class="border px-4 py-2 ">

                        <x-jet-danger-button wire:click="goProductDeletion({{$product->productID}})" wire:loading.attr="disabled" >
                                Delete
                            </x-jet-danger-button>

                                                    
                         </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

    <!-- Delete User Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmProductDeletion">
            <x-slot name="title">
                {{ __('ลบสินค้า') }}
            </x-slot>

            <x-slot name="content">
                {{ __('คุณแน่ใจหรือไม่ว่าจะลบสินค้าชิ้นนี้?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmProductDeletion', false)" wire:loading.attr="disabled" >
                    {{ __('ยกเลิก') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteProduct({{$confirmProductDeletion}})" wire:loading.attr="disabled">
                    {{ __('ลบ') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>

        <!-- Add product Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmProductAdd">
            <x-slot name="title">
               เพิ่มสินค้า
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="productName" value="{{ __('ชื่อสินค้า') }}" />
                <x-jet-input id="productName"  type="text" class="mt-1 block w-full" wire:model="productName" />
                <x-jet-input-error for="productName" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="mainProductTypeID" class="control-label" value="{{ __('ประเภท') }}" />
                <select class="form-control"  wire:model="mainProductTypeID">
                        <option value="" selected>--เลือกประเภท-- </option>
                        @foreach($parts2 as $row2)
                            <option value="{{$row2->mainProductTypeID}}">{{$row2->mainProductTypeName}}</option>
                        @endforeach    
                </select>
                {{$mainProductTypeID}}
                <x-jet-input-error for="mainProductTypeID" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productTypeID" class="control-label" value="{{ __('ความยาว') }}" />
                <select class="form-control"  wire:model="productTypeID">
                        <option value="" selected>--เลือกความยาว-- </option>
                        @foreach($parts as $row)
                            <option value="{{$row->productTypeID}}">{{$row->typeName}}</option>
                        @endforeach    
                </select>
                {{$productTypeID}}
                <x-jet-input-error for="productTypeID" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeF" value="{{ __('ราคาไซส์F') }}" />
                <x-jet-input id="productPriceSizeF"   type="number" class="mt-1 block w-full" wire:model="productPriceSizeF" />
                <x-jet-input-error for="productPriceSizeF" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeS" value="{{ __('ราคาไซส์S') }}" />
                <x-jet-input id="productPriceSizeS"  type="number" class="mt-1 block w-full" wire:model="productPriceSizeS" />
                <x-jet-input-error for="productPriceSizeS" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeM" value="{{ __('ราคาไซส์M') }}" />
                <x-jet-input id="productPriceSizeM"  type="number" class="mt-1 block w-full" wire:model="productPriceSizeM" />
                <x-jet-input-error for="productPriceSizeM" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeL" value="{{ __('ราคาไซส์L') }}" />
                <x-jet-input id="productPriceSizeL"  type="number" class="mt-1 block w-full" wire:model="productPriceSizeL" />
                <x-jet-input-error for="productPriceSizeL" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeXL" value="{{ __('ราคาไซส์XL') }}" />
                <x-jet-input id="productPriceSizeXL"  type="number" class="mt-1 block w-full" wire:model="productPriceSizeXL" />
                <x-jet-input-error for="productPriceSizeXL" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSize2XL" value="{{ __('ราคาไซส์2XL') }}" />
                <x-jet-input id="productPriceSize2XL"  type="number" class="mt-1 block w-full" wire:model="productPriceSize2XL" />
                <x-jet-input-error for="productPriceSize2XL" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSize3XL" value="{{ __('ราคาไซส์3XL') }}" />
                <x-jet-input id="productPriceSize3XL"  type="number" class="mt-1 block w-full" wire:model="productPriceSize3XL" />
                <x-jet-input-error for="productPriceSize3XL" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productImage" value="{{ __('รูป') }}" />
                <x-jet-input id="productImage"  type="file" class="mt-1 block w-full" wire:model="productImage" />
                <x-jet-input-error for="productImage" class="mt-2"/>
            </div>



            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmProductAdd', false)" wire:loading.attr="disabled">
                    {{ __('ยกเลิก') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="store()"  wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-400 ">
                    {{ __('เพิ่ม') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

        

        <!-- Edit product Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmProductEdit">
            <x-slot name="title">
               แก้ไขสินค้า 
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="productName" value="{{ __('ชื่อสินค้า') }}" />
                <x-jet-input id="productName"  type="text" class="mt-1 block w-full" wire:model.defer="product.productName" />
                <x-jet-input-error for="productName" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="mainProductTypeID" class="control-label" value="{{ __('ประเภท') }}" />
                <select class="form-control"  wire:model="product.mainProductTypeID">
                        <option value="" selected>--เลือกประเภท--</option>
                        @foreach($parts2 as $row2)
                            <option value="{{$row2->mainProductTypeID}}">{{$row2->mainProductTypeName}}</option>
                        @endforeach    
                </select>
                {{$mainProductTypeID}}
                <x-jet-input-error for="productTypeID" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productTypeID" class="control-label" value="{{ __('ความยาว') }}" />
                <select class="form-control"  wire:model="product.productTypeID">
                        <option value="" selected>--เลือกความยาว-- </option>
                        @foreach($parts as $row)
                            <option value="{{$row->productTypeID}}">{{$row->typeName}}</option>
                        @endforeach    
                </select>
                {{$productTypeID}}
                <x-jet-input-error for="productTypeID" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeF" value="{{ __('ราคาไซส์F') }}" />
                <x-jet-input id="productPriceSizeF"   type="number" class="mt-1 block w-full" wire:model.defer="product.productPriceSizeF" />
                <x-jet-input-error for="productPriceSizeF" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeS" value="{{ __('ราคาไซส์S') }}" />
                <x-jet-input id="productPriceSizeS"  type="number" class="mt-1 block w-full" wire:model.defer="product.productPriceSizeS" />
                <x-jet-input-error for="productPriceSizeS" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeM" value="{{ __('ราคาไซส์M') }}" />
                <x-jet-input id="productPriceSizeM"  type="number" class="mt-1 block w-full" wire:model.defer="product.productPriceSizeM" />
                <x-jet-input-error for="productPriceSizeM" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeL" value="{{ __('ราคาไซส์L') }}" />
                <x-jet-input id="productPriceSizeL"  type="number" class="mt-1 block w-full" wire:model.defer="product.productPriceSizeL" />
                <x-jet-input-error for="productPriceSizeL" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeXL" value="{{ __('ราคาไซส์XL') }}" />
                <x-jet-input id="productPriceSizeXL"  type="number" class="mt-1 block w-full" wire:model.defer="product.productPriceSizeXL" />
                <x-jet-input-error for="productPriceSizeXL" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSize2XL" value="{{ __('ราคาไซส์2XL') }}" />
                <x-jet-input id="productPriceSize2XL"  type="number" class="mt-1 block w-full" wire:model.defer="product.productPriceSize2XL" />
                <x-jet-input-error for="productPriceSize2XL" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSize3XL" value="{{ __('ราคาไซส์3XL') }}" />
                <x-jet-input id="productPriceSize3XL"  type="number" class="mt-1 block w-full" wire:model.defer="product.productPriceSize3XL" />
                <x-jet-input-error for="productPriceSize3XL" class="mt-2"/>
            </div>

            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmProductEdit', false)" wire:loading.attr="disabled">
                    {{ __('ยกเลิก') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="saveEditProduct()"  wire:loading.attr="disabled" class="bg-yellow-500 hover:bg-yellow-400 ">
                    {{ __('แก้ไข') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>


        <!-- View Pricel -->
        <x-jet-dialog-modal wire:model="confirmProductPrice">
            <x-slot name="title">
                ดูราคาทุกไซส์
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="productName" value="{{ __('ชื่อสินค้า') }}" />
                <x-jet-input id="productName"  type="text" class="mt-1 block w-full" wire:model.defer="product.productName" disabled/>
                <x-jet-input-error for="productName" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeF" value="{{ __('ราคาไซส์F') }}" />
                <x-jet-input id="productPriceSizeF"  type="text" class="mt-1 block w-full" wire:model.defer="product.productPriceSizeF" disabled/>
                <x-jet-input-error for="productPriceSizeF" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeS" value="{{ __('ราคาไซส์S') }}" />
                <x-jet-input id="productPriceSizeS"  type="text" class="mt-1 block w-full" wire:model.defer="product.productPriceSizeS" disabled/>
                <x-jet-input-error for="productPriceSizeS" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeM" value="{{ __('ราคาไซส์M') }}" />
                <x-jet-input id="productPriceSizeM"  type="text" class="mt-1 block w-full" wire:model.defer="product.productPriceSizeM" disabled/>
                <x-jet-input-error for="productPriceSizeM" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeL" value="{{ __('ราคาไซส์L') }}" />
                <x-jet-input id="productPriceSizeL"  type="text" class="mt-1 block w-full" wire:model.defer="product.productPriceSizeL" disabled/>
                <x-jet-input-error for="productPriceSizeL" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSizeXL" value="{{ __('ราคาไซส์XL') }}" />
                <x-jet-input id="productPriceSizeXL"  type="text" class="mt-1 block w-full" wire:model.defer="product.productPriceSizeXL" disabled/>
                <x-jet-input-error for="productPriceSizeXL" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSize2XL" value="{{ __('ราคาไซส์2XL') }}" />
                <x-jet-input id="productPriceSize2XL"  type="text" class="mt-1 block w-full" wire:model.defer="product.productPriceSize2XL" disabled/>
                <x-jet-input-error for="productPriceSize2XL" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="productPriceSize3XL" value="{{ __('ราคาไซส์3XL') }}" />
                <x-jet-input id="productPriceSize3XL"  type="text" class="mt-1 block w-full" wire:model.defer="product.productPriceSize3XL" disabled/>
                <x-jet-input-error for="productPriceSize3XL" class="mt-2"/>
            </div>
            
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmProductPrice', false)" wire:loading.attr="disabled">
                    {{ __('กลับ') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>



        <!-- Mat product Confirmation Modal -->
        <x-jet-dialog-modal  wire:model="confirmProductMat" >
            <x-slot name="title" >
               เลือกผ้าให้สินค้า 
            </x-slot>
            <x-slot name="content" >
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-jet-label for="productID" class="control-label" value="{{ __('สินค้า') }}" />
                    <select class="form-control"  wire:model="productID">
                            <option value="" selected>--เลือกสินค้า-- </option>
                            @foreach($parts5 as $row5)
                                <option value="{{$row5->productID}}">{{$row5->productName}}</option>
                            @endforeach    
                    </select>
                    {{$productID}}
                    <x-jet-input-error for="productID" class="mt-2"/>
                </div>

                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-jet-label for="materialID" class="control-label" value="{{ __('เลือกผ้า') }}" />
                    <select class="form-control"  wire:model="materialID">
                            <option value="" selected>--เลือกผ้า-- </option>
                            @foreach($parts3 as $row3)
                                <option value="{{$row3->materialID}}">{{$row3->materialName}}</option>
                            @endforeach    
                    </select>
                    {{$materialID}}
                    <x-jet-input-error for="materialID" class="mt-2"/>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmProductMat', false)" wire:loading.attr="disabled">
                    {{ __('กลับ') }}
                </x-jet-secondary-button>

                <x-jet-secondary-button class="ml-2" wire:click="storeMatAgain()"  wire:loading.attr="disabled"  >
                    {{ __('ตกลงและเลือกผ้าอีกครั้ง') }}
                </x-jet-secondary-button>

                <x-jet-secondary-button class="ml-2"  wire:click="storeMatNext()" wire:loading.attr="disabled"  >
                    {{ __('ตกลงและไปเลือกวัสดุย่อย') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="storeMat()"  wire:loading.attr="disabled" class="bg-pink-500 hover:bg-pink-400 ">
                    {{ __('ตกลง') }}
                </x-jet-danger-button>
                
            </x-slot>
        </x-jet-dialog-modal>

        <!-- MatSP product Confirmation Modal -->
        <x-jet-dialog-modal  wire:model="confirmProductMatsp" >
            <x-slot name="title" >
               เลือกวัสดุย่อยให้สินค้า 
            </x-slot>
            <x-slot name="content" >
                <div class="col-span-6 sm:col-span-4 mt-2">
                        <x-jet-label for="productID" class="control-label" value="{{ __('สินค้า') }}" />
                        <select class="form-control"  wire:model="productID">
                                <option value="" selected>--เลือกสินค้า-- </option>
                                @foreach($parts5 as $row5)
                                    <option value="{{$row5->productID}}">{{$row5->productName}}</option>
                                @endforeach    
                        </select>
                        {{$productID}}
                        <x-jet-input-error for="productID" class="mt-2"/>
                </div>

                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-jet-label for="material_spID" class="control-label" value="{{ __('เลือกผ้า') }}" />
                    <select class="form-control"  wire:model="material_spID">
                            <option value="" selected>--เลือกวัสดุย่อย-- </option>
                            @foreach($parts4 as $row4)
                                <option value="{{$row4->material_spID}}">{{$row4->material_spName}}</option>
                            @endforeach    
                    </select>
                    {{$material_spID}}
                    <x-jet-input-error for="material_spID" class="mt-2"/>
                </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="quanRate" value="{{ __('จำนวนวัสดุย่อยที่ใช้') }}" />
                <x-jet-input id="quanRate"   type="number" class="mt-1 block w-full"  wire:model="quanRate" />
                <x-jet-input-error for="quanRate" class="mt-2"/>
            </div>


            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmProductMatsp', false)" wire:loading.attr="disabled">
                    {{ __('กลับ') }}
                </x-jet-secondary-button>

                <x-jet-secondary-button class="ml-2"  wire:click="storeMatspAgain()" wire:loading.attr="disabled"  >
                    {{ __('ตกลงและเลือกวัสดุย่อยอีกครั้ง') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="storeMatsp()"  wire:loading.attr="disabled" class="bg-pink-500 hover:bg-pink-400 ">
                    {{ __('ตกลง') }}
                </x-jet-danger-button>

            </x-slot>

            
        </x-jet-dialog-modal>


       
    
</div>
