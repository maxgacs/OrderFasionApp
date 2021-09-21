<div class="p-6 sm:px-20 bg-white border-b border-gray-200">


    <div class="mt-8 text-2xl">
        ลูกค้าสมาชิก
    </div>

    <div class="mt=6">
        <table class="table-auto w-full">
            <thead>
                <tr>
                     <th class="px-4 py-2">
                        <div class="flex items-center">-</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">รูปสมาชิก</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ชื่อ</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ชื่อร้าน</div>
                    </th>
                    <th class="px-4 py-2">
                         <div class="flex items-center">เบอร์โทรศัพท์</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Email</div>
                    </th>
                    <th class="px-4 py-2">
                         <div class="flex items-center">ที่อยู่</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                 @foreach($members as $member)
                    <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td><img src="{{ url('/') }}/assets/uploadfile/user/{{ $member->memberImage  }} " alt="" style="width:64px;"></td>
                        <td class="border px-4 py-2">{{ $member->memberName }}</td>
                        <td class="border px-4 py-2">{{ $member->memberStoreName}}</td>
                        <td class="border px-4 py-2">{{ $member->memberPhone}}</td>
                        <td class="border px-4 py-2">{{ $member->memberEmail}}</td>
                        <td class="border px-4 py-2">{{ $member->memberAddress}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
    
</div>