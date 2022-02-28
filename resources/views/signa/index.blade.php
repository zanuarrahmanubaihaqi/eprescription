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
        <h1 class="h3 mb-4 text-gray-800">Data Signa</h1>
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
                        <th scope="col">Keterangan</th>
                        @if (auth()->user()->level == '1')
                          <th>Action</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $no = 1;
                      @endphp
                      @foreach ($signa as $data)
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $data->signa_kode }}</td>
                          <td>{{ $data->signa_nama }}</td>
                          @if (auth()->user()->level == '1')
                            <td>
                              <button data-toggle="modal" data-target="#edit_modal{{ $data->signa_id }}" class="btn btn-primary btn-sm" name="button">Edit</button>
                              <a href="{{route('signa.delete', $data->signa_id)}}" onclick="return confirm('Yakin ingin menghapus obat ini ?');" class="btn btn-danger btn-sm" name="button">Hapus</a>
                            </td>
                          @endif
                        </tr>
                        @php
                          $no++;
                        @endphp

                        <div class="modal fade" id="edit_modal{{ $data->signa_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="{{route('signa.update', $data->obatalkes_id)}}" method="get">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit {{ $data->signa_id }}</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  @csrf
                                  <div class="form-group">
                                    <label>Kode</label>
                                    <input type="text" name="signa_kode" class="form-control" value="{{ $data->signa_kode }}">
                                  </div>
                                  <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="signa_nama" class="form-control" value="{{ $data->signa_nama }}">
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
          <form action="{{route('signa.tambah')}}" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Signa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              @csrf
              <div class="form-group">
                <label>Kode</label>
                <input type="text" name="signa_kode" id="signa_kode" class="form-control">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="signa_nama" id="signa_nama" class="form-control">
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
