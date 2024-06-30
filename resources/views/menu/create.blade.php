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
    <h5>DETAIL MENU</h5>

    <form id="form-data" method="post" action="{{route('menu.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="col-md-3 mb-3">
                <label for="validationTooltip05">Nama</label>
                <input type="text" class="form-control" id="menu_name" name="name" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationTooltip05">Harga</label>
                <input type="text" class="form-control" id="menu_price" name="price" required>
                <div class="invalid-tooltip">
                    Please provide a valid price.
                </div>
            </div>
            <label for="exampleFormControlSelect1">Tipe</label>
            <!-- <select class="form-control" id="type" name="type">
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
                <option value="snack"> Snack</option>
            </select> -->
            <div class="custom-control custom-radio">
                <input type="radio" id="makanan" name="type" class="custom-control-input" value="makanan">
                <label class="custom-control-label" for="customRadio1">Makanan</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="minuman" name="type" class="custom-control-input" value="minuman">
                <label class="custom-control-label" for="customRadio2">Minuman</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="snack" name="type" class="custom-control-input" value="snack">
                <label class="custom-control-label" for="customRadio3">Snack</label>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Deskripsi</label>
                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Gambar Menu</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Tambah Menu</button>
    </form>
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
</div>


@endsection