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
<!-- Page Heading -->
<div class="row">
  <div class="col">
    <h1 class="h3 mb-4 text-gray-800">Very High Report</h1>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="table_daily">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Petugas</th>
                <th scope="col">Lama Waktu</th>
                <th scope="col">Waktu Input</th>
                <th scope="col">Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @foreach ($reports as $data)
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$data->petugas}}</td>
                  <td>{{$data->lamaWaktu}}</td>
                  <td>{{$data->tanggal}}</td>
                  <td>
                    @php
                      switch (auth()->user()->level) {
                        case '4':
                          if ($data->approval1 != "") {
                            echo '<span class="badge badge-success">Approved Supervisor</span>';
                          } else {
                            echo '<span class="badge badge-warning text-dark">Waiting</span>';
                          }
                        break;

                        default:
                          if ($data->approval1 != "") {
                            echo '<span class="badge badge-success">Approved Supervisor</span>';
                          } else {
                            echo '<span class="badge badge-warning text-dark">Waiting</span>';
                          }
                          break;
                      }
                    @endphp
                  </td>
                  <td>
                    <a class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="Detail" href="{{route('report.mVH.detail', $data->id)}}">
                      <i class="fas fa-fw fa-eye"></i></a>
                    </button>
                    @if ($data->approval1 != "")
                      {{-- <a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Download" href="{{url('report/mVH/report/'.$data->id)}}">
                        <i class="fas fa-fw fa-download"></i></a> --}}
                      <button type="button" id="btn-print" name="btn-print" class="btn btn-primary btn-sm" data-id="{{$data->id}}"><i class="fas fa-fw fa-download"></i></button>
                    @endif
                  </td>
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
      "order": [[ 4, "asc" ]],
      sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
    });
  });

  $('[name=btn-print]').click(function() {
    var id = $(this).data('id');
    var url = '{{url('report/mVH/report/')}}'+'/'+id
    printExternal(url);
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
