@extends('layouts.admin-mirror')

@section('css')
  <style media="screen">
  .scrollable {
    overflow: auto;
  }

  .rotated-header th {
    height: 100px;
    vertical-align: bottom;
    text-align: left;
    line-height: 1;
  }

  .rotated-header-container {
    width: 21px;
  }

  .rotated-header-content {
    width: 300px;
    transform-origin: bottom left;
    transform: translateX(25px) rotate(-90deg);
    font-size: 12px;
  }

  .rotated-header td:not(:first-child) {
    text-align: left;
    font-size: 12px;
  }

  table {
    border-collapse: collapse;
  }

  table, td, th {
    border: 1px solid black;
  }
  /*
  td {
    width: 20px;
  } */

  td .ok-ng {
    font-size: 10px;
  }
  </style>
@endsection

@section('main-content')

@php
  $month_name = ['','Januari', 'Fabruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
@endphp
<!-- Page Heading -->
<div class="row">
  <div class="col">
    <h1 class="h3 mb-4 text-gray-800">Daily Report {{$month_name[$data['bulan']]}} - {{$data['tahun']}}</h1>
  </div>
  <div class="col float-right">
    <input type="hidden" id="tahun" value="{{$data['tahun']}}">
    <input type="hidden" id="bulan" value="{{$data['bulan']}}">
    <input type="hidden" id="mesin" value="{{$mesin}}">
    <input type="hidden" id="form" value="{{$form}}">
    <input type="hidden" id="No" value="{{$No}}">

    <button type="button" class="btn btn-primary float-right" id="btn-print">Export to PDF</button>
    {{-- <a class="btn btn-primary float-right" href="{{url('report/daily/report/'.$data['bulan'].'/'.$data['tahun'].'/'.$mesin.'/'.$form)}}">Export to PDF</a> --}}
  </div>
</div>

<div class="row justify-content-center" id="printJS-form">
  <div class="col-lg-12">
    <div class="accordion" id="accordionExample">
      <div class="card shadow mb-4">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Plan Maintenance
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    <td width="75%">Nama Mesin : MC ASSY MIRROR 4W LINE {{ $mesin }} STATION {{ $mesin }}</td>
                  </tr>
                  <tr>
                    <td>Proses</td>
                  </tr>
                  <tr>
                    <td>Nomor</td>
                  </tr>
                  <tr>
                    <td>Serial</td>
                  </tr>
                  <tr>
                    <td>Area : PI</td>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered rotated-header table-sm" border="1" width="20%">
            <thead>
              <tr>
                <td colspan="2" rowspan="3">
                  <img src="{{asset('img/logo.jpeg')}}" height="80" alt="">
                </td>
                <td colspan="25" rowspan="3" class="text-center text-lg align-middle" style="font-size:20px; text-align:center">Engineering Preventive Maintenance Program & Checklist (Daily Check)</td>
                <td colspan="4">No Document</td>
                <td colspan="4">FR-MNTC.01-035</td>
              </tr>
              <tr>
                <td colspan="4" style="font-size:12px;">Revision</td>
                <td colspan="4" style="font-size:12px;">04</td>
              </tr>
              <tr>
                <td colspan="4" style="font-size:12px;">Effective Start</td>
                <td colspan="4" style="font-size:12px;">01 Juni 2016</td>
              </tr>
              <tr>
                <td colspan="3" rowspan="5" class="text-center text-md align-middle" style="font-size:20px; text-align:center">Plan Maintenance</td>
                <td colspan="16">Nama Mesin : MC ASSY MIRROR 4W LINE {{ $mesin }} STATION {{ $mesin }}</td>
                <td colspan="8" class="text-center">Diketahui</td>
                <td colspan="4" class="text-center">Diperiksa</td>
                <td colspan="4" class="text-center">Dibuat Oleh</td>
              </tr>
              <tr>
                <td colspan="16" style="font-size:12px;">Proses : </td>
                <td colspan="4" rowspan="3" class="text-center">nama</td>
                <td colspan="4" rowspan="3" class="text-center">nama</td>
                <td colspan="4" rowspan="3" class="text-center">nama</td>
                <td colspan="4" rowspan="3" class="text-center">nama</td>
              </tr>
              <tr>
                <td colspan="16" style="font-size:12px;">Nomor : </td>
              </tr>
              <tr>
                <td colspan="16" style="font-size:12px;">Serial : </td>
              </tr>
              <tr>
                <td colspan="16" style="font-size:12px;">Area : </td>
                <td colspan="4" class="text-center">Dept Head prod</td>
                <td colspan="4" class="text-center">Dept Head Eng</td>
                <td colspan="4" class="text-center">Supervisor Engineering</td>
                <td colspan="4" class="text-center">Foreman Engineering</td>
              </tr>
              <tr>
                <td rowspan="2" width="10%" class="align-middle"><b>No</b></td>
                <td rowspan="2" class="align-middle"><b>Aktivitas Pemeliharaan</b></td>
                <td rowspan="2" class="align-middle"><b>Standar</b></td>
                <td class="text-center"><b>Time est</b></td>
                <td colspan="32" class="align-middle"><b>Pengecekan Kondisi</b></td>
              </tr>
              <tr>
                <td>Tgl</td>
                @for ($i=1; $i <= 31; $i++)
                  <td class="text-center">
                    <b>{{$i}}</b>
                    <a href="#">
                      <button type="button" class="btn btn-sm btn-warning" name="button">✔</button>
                    </a>
                  </td>
                @endfor
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td class="text-center align-middle">Operator Produksi</td>
                <td></td>
                <td></td>
                @for ($i=1; $i <= 31; $i++)
                  @foreach ($data['namaMP'] as $key => $val)
                    @php
                      $namaMP = '';
                      if ($key == $i) {
                        $namaMP = $val;
                        break;
                      }
                    @endphp
                  @endforeach
                  <th>
                    <div class="rotated-header-container">
                      <div class="rotated-header-content">{{$namaMP}}</div>
                    </div>
                  </th>
                @endfor
              </tr>
              @php
                $no = 1;
              @endphp
              @foreach ($master_data as $master)
                @php
                  $arr_form = explode(', ', $master->form);
                  $kode = $master->kode;
                @endphp
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$master->service}}</td>
                  <td>{{$master->standard}}</td>
                  <td class="text-center">{{$master->estimasiWaktu}}</td>
                  @for ($i=1; $i <= 31; $i++)
                    @php 
                      $arr_kode = ["m1", "m2", "m3", "m4", "m5"];
                      // dd($kode, $arr_kode, in_array($kode, $arr_kode), $form, $arr_form, in_array($form, $arr_form));
                      $namaMP = '';
                      if (in_array($kode, $arr_kode)) {
                    @endphp
                      @foreach ($data[$kode] as $key => $val)
                        @php
                          if ($key == $i) {
                            if (in_array($form, $arr_form)) {
                              $namaMP = $val;
                            } else {
                              $namaMP = '';
                            }
                          }
                        @endphp
                      @endforeach
                    @php
                      }
                    @endphp
                    <td class="ok-ng">{{$namaMP}}</td>
                  @endfor
                </tr>
                @php
                  $no++;
                @endphp
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
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

  $(document).ready(function() {
    $('#btn-print').click(function() {
      var bulan = $('#bulan').val();
      var tahun = $('#tahun').val();
      var mesin = $('#mesin').val();
      var form = $('#form').val();
      var No = $('#No').val();

      // printExternal(window.location.origin+'/mold-shop2/public/report/daily/report/'+bulan+'/'+tahun+'/'+mesin);
      printExternal(window.location.origin+'/maintenance-aski2/mirror-report/daily/report/'+bulan+'/'+tahun+'/'+mesin+'/'+form+'/'+No);
      // window.location.href = window.location.origin+'/internship-aski/mold-shop2/public/report/daily/report/'+bulan+'/'+tahun+'/'+mesin
    })

    function printExternal(url) {
        var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=1');

        printWindow.addEventListener('load', function() {
            if (Boolean(printWindow.chrome)) {
                printWindow.print();
                setTimeout(function(){
                    printWindow.close();
                }, 500);
            } else {
                printWindow.print();
                printWindow.close();
            }
        }, true);
    }
  })
  </script>
@endsection
