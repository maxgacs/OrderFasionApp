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
        <div>จัดการวัสดุย่อย</div>

        <div class="mr-2">
            <x-jet-button wire:click="confirmMaterialspAdd" class="bg-green-500 hover:bg-green-400 ">
                Add New Sub materials
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
                        <div class="flex items-center">ID</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ชื่อ</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ขนาด</div>
                    </th>
                    <th class="px-4 py-2">
                         <div class="flex items-center">ราคา</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">จำนวน</div>
                    </th>
                    <th class="px-4 py-2">
                        จัดการ
                    </th>
                </tr>
            </thead>
            <tbody>
                 @foreach($material_sps as $material_sp)
                    <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td class="border px-4 py-2">{{ $material_sp->material_spID}}</td>
                        <td class="border px-4 py-2">{{ $material_sp->material_spName }}</td>
                        <td class="border px-4 py-2">{{ $material_sp->material_spSize}}</td>
                        <td class="border px-4 py-2">{{ number_format($material_sp->material_spPrice,2)}}</td>
                        <td class="border px-4 py-2">{{ $material_sp->material_spQuan}}</td>
                        <td class="border px-4 py-2">     
                            <x-jet-button wire:click="goMaterialspEdit({{$material_sp->material_spID}})" class="bg-yellow-500 hover:bg-yellow-400 ">
                                Edit
                             </x-jet-button>

                            <x-jet-danger-button wire:click="confirmMaterialspDeletion({{$material_sp->material_spID}})" wire:loading.attr="disabled">
                                 Delete
                            </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

     <!-- Add Mat Confirmation Modal -->
     <x-jet-dialog-modal wire:model="confirmMaterialspAdd">
            <x-slot name="title">
                เพิ่มวัสดุย่อย
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="material_spName" value="{{ __('ชื่อวัสดุ') }}" />
                <x-jet-input id="material_spName"  type="text" class="mt-1 block w-full" wire:model="material_spName" />
                <x-jet-input-error for="material_spName" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="material_spSize" value="{{ __('ขนาด') }}" />
                <x-jet-input id="material_spSize"  type="text" class="mt-1 block w-full" wire:model="material_spSize" />
                <x-jet-input-error for="material_spSize" class="mt-2"/>
            </div>


            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="material_spPrice" value="{{ __('ราคา') }}" />
                <x-jet-input id="material_spPrice"  type="number" class="mt-1 block w-full" wire:model="material_spPrice" />
                <x-jet-input-error for="material_spPrice" class="mt-2"/>
            </div>

            
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="material_spQuan" value="{{ __('จำนวน') }}" />
                <x-jet-input id="material_spQuan"  type="number" class="mt-1 block w-full" wire:model="material_spQuan" />
                <x-jet-input-error for="material_spQuan" class="mt-2"/>
            </div>

            
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmMaterialspAdd', false)" wire:loading.attr="disabled">
                    {{ __('ยกเลิก') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="store()"  wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-400 ">
                    {{ __('เพิ่ม') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

        <!-- Delete -->
     <x-jet-confirmation-modal wire:model="confirmMaterialspDeletion">
            <x-slot name="title">
                {{ __('ลบข้อมูลวัสดุย่อย') }}
            </x-slot>

            <x-slot name="content">
                {{ __('คุณแน่ใจหรือไม่ว่าจะลบวัสดุชิ้นนี้?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmMaterialspDeletion', false)" wire:loading.attr="disabled">
                    {{ __('ยกเลิก') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteMaterialsp({{$confirmMaterialspDeletion}})" wire:loading.attr="disabled">
                    {{ __('ลบ') }}
                </x-jet-danger-button>

                
            </x-slot>
        </x-jet-confirmation-modal>

        <!-- Edit  Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmMaterialspEdit">
            <x-slot name="title">
                แก้ไขข้อมูลวัดุย่อย
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="material_spName" value="{{ __('ชื่อวัสดุ') }}" />
                <x-jet-input id="material_spName"  type="text" class="mt-1 block w-full" wire:model.defer="material_sp.material_spName" />
                <x-jet-input-error for="material_spName" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="material_spSize" value="{{ __('ขนาด') }}" />
                <x-jet-input id="material_spSize"  type="text" class="mt-1 block w-full" wire:model.defer="material_sp.material_spSize" />
                <x-jet-input-error for="material_spSize" class="mt-2"/>
            </div>

            

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="material_spPrice" value="{{ __('ราคา') }}" />
                <x-jet-input id="material_spPrice"  type="number" class="mt-1 block w-full" wire:model.defer="material_sp.material_spPrice" />
                <x-jet-input-error for="material_spPrice" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="material_spQuan" value="{{ __('จำนวน') }}" />
                <x-jet-input id="material_spQuan"  type="number" class="mt-1 block w-full" wire:model="material_sp.material_spQuan" />
                <x-jet-input-error for="material_spQuan" class="mt-2"/>
            </div>

            
            </x-slot>


            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmMaterialspEdit', false)" wire:loading.attr="disabled">
                    {{ __('ยกเลิก') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="saveEditMaterialsp()"  wire:loading.attr="disabled" class="bg-yellow-500 hover:bg-yellow-400 ">
                    {{ __('แก้ไข') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

    
    
</div>