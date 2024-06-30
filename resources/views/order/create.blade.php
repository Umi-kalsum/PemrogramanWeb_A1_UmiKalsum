@extends('main')
@section('content')


<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h5>DETAIL TRANSAKSI</h5>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    <form method="POST" action="{{ route('order.store') }}" id="order-form">
        @csrf

        <div class="form-group">
            <label for="table_number">Nomor Meja</label>
            <input type="text" class="form-control" id="table" name="table" required>
        </div>

        <div class="form-group">
            <label for="customer_name">Nama Pelanggan</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
        </div>

        <h3>Menu yang dipesan</h3>
        <table class="table" id="selected-items">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Items will be added here by JavaScript -->
            </tbody>
        </table>

        <h3>Menu List</h3>
        <input type="text" id="menu-filter" placeholder="Filter menu...">
        <table class="table">
            <thead>
                <tr>
                    <th>Menu Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="menu-list">
                @foreach($list_menu as $menu)
                <tr>
                    <td>{{ $menu->name }}</td>
                    <td>
                        <button type="button" class="btn btn-primary add-to-order" data-menu-id="{{ $menu->id }}" data-menu-name="{{ $menu->name }}" data-menu-price="{{ $menu->price }}">Add</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <input type="hidden" id="total-price-input" name="total_price">
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.add-to-order').forEach(function(button) {
            button.addEventListener('click', function () {
                const menuId = this.dataset.menuId;
                const menuName = this.dataset.menuName;
                const menuPrice = parseFloat(this.dataset.menuPrice); // Parse price as float
                const tbody = document.querySelector('#selected-items tbody');

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${menuName}</td>
                    <td><input type="number" name="items[${menuId}][quantity]" class="form-control" required></td>
                    <td><textarea type="text" name="items[${menuId}][notes]" class="form-control">
                    </textarea></td>
                    <td>
                        <input type="hidden" name="items[${menuId}][menu_id]" value="${menuId}">
                        <input type="hidden" name="items[${menuId}][price]" value="${menuPrice}">
                        <button type="button" class="btn btn-danger remove-item">Remove</button>
                    </td>
                `;
                tbody.appendChild(row);

                row.querySelector('.remove-item').addEventListener('click', function () {
                    row.remove();
                });
            });
        });

        document.getElementById('menu-filter').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('#menu-list tr').forEach(function(row) {
                const menuName = row.querySelector('td').textContent.toLowerCase();
                row.style.display = menuName.includes(filter) ? '' : 'none';
            });
        });

        document.getElementById('order-form').addEventListener('submit', function(event) {
            let totalPrice = 0;
            document.querySelectorAll('#selected-items tbody tr').forEach(function(row) {
                const qty = parseInt(row.querySelector('input[name*="[quantity]"]').value); // Parse qty as integer
                const price = parseFloat(row.querySelector('input[name*="[price]"]').value); // Parse price as float
                totalPrice += qty * price;
            });

            // Update the hidden input for total price
            document.getElementById('total-price-input').value = totalPrice.toFixed(2); // Set total price with two decimal places
        });
    });
</script>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const totalPriceInput = document.getElementById('total_price');
      t totalPrice = 0;

        document.querySelectorAll('.add-to-order').forEach(function (button) {
            button.addEventListener('click', function () {
                const menuId = this.dataset.menuId;
                const menuName = this.dataset.menuName;
                const menuPrice = parseFloat(this.dataset.menuPrice);
                // const menuPrice = this.dataset.menuName;
                const tbody = document.querySelector('#selected-items tbody');

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${menuName}</td>
                    <td><input type="number" name="items[${menuId}][qty]" class="form-control" required></td>
                    <td><input type="hidden" name="items[${menuId}][menu_price]" class="form-control" required></td>
                    <td><textarea type="text" name="items[${menuId}][notes]" class="form-control"></textarea></td>
                    <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
                `;
                tbody.appendChild(row);

                row.querySelector('.remove-item').addEventListener('click', function () {
                    const qtyInput = row.querySelector('.qty-input');
                    const qty = parseFloat(qtyInput.value) || 0;
                    totalPrice -= qty * menuPrice;
                    totalPriceInput.value = totalPrice.toFixed(2);
                    row.remove();
                });

                row.querySelector('.qty-input').addEventListener('input', function () {
                    const qty = parseFloat(this.value) || 0;
                    const oldTotalPrice = parseFloat(totalPriceInput.value) || 0;
                    totalPrice += qty * menuPrice - oldTotalPrice;
                    totalPriceInput.value = totalPrice.toFixed(2);
                });
            });
        });

        document.getElementById('menu-filter').addEventListener('input', function () {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('#menu-list tr').forEach(function (row) {
                const menuName = row.querySelector('td').textContent.toLowerCase();
                row.style.display = menuName.includes(filter) ? '' : 'none';
            });
        });
    });
</script> -->

@endsection