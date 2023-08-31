<x-layout>
    <x-slot:title>Brands</x-slot:title>
    <h1>Brands</h1>

    <table style="border:1px solid black; width:100%;">
        <tr>
            <th>Brand</th>
        </tr>

        @foreach( $brands as $brand)
                <tr>
                    <td>{{ $brand }}</td>
                </tr>
        @endforeach

    </table>
</x-layout>
