@extends('layouts.admin-seat4w')

@section('css')
  <style media="screen">
  .table thead th {
    text-align: center;
    vertical-align: middle;
  }
  .verticalTableHeader {
    text-align:center;
    width: 10px;
    white-space:nowrap;
    transform-origin:50% 50%;
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    transform: rotate(90deg);

    }
    .verticalTableHeader:before {
        content:'';
        /* padding-top:110%;/* takes width as reference, + 10% for faking some extra padding */ */
        display:inline-block;
        vertical-align:middle;
    }
  </style>
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="row">
  <div class="col">
    <h1 class="h3 mb-4 text-gray-800">Daily Report {{ $hari }} {{$nama_bulan}} {{$tahun}}</h1>
  </div>
  
    <div class="col float-right">
      {{-- <a class="btn btn-primary float-right" href="{{url('seat4w/report/daily/report/'.$reports['id'])}}">
        <i class="fas fa-fw fa-download"></i> Download</a> --}}
      <button type="button" id="btn-print" data-id="{{$reports['id']}}" class="btn btn-primary float-right" name="button"> <i class="fas fa-fw fa-download"></i> Download</button>
      </div>
  
</div>
@if (Session::has('message'))
  <div class="alert alert-success" role="alert">
    {{Session::get('message')}}
  </div>
@endif

<div class="row justify-content-center">
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
                <tr>
                  <td width="100%">Nama Mesin : {{ $reports['mesin'] }}</td>
                </tr>
                <tr>
                  <td>Proses : Assy Seat</td>
                </tr>
                <tr>
                  <td>Nomor</td>
                </tr>
                <tr>
                  <td>Serial</td>
                </tr>
                <tr>
                  <td>Area : Seat ASSY 4W</td>
                </tr>
                <tr>
                  <td>Petugas : {{ $reports['petugas'] }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Item Check</th>
                <th scope="col">Service</th>
                <th scope="col">Standard</th>
                <th scope="col">Time</th>
                <th scope="col">OK/NG</th>
                <th scope="col">Note 1</th>
                <th scope="col">Note 2</th>
                <th scope="col">Note 3</th>
                <th scope="col">Note 4</th>
                <th scope="col">Note 5</th>
                <th scope="col">Note 6</th>
                <th scope="col">Note 7</th>
                <th scope="col">Note 8</th>
                <th scope="col">Note 9</th>
                <th scope="col">Note 10</th>
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
                $itemcheck = $master_data[0]->item_check;
              @endphp

              @for ($i=0; $i < count($master_data); $i++)
                @php
                  $code = $master_data[$i]->kode;
                  $arr_kode = ["m1", "m2", "m3", "m4", "m5", "m6", "m7", "m8", "m9", "m10"];
                  
                  if (in_array($code, $arr_kode)) {
                @endphp
                <tr>
                  
                    <td>{{ $no }}</td>
                    @if ($no == 1)
                      @if ($master_data[$i]->item_check == $itemcheck)
                      <td rowspan="{{ count($master_data) }}">{{$master_data[$i]->item_check}}</td>
                      @endif
                    @endif
                    <td>{{ $master_data[$i]->service }}</td>
                    <td>{{ $master_data[$i]->standard }}</td>
                    <td>{{ $master_data[$i]->estimasi_waktu }} min</td>
                    <td>{{ $reports[$code] }}</td>
                    <td>{{ $reports['notem1'] }}</td>
                    <td>{{ $reports['notem2'] }}</td>
                    <td>{{ $reports['notem3'] }}</td>
                    <td>{{ $reports['notem4'] }}</td>
                    <td>{{ $reports['notem5'] }}</td>
                    <td>{{ $reports['notem6'] }}</td>
                    <td>{{ $reports['notem7'] }}</td>
                    <td>{{ $reports['notem8'] }}</td>
                    <td>{{ $reports['notem9'] }}</td>
                    <td>{{ $reports['notem10'] }}</td>
                    @php
                      $no = $no + 1;
                    @endphp
                  
                </tr>
                @php
                  }
                  $itemcheck = $master_data[$i]->item_check;
                @endphp
              @endfor
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

  $('#btn-print').click(function() {
    var id = $(this).data('id');
    printExternal(window.location.origin+'/maintenance-aski2/seat4w-report/daily/report/'+id);
  })

  function printExternal(url) {
      var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');

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
  </script>
@endsection
