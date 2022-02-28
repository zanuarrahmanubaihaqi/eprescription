@extends('layouts.admin')

@section('css')
  <style media="screen">
  #table_daily {
    /* overflow-x: auto;
    overflow-y: visible; */
  }
  </style>
@endsection

@section('main-content')

  @if (Session::has('message'))
    <div class="alert alert-success" role="alert">
      {{Session::get('message')}}
    </div>
  @endif
    <!-- Page Heading -->
    <div class="row">
      <div class="col">
        <h1 class="h3 mb-4 text-gray-800">Data Obat</h1>
      </div>
      <div class="col">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#add_modal" name="button">Tambah</button>
      </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-lg-12">

            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="table_daily">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Stok</th>
                        @if (auth()->user()->level == '1')
                          <th>Action</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $no = 1;
                      @endphp
                      @foreach ($obat as $data)
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $data->obatalkes_kode }}</td>
                          <td>{{ $data->obatalkes_nama }}</td>
                          <td>{{ $data->stok * 1 }}</td>
                          @if (auth()->user()->level == '1')
                            <td>
                              <button data-toggle="modal" data-target="#edit_modal{{ $data->obatalkes_id }}" class="btn btn-primary btn-sm" name="button">Edit</button>
                              <a href="{{route('obat.delete', $data->obatalkes_id)}}" onclick="return confirm('Yakin ingin menghapus obat ini ?');" class="btn btn-danger btn-sm" name="button">Hapus</a>
                            </td>
                          @endif
                        </tr>
                        @php
                          $no++;
                        @endphp

                        <div class="modal fade" id="edit_modal{{ $data->obatalkes_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="{{route('obat.update', $data->obatalkes_id)}}" method="get">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit {{ $data->obatalkes_nama }}</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  @csrf
                                  <div class="form-group">
                                    <label>Nama Obat</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $data->obatalkes_nama }}">
                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Kode Obat</label>
                                        <input type="text" name="username" class="form-control" value="{{ $data->obatalkes_kode }}">
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Stok</label>
                                        <input type="text" name="password" class="form-control" value="{{ $data->stok }}">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('obat.tambah')}}" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Obat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              @csrf
              <div class="form-group">
                <label>Nama Obat</label>
                <input type="text" name="obatalkes_nama" id="obatalkes_nama" class="form-control">
              </div>
              <div class="form-group">
                <label>Kode Obat</label>
                <input type="text" name="obatalkes_kode" id="obatalkes_kode" class="form-control">
              </div>
              <div class="form-group">
                <label>Stok</label>
                <input type="text" name="stok" id="stok" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

@endsection

@section('js')
  <script type="text/javascript">
  $(document).ready( function () {
    $('#table_daily').DataTable({
      responsive: true,
      sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
    });
  });
  </script>
@endsection
