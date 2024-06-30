@extends('main')

@section('content')
<div class="container">
    <h5>DAFTAR MENU</h5>
    <div>
        <input type="text" id="menu-filter" placeholder="Filter menu...">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Type</th>
                    <th>Harga Menu</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="menu-list">
                @foreach ($list_menu as $menu)
                    <tr>
                        <td>{{$menu->name}}</td>
                        <td>{{$menu->type}}</td>
                        <td>{{$menu->price}}</td>
                        <td>
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-danger">Del</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <a class="btn btn-primary" href="{{route('menu.create')}}">
        Tambahkan Menu
    </a>
    <!-- When there is no desire, all things are at peace. - Laozi -->
</div>
<script>
    document.getElementById('menu-filter').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('#menu-list tr').forEach(function(row) {
                const menuName = row.querySelector('td').textContent.toLowerCase();
                row.style.display = menuName.includes(filter) ? '' : 'none';
            });
        });
</script>
@endsection