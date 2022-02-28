@extends('layouts.admin-mirror')

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
    <h1 class="h3 mb-4 text-gray-800">High Report {{$nama_bulan}} - {{$tahun}}</h1>
  </div>
  @if ($reports['approval'] != "")
    <div class="col float-right">
      {{-- <a class="btn btn-primary float-right" href="{{url('report/m1/report/'.$reports['id'])}}">
        <i class="fas fa-fw fa-download"></i> Download</a> --}}
        <button type="button" id="btn-print" data-id="{{$reports['id']}}" class="btn btn-primary float-right" name="button"> <i class="fas fa-fw fa-download"></i> Download</button>
      </div>
  @endif
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
                  <td width="40%">Nama Mesin : {{$reports['mesin']}}</td>
                  <td width="20%" rowspan="5" class="text-center signature">
                    Approval <br>
                    Supervisor<br><br><br><br><br>
                    @if ($reports['approval'] != "")
                      <i>Approved By</i> {{$reports['approval']}}<br>
                      <i>On</i> {{$reports['tglapprove']}}
                    @elseif (Auth::guard('adminmirror')->user()->level == 4)
                      <a href="{{route('mirror-report.m6.approve', $reports['id'])}}" class="btn btn-primary btn-sm" name="button">
                        <i class="fas fa-fw fa-edit"></i> Setujui</a>
                    @endif
                  </td>
                  {{-- <td width="20%" rowspan="5" class="text-center signature">
                    Approval 2 <br>
                    Foreman<br><br><br><br><br>
                    @if ($reports['approval2'] != "")
                      <i>Approved By</i> {{$reports['approval2']}}<br>
                      <i>On</i> {{$reports['tglapprove2']}}
                    @elseif (auth()->user()->level == 3)
                      @if ($reports['approval1'] == "")
                        <i>Waiting Leader</i>
                      @else
                        <a href="{{route('report.m6.approve2', $reports['id'])}}" class="btn btn-primary btn-sm" name="button">
                        <i class="fas fa-fw fa-edit"></i> Setujui</a>
                      @endif
                    @endif
                  </td>
                  <td width="20%" rowspan="5" class="text-center signature">
                    Approval 3 <br>
                    Supervisor<br><br><br><br><br>
                    @if ($reports['approval3'] != "")
                      <i>Approved By</i> {{$reports['approval3']}}<br>
                      <i>On</i> {{$reports['tglapprove3']}}
                    @elseif (auth()->user()->level == 4)
                      @if ($reports['approval1'] == "")
                        Waiting Leader
                      @elseif ($reports['approval2'] == "")
                        Waiting Foreman
                      @else
                        <a href="{{route('report.m6.approve3', $reports['id'])}}" class="btn btn-primary btn-sm" name="button">
                        <i class="fas fa-fw fa-edit"></i> Setujui</a>
                      @endif
                    @endif
                  </td> --}}
                </tr>
                <tr>
                  <td>Proses : Molding</td>
                </tr>
                <tr>
                  <td>Nomor</td>
                </tr>
                <tr>
                  <td>Serial</td>
                </tr>
                <tr>
                  <td>Area : MIRROR ASSY 4W</td>
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
                <th scope="col">Remark</th>
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
                $itemcheck = '';
              @endphp
              @for ($i=0; $i < count($master_data); $i++)
                @php
                  $code = $master_data[$i]->kode;
                @endphp
                <tr>
                  <td>{{$no}}</td>
                  @if ($master_data[$i]->itemCheck != $itemcheck)
                    {{-- <td rowspan="{{array_count_values($itemchecks)[$master_data[$i]->itemCheck]}}">{{$master_data[$i]->itemCheck}}</td> --}}
                    <td>{{$master_data[$i]->itemCheck}}</td>
                  @else
                    <td></td>
                  @endif
                  <td>{{$master_data[$i]->service}}</td>
                  <td>{{$master_data[$i]->standard}}</td>
                  <td>{{$master_data[$i]->estimasiWaktu}} min</td>
                  <td>{{$reports[$code]}}</td>
                  <td></td>
                </tr>
                @php
                  $no++;
                  $itemcheck = $master_data[$i]->itemCheck;
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
    printExternal(window.location.origin+'/maintenance-aski2/mirror-report/m6/report/'+id);
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
