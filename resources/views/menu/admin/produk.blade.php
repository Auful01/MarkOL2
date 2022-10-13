@extends('layouts.main')

@section('content')

<a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahProduk">Tambah Produk</a>
<br>
<table id="myTable" class="table display">
    <thead>
        <th>#</th>
        <th>User</th>
        <th>Gambar</th>
        <th>Deskripsi</th>
        <th>Harga</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php $no = 0; ?>
        @foreach ($produk as $k)

        <tr>
            <td>{{ $no +=1 }}</td>
            <td>{{$k->user->name}}</td>
            <td><img src="{{'storage/'.$k->gambar}}" style="width: 150px" alt=""></td>
            <td>{{$k->deskripsi}}</td>
            <td>{{$k->harga}}</td>

            <td>
                <div class="d-flex">
                    <a href="" class="btn btn-warning mr-1 btn-editProduk" data-target="#editProduk" data-toggle="modal" data-gambar="{{'storage/'.$k->gambar}}" data-np="{{$k->nama_produk}}" data-deskripsi="{{$k->deskripsi}}" data-harga="{{$k->harga}}" data-url="{{route('produkWeb.update', $k->id)}}"><i class="far fa-edit"></i></a>
                    <form action="{{route('produkWeb.destroy',$k->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  onclick="return confirm('Apakah anda yakin ingin menghapus file ini?')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('modal')
    {{-- Tambah Produk --}}
    <div class="modal fade" id="tambahProduk"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="{{route('produkWeb.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gambar</label>
                    <input type="file" name="gambar" class="form-control" id="gambar" aria-describedby="emailHelp">
                    <!--<img src="" class="gambar" alt="">-->
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Harga</label>
                    <input type="text" name="harga" class="form-control " id="harga" aria-describedby="emailHelp">
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control " id="nama_produk" aria-describedby="emailHelp">
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control " id="deskripsi" cols="30" rows="10"></textarea>
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                  </div>

                  {{-- <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> --}}
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
          </div>
          {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> --}}
        </div>
      </div>
    </div>

    {{-- edit produk --}}
    <div class="modal fade" id="editProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="" class="url" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gambar</label>
                    <input type="file" name="gambar" class="form-control" id="gambar" aria-describedby="emailHelp">
                    <img src="" class="gambar" alt="" style="width: 100px">
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Harga</label>
                    <input type="text" name="harga" class="form-control harga" id="harga" aria-describedby="emailHelp">
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control nama_produk" id="nama_produk" aria-describedby="emailHelp">
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control konten" id="deskripsi" cols="30" rows="10"></textarea>
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
          </div>
          {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> --}}
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $('.btn-editProduk').on('click', function () {
            let desc = $(this).data('deskripsi')
            let gambar = $(this).data('gambar')
            let harga = $(this).data('harga')
            let np = $(this).data('np')
            let url = $(this).data('url')
            $('.deskripsi').val(desc)
            $('.gambar').attr('src', gambar)
            $('.nama_produk').val(np)
            $('.harga').val(harga)
            $('.url').attr('action', url)
        })
        
    
    var rupiah = document.getElementById("harga");
rupiah.addEventListener("keyup", function(e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  rupiah.value = formatRupiah(this.value, "Rp. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

    </script>
    @endsection
