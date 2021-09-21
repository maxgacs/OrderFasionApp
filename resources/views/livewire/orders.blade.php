<div class="p-6 sm:px-20 bg-white border-b border-gray-200">


    <div class="mt-8 text-2xl">
        รายการสั่งซื้อ
    </div>

    <div class="mt=6">
        <table class="table-auto w-full">
            <thead>
                <tr>
                     <th class="px-4 py-2">
                        <div class="flex items-center">-</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">OrderID</div>
                    </th>
                    <th class="px-4 py-2">
                         <div class="flex items-center">ลูกค้า</div>
                    </th>
                    <th class="px-4 py-2">
                         <div class="flex items-center">ขั้นตอน</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ราคารวมออเดอร์นี้</div>
                    </th>
                    
                   
                   
                    
                </tr>
            </thead>
            <tbody>
                 @foreach($orders as $order)
                    <tr>
                         <td>{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $order->orderID}}</td>
                        <td class="border px-4 py-2">{{ $order->memberStoreName}}</td>
                        <td class="border px-4 py-2">{{ $order->stepStatusName}}</td>
                        <td class="border px-4 py-2">{{ $order->overdueMoney}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
    
</div>