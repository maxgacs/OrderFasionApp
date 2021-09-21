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

    <div class="mt-8 text-2xl">
        พนักงาน
    </div>

    <div class="mt=6">
        <table class="table-auto w-full">
            <thead>
                <tr>
                     <th class="px-4 py-2">
                        <div class="flex items-center">-</div>
                    </th>
                    <th class="px-4 py-2">
                        รูปพนักงาน
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ชื่อ</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">เบอร์โทรศัพท์</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ตำแหน่ง</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Email</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ที่อยู่</div>
                    </th>

                    

                    <th class="px-4 py-2">
                        ลบข้อมูล
                    </th>
                </tr>
            </thead>
            <tbody>
                 @foreach($emps as $emp)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ url('/') }}/assets/uploadfile/user/{{ $emp->empImage  }} "  alt="" style="width:64px;"></td>
                        <td class="border px-4 py-2">{{ $emp->empName }}</td>
                        <td class="border px-4 py-2">{{ $emp->empPhone}}</td>
                        <td class="border px-4 py-2">{{ $emp->nameEmpType}}</td>
                        <td class="border px-4 py-2">{{ $emp->empEmail}}</td>
                        <td class="border px-4 py-2">{{ $emp->empAddress}}</td>
                        
                        <td class="border px-4 py-2">
                            <x-jet-danger-button wire:click="confirmEmpDeletion({{$emp->empID}})" wire:loading.attr="disabled">
                                 Delete
                            </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Delete User Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingEmpDeletion">
            <x-slot name="title">
                {{ __('ลบพนักงาน') }}
            </x-slot>

            <x-slot name="content">
                {{ __('คุณแน่ใจหรือไม่ว่าจะลบพนักงานคนนี้?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmingEmpDeletion', false)" wire:loading.attr="disabled">
                    {{ __('ยกเลิก') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteEmployee({{$confirmingEmpDeletion}})" wire:loading.attr="disabled">
                    {{ __('ลบ') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>

     
    

</div>