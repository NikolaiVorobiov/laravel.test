<x-layout>
    <x-slot:title>Orders</x-slot:title>
    <h1>Orders</h1>

    <table style="border:1px solid black; width:100%;">
        <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Total price</th>
            <th>Currency</th>
        </tr>

        @foreach( $orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->totalPrice }}</td>
                <td>Grivna</td>
            </tr>
        @endforeach

    </table>

</x-layout>
