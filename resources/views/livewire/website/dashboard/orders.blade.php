{{-- <div>
    @if ($screen == 'orders')
    @if ($auth_user->orders->count() > 0)
        <div class="overflow-x-auto">
             <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Total</th>
                        <th class="px-4 py-2 border">Shipping</th>
                        <th class="px-4 py-2 border">Date</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auth_user->orders as $index => $order)
                        <tr>
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ ucfirst($order->status) }}</td>
                            <td class="px-4 py-2 border">${{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-2 border">${{ number_format($order->shipping_cost, 2) }}</td>
                            <td class="px-4 py-2 border">{{ $order->created_at}}</td>
                            <td class="px-4 py-2 border text-center">
                                <button wire:click="toggleOrderItems({{ $order->id }})" class="text-blue-600 hover:underline">
                                    {{ $expandedOrderId === $order->id ? 'Hide Items' : 'View Items' }}
                                </button>
                            </td>
                        </tr>

                        @if ($expandedOrderId === $order->id)
                            <tr>
                                <td colspan="6" class="px-4 py-4 border bg-gray-50">
                                    <div class="space-y-3">
                                        @foreach ($order->orderItems as $item)
                                            <div class="p-2 border rounded-md bg-white shadow-sm">
                                                <strong>Product:</strong> {{ $item->product_name }} <br>
                                                <strong>Quantity:</strong> {{ $item->quantity }} <br>
                                                <strong>Price:</strong> ${{ number_format($item->price, 2) }} <br>

                                                @if (!empty($item->variant_name))
                                                    <strong>Variant:</strong> {{ $item->variant_name }} <br>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-4 text-gray-600">
            No orders found.
        </div>
    @endif
@endif
</div> --}}


<div>
    @if ($screen == 'orders')
        @if ($auth_user->orders->count() > 0)
            <div class="cart-section">
                <table class="min-w-full bg-white border border-gray-200 text-md">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="p-2">#</th>
                            <th class="p-2">status</th>
                            <th class="p-2">total</th>
                            <th class="p-2">shipping</th>
                            <th class="p-2">date</th>
                            <th class="p-2">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($auth_user->orders as $order)
                            {{-- Order Row --}}
                            <tr class="border-t">
                                <td class="p-2">#{{ $order->id }}</td>
                                <td class="p-2">{{ $order->status }}</td>
                                <td class="p-2">EGP: {{ number_format($order->total_price, 2) }}</td>
                                <td class="p-2">{{ $order->street }} , {{ $order->city }}</td>
                                <td class="p-2 text-gray-500"> {{ $order->created_at }}</td>
                                <td class="p-2">
                                    <button wire:click="toggleOrderItems({{ $order->id }})"
                                        class="text-blue-600 hover:underline">
                                        {{ $expandedOrderId === $order->id ? 'Hide' : 'View' }} Items
                                    </button>
                                </td>
                            </tr>

                            {{-- show Order Items Row --}}
                            @if ($expandedOrderId === $order->id)
                                <tr>
                                    <td colspan="6" class="bg-gray-50 p-4">
                                        <div class="space-y-4">
                                            @foreach ($order->orderItems as $item)
                                                <div class="border p-3 rounded-md bg-white shadow-sm">
                                                    <div class="font-medium">Product Name: {{ $item->product_name }}
                                                    </div>
                                                    <div class="text-sm text-gray-600">Product Desc :
                                                        {{ $item->product_desc }}</div>
                                                    <div>Quantity:{{ $item->product_quantity }}</div>
                                                    <div>Price:{{ number_format($item->product_price, 2) }}</div>
                                                   
                                                    {{-- product have attributes --}}
                                                    @if ($item->attributes)
                                                        <div class="text-sm mt-1">
                                                            Attributes:
                                                            @foreach ($item->attributes as $key => $value)
                                                                <span
                                                                    class="inline-block bg-gray-200 px-2 py-1 rounded text-xs ">
                                                                    {{ $key }}: {{ $value }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif
</div>