@extends('main')

@section('content')
<div class="container">
    <h5>DAFTAR TRANSAKSI</h5>
    <div>
        <input type="text" id="order-filter" placeholder="Filter Transaksi...">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No Meja</th>
                    <th>Nama Customer</th>
                    <th>Total Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="order-list">
                @if(count($list_order) < 1)
                    <tr>
                        <td colspan="4">-</td>
                    </tr>
                @else
                    @foreach ($list_order as $order)
                        <tr>
                            <td>{{$order->table}}</td>
                            <td>{{$order->customer_name}}</td>
                            <td>{{$order->total_price}}</td>
                            <td>
                                <button class="btn btn-primary">Edit</button>
                                <button class="btn btn-danger">Del</button>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>

    </div>
    <a class="btn btn-primary" href="{{route('order.create')}}">
        BUAT TRANSAKSI
    </a>
    <!-- When there is no desire, all things are at peace. - Laozi -->
</div>
<script>
    document.getElementById('order-filter').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        document.querySelectorAll('#order-list tr').forEach(function (row) {
            const menuName = row.querySelector('td').textContent.toLowerCase();
            row.style.display = menuName.includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection