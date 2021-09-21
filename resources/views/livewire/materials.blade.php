<?php $parts = DB::connection('mysql')->select('select * from material_types');?> 
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
        <div>จัดการผ้า</div>

        <div class="mr-2">
            <x-jet-button wire:click="confirmMaterialAdd" class="bg-green-500 hover:bg-green-400 ">
                Add New Materials
            </x-jet-button>
         </div>
    </div>

    <div class="mt=6">
        <table class="table-auto w-full">
            <thead>
                <tr>
                     <th class="px-4 py-2">
                        <div class="flex items-center">-</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">สี</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ID</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ชื่อผ้า</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ประเภทเนื้อผ้า</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ความยาว(หลา)</div>
                    </th>
                    <th class="px-4 py-2">
                        จัดการ
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                 @foreach($materials as $material)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ url('/') }}/storage/{{ $material->materialImage  }} " alt="" style="width:64px;"></td>
                        <td class="border px-4 py-2">{{ $material->materialID }}</td>
                        <td class="border px-4 py-2">{{ $material->materialName}}</td>
                        <td class="border px-4 py-2">{{ $material->materialTypeName}}</td>
                        <td class="border px-4 py-2">{{ number_format($material->materialSize,2)}}</td>
                        <td class="border px-4 py-2">

                            <x-jet-button wire:click="goMaterialEdit({{$material->materialID}})" class="bg-yellow-500 hover:bg-yellow-400 ">
                                Edit
                            </x-jet-button>

                            <x-jet-danger-button wire:click="confirmMaterialDeletion({{$material->materialID}})" wire:loading.attr="disabled">
                                 Delete
                            </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
     <!-- Delete -->
     <x-jet-confirmation-modal wire:model="confirmMaterialDeletion">
            <x-slot name="title">
                {{ __('ลบข้อมูลผ้า') }}
            </x-slot>

            <x-slot name="content">
                {{ __('คุณแน่ใจหรือไม่ว่าจะลบผ้าชิ้นนี้?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmMaterialDeletion', false)" wire:loading.attr="disabled">
                    {{ __('ยกเลิก') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteMaterial({{$confirmMaterialDeletion}})" wire:loading.attr="disabled">
                    {{ __('ลบ') }}
                </x-jet-danger-button>

                
            </x-slot>
        </x-jet-confirmation-modal>

        <!-- Add Type Mat Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmMaterialTypeAdd">
            <x-slot name="title">
                เพิ่มประเภทผ้า
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="materialTypeName" value="{{ __('ชื่อประเภทผ้า') }}" />
                <x-jet-input id="materialTypeName"  type="text" class="mt-1 block w-full" wire:model="materialTypeName" />
                <x-jet-input-error for="materialTypeName" class="mt-2"/>
            </div>
            
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmMaterialTypeAdd', false)" wire:loading.attr="disabled">
                    {{ __('ยกเลิก') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="store2()"  wire:loading.attr="disabled" class="bg-blue-500 hover:bg-blue-400 ">
                    {{ __('เพิ่ม') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

        

    
        <!-- Add Mat Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmMaterialAdd">
            <x-slot name="title">
                เพื่มข้อมูลผ้า
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="materialName" value="{{ __('ชื่อผ้า') }}" />
                <x-jet-input id="materialName"  type="text" class="mt-1 block w-full" wire:model="materialName" />
                <x-jet-input-error for="materialName" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="materialColor" value="{{ __('สี') }}" />
                <x-jet-input id="materialColor"  type="text" class="mt-1 block w-full" wire:model="materialColor" />
                <x-jet-input-error for="materialColor" class="mt-2"/>
            </div>


            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="materialSize" value="{{ __('ขนาดผ้า(หลา)') }}" />
                <x-jet-input id="materialSize"  type="number" class="mt-1 block w-full" wire:model="materialSize" />
                <x-jet-input-error for="materialSize" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="materialTypeID" class="control-label" value="{{ __('ประเภทเนื้อผ้า') }}" />
                <select class="form-control"  wire:model="materialTypeID">
                        <option value="" selected>เลือกประเภท</option>
                        @foreach($parts as $row)
                            <option value="{{$row->materialTypeID}}">{{$row->materialTypeName}}</option>
                        @endforeach    
                </select>
                {{$materialTypeID}}
                <x-jet-button wire:click="confirmMaterialTypeAdd" class="bg-blue-500 hover:bg-blue-400 ">
                    Add New Type
                </x-jet-button>
                <x-jet-input-error for="materialTypeID" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="cutRate" value="{{ __('ช่างตัดตัดตัวละ(บาท)') }}" />
                <x-jet-input id="cutRate"  type="number" class="mt-1 block w-full" wire:model="cutRate" />
                <x-jet-input-error for="cutRate" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="materialImage" value="{{ __('รูปสี') }}" />
                <x-jet-input id="materialImage"  type="file" class="mt-1 block w-full" wire:model="materialImage" />
                <x-jet-input-error for="materialImage" class="mt-2"/>
            </div>

            
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmMaterialAdd', false)" wire:loading.attr="disabled">
                    {{ __('ยกเลิก') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="store()"  wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-400 ">
                    {{ __('เพิ่ม') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

         <!-- Edit  Confirmation Modal -->
         <x-jet-dialog-modal wire:model="confirmMaterialEdit">
            <x-slot name="title">
                แก้ไขข้อมูลผ้า
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="materialName" value="{{ __('ชื่อผ้า') }}" />
                <x-jet-input id="materialName"  type="text" class="mt-1 block w-full" wire:model.defer="material.materialName" />
                <x-jet-input-error for="materialName" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="materialColor" value="{{ __('ชื่อสีผ้า') }}" />
                <x-jet-input id="materialColor"  type="text" class="mt-1 block w-full" wire:model.defer="material.materialColor" />
                <x-jet-input-error for="materialColor" class="mt-2"/>
            </div>

            

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="materialSize" value="{{ __('ขนาดผ้า(หลา)') }}" />
                <x-jet-input id="materialSize"  type="number" class="mt-1 block w-full" wire:model.defer="material.materialSize" />
                <x-jet-input-error for="materialSize" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="materialTypeID" class="control-label" value="{{ __('ประเภทผ้า') }}" />
                <select class="form-control"  wire:model="material.materialTypeID">
                        <option value="" selected>เลือกประเภท</option>
                        @foreach($parts as $row)
                            <option value="{{$row->materialTypeID}}">{{$row->materialTypeName}}</option>
                        @endforeach    
                </select>
                {{$materialTypeID}}
                <x-jet-input-error for="materialTypeID" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="cutRate" value="{{ __('ช่างตัดตัดตัวละ(บาท)') }}" />
                <x-jet-input id="cutRate"  type="number" class="mt-1 block w-full" wire:model="material.cutRate" />
                <x-jet-input-error for="cutRate" class="mt-2"/>
            </div>

            
            </x-slot>


            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmMaterialEdit', false)" wire:loading.attr="disabled">
                    {{ __('ยกเลิก') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="saveEditMaterial()"  wire:loading.attr="disabled" class="bg-yellow-500 hover:bg-yellow-400 ">
                    {{ __('แก้ไข') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    
</div>