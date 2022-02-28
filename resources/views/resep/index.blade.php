@extends('layouts.admin')

@section('css')
  <style media="screen">
  #table_daily {
    /* overflow-x: auto;
    overflow-y: visible; */
  }

  .select2 {
    width: 100% !important;
  }

  .racikan:hover {
    cursor: not-allowed !important;
  }
  </style>
@endsection

@section('main-content')

  @if (session('message'))
    <div class="alert alert-success" role="alert">
      {{ session('message') }}
    </div>
  @endif
    <!-- Page Heading -->
    <div class="row">
      <div class="col">
        <h1 class="h3 mb-4 text-gray-800">Data Resep</h1>
      </div>
      <div class="col">
        {{-- <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#add_modal" name="button">Tambah</button> --}}
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card shadow mb-4">
          <div class="card-body">
            <form action="{{ route('resep.tambah') }}" method="POST">
              @csrf
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nama Pasien</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="pasien_nama" id="pasien_nama">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Nama Dokter</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="dokter_nama" id="dokter_nama">
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Nama Apoteker</label>
                    <input type="text" name="apoteker_nama" id="apoteker_nama" class="form-control">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Tanggal Resep</label>
                    <input type="date" name="tgl_resep" id="tgl_resep" class="form-control">
                  </div>
                </div>
              </div>
              {{-- <div class="form-group row">
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="pasien_nama" value="Nama Obat" readonly>
                </div>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="pasien_nama" value="Nama Signa" readonly>
                </div>
                <div class="col-sm-4">
                  <div class="float-right">
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger">Hapus</button>
                  </div>
                </div>
              </div> --}}
              <input type="hidden" name="temp_obat" id="temp_obat" value="1">
              <input type="hidden" name="temp_obat_racikan" id="temp_obat_racikan" value="1">
              <div class="form-group row" id="row_obat" style="padding-top: 2px; padding-bottom: 2px;">
              </div>
              <div class="form-group row" id="row_obat_racikan" style="padding-top: 2px; padding-bottom: 2px;">
              </div>
              <div class="row">
                <div class="col">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_obat" name="button_obat"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Obat</button>
                  <button type="button" class="btn btn-success racikan" data-toggle="modal" data-target="#modal_obat_racikan_" name="button_obat_racikan"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Obat Racikan</button>
                  <button type="button" class="btn btn-danger" name="button_batal" onclick="refreshPage();"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-primary float-right" name="button_simpan"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
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
                    <th scope="col">Nomor Resep</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Nama Dokter</th>
                    @if (auth()->user()->level == '1')
                      <th>Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach ($resep as $data)
                    <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $data->transaction_id }}</td>
                      <td>{{ $data->pasien_nama }}</td>
                      <td>{{ $data->dokter_nama }}</td>
                      @if (auth()->user()->level == '1')
                        <td>
                          <button data-toggle="modal" data-target="#detail_modal{{ $data->transaction_id }}" class="btn btn-primary btn-sm" onclick="showDetail('{{ $data->transaction_id }}')" name="button_detai"><i class="fa fa-book" aria-hidden="true"></i> Detail</button>
                          <button class="btn btn-success btn-sm" onclick="showDetail('{{ $data->transaction_id }}')" name="button_cetak"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
                        </td>
                      @endif
                    </tr>
                    @php
                      $no++;
                    @endphp

                    <div class="modal fade" id="detail_modal{{ $data->transaction_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form action="{{route('obat.update', $data->transaction_id)}}" method="get">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Detail {{ $data->pasien_nama }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              @csrf
                              <div class="form-group">
                                <label>Nama Pasein</label>
                                <input type="text" name="pasien_nama" class="form-control" value="{{ $data->pasien_nama }}" readonly>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Nomor Resep</label>
                                    <input type="text" name="transaction_id" class="form-control" value="{{ $data->transaction_id }}" readonly>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                    <label>Nama Dokter</label>
                                    <input type="text" name="dokter_nama" class="form-control" value="{{ $data->dokter_nama }}" readonly>
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
              <h5 class="modal-title" id="exampleModalLabel">Tambah Resep</h5>
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

    <div class="modal fade" id="modal_obat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <form action=""> -->
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Obat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Obat</label>
                <select class="form-control select-obat" name="obatalkes_id" id="obatalkes_id">
                  <option>-</option>
                  @foreach ($obat as $obats)
                    <option value="{{ $obats->obatalkes_id }}">{{ $obats->obatalkes_nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Signa</label>
                <select class="form-control select-signa" name="signa_id" id="signa_id">
                  <option>-</option>
                  @foreach ($signa as $signas)
                    <option value="{{ $signas->signa_id }}">({{ $signas->signa_kode }}) {{ $signas->signa_nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Qty</label>
                <input type="text" name="qty" id="qty" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="addObat();">Tambahkan</button>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_edit_obat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <form action=""> -->
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Obat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Obat</label>
                <select class="form-control select-obat" name="obatalkes_edit_id" id="obatalkes_edit_id">
                  <option>-</option>
                  @foreach ($obat as $obats)
                    <option value="{{ $obats->obatalkes_id }}">{{ $obats->obatalkes_nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Signa</label>
                <select class="form-control select-signa" name="signa_edit_id" id="signa_edit_id">
                  <option>-</option>
                  @foreach ($signa as $signas)
                    <option value="{{ $signas->signa_id }}">({{ $signas->signa_kode }}) {{ $signas->signa_nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Qty</label>
                <input type="text" name="qty_edit" id="qty_edit" class="form-control">
                <input type="hidden" name="temp_id" id="temp_id">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="updateObat();">Ubah</button>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_obat_racikan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <form action=""> -->
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Obat Racikan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Resep</label>
                <input type="text" name="resep_nama" id="resep_nama" class="form-control">
              </div>
              <div class="form-group">
                <label>Nama Obat</label>
                <select class="form-control select-obat-racikan" name="obatalkes_racikan_id[]" id="obatalkes_racikan_id" multiple="multiple">
                  <option>-</option>
                  @foreach ($obat as $obats)
                    <option value="{{ $obats->obatalkes_id }}">{{ $obats->obatalkes_nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Signa</label>
                <select class="form-control select-signa" name="signa_racikan_id" id="signa_racikan_id">
                  <option>-</option>
                  @foreach ($signa as $signas)
                    <option value="{{ $signas->signa_id }}">({{ $signas->signa_kode }}) {{ $signas->signa_nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Qty</label>
                <input type="text" name="qty_racikan" id="qty_racikan" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="addObatRacikan();">Tambahkan</button>
            </div>
          <!-- </form> -->
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
    $('#temp_obat').val(1);
  });

  function refreshPage() {
    window.location.reload();
  }

  function addObat() {
    var temp_obat = $('#temp_obat').val();
    var the_temp = parseInt(1) + parseInt(temp_obat);
    var konten = "";
    konten += '<div class="col-sm-4">' +
              '<input type="text" class="form-control" id="obatalkes_nama' + the_temp + '" name="obatalkes_nama' + the_temp + '">' +
              '<input type="hidden" id="obatalkes_id' + the_temp + '" name="obatalkes_id' + the_temp + '">' +
            '</div>' +
            '<div class="col-sm-4">' +
              '<input type="text" class="form-control" id="signa_nama' + the_temp + '" name="signa_nama' + the_temp + '">' +
              '<input type="hidden" id="signa_id' + the_temp + '" name="signa_id' + the_temp + '">' +
            '</div>' +
            '<div class="col-sm">' +
              '<input type="text" class="form-control" id="qty' + the_temp + '" name="qty' + the_temp + '">' +
            '</div>' +
            '<div class="col-sm-3">' +
              '<div class="float-right">' +
                '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_edit_obat" name="button_edit_obat' + the_temp + '" id="button_edit_obat' + the_temp + '" onclick="editObat(' + the_temp + ')">Edit</button>' +
                '<button type="button" class="btn btn-danger" name="button_delete_obat' + the_temp + '" id="button_delete_obat' + the_temp + '" onclick="deleteObat(' + the_temp + ')">Hapus</button>' +
              '</div>' +
            '</div>';
    $('#temp_obat').val(the_temp);
    $('#row_obat').append(konten);
    $('#obatalkes_nama' + the_temp).val($('#select2-obatalkes_id-container').text());
    $('#obatalkes_id' + the_temp).val($('#obatalkes_id').val());
    $('#signa_nama' + the_temp).val($('#select2-signa_id-container').text());
    $('#signa_id' + the_temp).val($('#signa_id').val());
    $('#qty' + the_temp).val($('#qty').val());
    $('#select2-obatalkes_id-container').text("");
    $('#select2-obatalkes_id-container').remove('title');
    $('#select2-signa_id-container').text("");
    $('#select2-signa_id-container').remove('title');
    $('#qty').val("");    
  }

  function editObat(id) {
    $('#select2-obatalkes_edit_id-container').text($('#obatalkes_nama' + id).val());
    $('#obatalkes_edit_id').val($('#obatalkes_id' + id).val());
    $('#select2-signa_edit_id-container').text($('#signa_nama' + id).val());
    $('#signa_edit_id').val($('#obatalkes_id' + id).val());
    $('#qty_edit').val($('#qty' + id).val());
    $('#temp_id').val(id);
  }

  function updateObat() {
    var temp_id = $('#temp_id').val();
    $('#obatalkes_nama' + temp_id).removeAttr('value');
    $('#obatalkes_id' + temp_id).removeAttr('value');
    $('#signa_nama' + temp_id).removeAttr('value');
    $('#signa_id' + temp_id).removeAttr('value');
    $('#qty' + temp_id).removeAttr('value');    
    $('#obatalkes_nama' + temp_id).val($('#select2-obatalkes_edit_id-container').text());
    $('#obatalkes_id' + temp_id).val($('#obatalkes_edit_id').val());
    $('#signa_nama' + temp_id).val($('#select2-signa_edit_id-container').text());
    $('#signa_id' + temp_id).val($('#signa_edit_id').val());
    $('#qty' + temp_id).val($('#qty_edit').val());
    $('#select2-obatalkes_edit_id-container').text("");
    $('#select2-signa_edit_id-container').text("");
    $('#qty_edit').val("");
  }

  function deleteObat(id) {
    $('#obatalkes_nama' + id).remove();
    $('#obatalkes_id' + id).remove();
    $('#signa_nama' + id).remove();
    $('#signa_id' + id).remove();
    $('#qty' + id).remove();
    $('#button_edit_obat' + id).remove();
    $('#button_delete_obat' + id).remove();
  }

  function addObatRacikan() {
    var temp_obat_racikan = $('#temp_obat_racikan').val();
    var the_temp = parseInt(1) + parseInt(temp_obat_racikan);
    var konten = "";
    konten += '<div class="col-sm-2">' +
                '<input type="text" class="form-control" id="resep_nama' + the_temp + '" name="resep_nama' + the_temp + '">' +
              '</div>' +
              '<div class="col-sm-3">' +
                '<input type="text" class="form-control" id="obatalkes_racikan_nama' + the_temp + '" name="obatalkes_racikan_nama' + the_temp + '">' +
                '<input type="hidden" id="obatalkes_racikan_id' + the_temp + '" name="obatalkes_racikan_id' + the_temp + '">' +
              '</div>' +
              '<div class="col-sm-3">' +
                '<input type="text" class="form-control" id="signa_racikan_nama' + the_temp + '" name="signa_racikan_nama' + the_temp + '">' +
                '<input type="hidden" id="signa_racikan_id' + the_temp + '" name="signa_racikan_id' + the_temp + '">' +
              '</div>' +
              '<div class="col-sm">' +
                '<input type="text" class="form-control" id="qty_racikan' + the_temp + '" name="qty_racikan' + the_temp + '">' +
              '</div>' +
              '<div class="col-sm-3">' +
                '<div class="float-right">' +
                  '<button class="btn btn-primary">Edit</button>' +
                  '<button class="btn btn-danger">Hapus</button>' +
                '</div>' +
              '</div>';
    $('#temp_obat_racikan').val(the_temp);
    $('#row_obat').append(konten);
    $('#resep_nama' + the_temp).val($('#resep_nama').val());
    $('#obatalkes_racikan_nama' + the_temp).val($('#select2-selection__choice').text());
    $('#obatalkes_racikan_id' + the_temp).val($('#obatalkes_racikan_id').val());
    $('#signa_racikan_nama' + the_temp).val($('#select2-signa_racikan_id-container').text());
    $('#signa_racikan_id' + the_temp).val($('#signa_racikan_id').val());
    $('#qty_racikan' + the_temp).val($('#qty_racikan').val());
    $('#select2-selection__choice').text("");
    $('#select2-signa_racikan_id-container').text("");
    $('#qty_racikan').val("");
  }

  $('.select-obat').select2();
  $('.select-obat-racikan').select2();
  $('.select-signa').select2();
  </script>
@endsection
