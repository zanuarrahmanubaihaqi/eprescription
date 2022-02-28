@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daily Report Master Data</h1>

    <div class="row justify-content-center">

        <div class="col-lg-12">

            <div class="card shadow mb-4">

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="table_daily">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Aktifitas Pemeliharaan</th>
                          <th scope="col">Standard</th>
                          <th scope="col">Time Est</th>
                          <th scope="col">Code</th>
                          <th scope="col">ACtion</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $no = 1;
                        @endphp
                        @foreach ($master_daily as $data)
                          <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->aktifitas_pemeliharaan}}</td>
                            <td>{{$data->standard}}</td>
                            <td>{{$data->time_est}}</td>
                            <td>{{$data->code}}</td>
                            <td>
                              <a href="#" class="btn btn-primary btn-sm">Edit</a>
                              <a href="#" class="btn btn-danger btn-sm">Delete</a>
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
    $('#table_daily').DataTable();
  });
  </script>
@endsection
