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
        <h1 class="h3 mb-4 text-gray-800">Daily Report</h1>
      </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-lg-12">

            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="table-responsive">
                  <table border="0" cellspacing="5" cellpadding="5"  style="margin-left: -4px; margin-bottom: 10px;">
                    <tbody>
                      <tr>
                        <td>Mesin :</td>
                        <td>
                          <!-- <input type="text" id="tgl_pencarian" name="tgl_pencarian"> -->
                          <select name="select_mesin" id="select_mesin">
                            <option value="0">-</option>
                            @php foreach ($line_form as $key => $value): @endphp
                              <option value="@php echo $value->mesin; @endphp">
                                @php
                                  echo "MC ASSY SEAT 2W LINE " . $value->mesin;
                                @endphp
                              </option>
                            @php endforeach @endphp
                          </select>
                        </td>
                        <td>Bulan :</td>
                        <td>
                          <select name="select_mounth" id="select_mounth">
                            @php
                              $mounth = ['-','Januari', 'Fabruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                              foreach ($mounth as $key => $value): 
                            @endphp
                              <option value="@php echo $key; @endphp">
                                @php
                                  echo $value;
                                @endphp
                              </option>
                            @php endforeach @endphp
                          </select>
                        </td>
                        <td>
                          <button class="btn btn-primary btn-sm" id="show" onclick="showNewTable();">Show</button>
                        </td>
                        <td>
                          <button class="btn btn-secondary btn-sm" id="refresh">Refresh</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table" id="table_daily">
                    <thead id="head_table_daily">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Mesin</th>
                        <th scope="col">Tanggal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="body_table_daily">
                      @php
                        $no = 1;
                        $month_name = ['','Januari', 'Fabruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                      @endphp
                      @foreach ($reports as $data)
                        <tr>
                          <td>{{$no}}</td>
                          <td>MC SEEAT ASSY 2W LINE {{$data->mesin}}</td>
                          <td>{{ $data->hari }} {{$month_name[$data->bulan]}} {{$data->tahun}}</td>
                          <td>
                            <a href="{{url('report/daily/detail/'.$data->id)}}" class="btn btn-primary btn-sm" name="button">Detail</a>
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

    <div id="mesinModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p id="temp_text"></p>
            <div id="mesin_form_table">
              
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
      searching : false,
      sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
    });
  });

  $('#refresh').on('click', function(){
    $('#new_table_daily').hide();
    location.reload();
  });

  function showNewTable() {
    var mesin = $('#select_mesin').val();
    var mounth = $('#select_mounth').val();
    var no = 0;
    var tkonten = "";
    var month_name = ['','Januari', 'Fabruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    var temptgl = "";
    var tgl = "";
    const root_url = "{{ URL::to('/') }}";
    const daily_url = root_url.concat('/report/daily/newdatadaily/' + mesin + '/' + mounth);
    $('#table_daily').DataTable().destroy();
    $("#head_table_daily").html("");
    $("#body_table_daily").html("");
    tkonten += "<tr>"+
                  "<th scope='col'>Tanggal</th>"+
                  "<th scope='col'>Item Check</th>"+
                  "<th scope='col'>Service</th>"+
                  "<th scope='col'>Standard</th>"+
                  "<th scope='col'>Time</th>"+
                  "<th scope='col'>OK/NG</th>"+
                  "<th scope='col'>Note 1</th>"+
                  "<th scope='col'>Note 2</th>"+
                  "<th scope='col'>Note 3</th>"+
                  "<th scope='col'>PIC</th>"+
                "</tr>";
    $("#head_table_daily").html(tkonten);
    $.ajax({
      url: daily_url,
      type: 'GET',
      dataType: 'JSON',
      cache : false,
      success: function(response){
        if (response.reports.length == 0) {
          // alert("No Data Available !");
          return false;
        }
        var konten = "";
        var length = response.reports.length;
        var mlength = response.master_data.length;
        var itemchcek = "";
        var code = "";
        for (var i = 0; i < length; i++) {
          no = no + 1;
          for (var j = 0; j < mlength; j++) {
          const exturl = root_url.concat('/report/daily/detail/'+ response.master_data[j].id);
          code = response.master_data[j].kode;
            konten += "<tr>";
                        if (j == 0) {
                          tgl = response.reports[i].tanggal;
                          temptgl = tgl.substr(8, 9) + " " + month_name[parseInt(tgl.substr(5, 6))] + " " + tgl.substr(0, 4);
                          konten += 
                          "<td rowspan='" + mlength + "'>"+
                            temptgl +
                          "</td>" +
                          "<td rowspan='" + mlength + "'>"+
                            response.master_data[j].itemCheck +
                          "</td>";
                        }
                        konten += 
                        "<td>"+
                          response.master_data[j].service +
                        "</td>"+
                        "<td>"+
                          response.master_data[j].standard +
                        "</td>"+
                        "<td>"+
                          response.master_data[j].estimasiWaktu +
                        "</td>"+
                        "<td>"+
                          response.reports[i][code] +
                        "</td>"+
                        "<td>"+
                          response.reports[i].notem1 +
                        "</td>"+
                        "<td>"+
                          response.reports[i].notem2 +
                        "</td>"+
                        "<td>"+
                          response.reports[i].notem3 +
                        "</td>";
                        if (j == 0) {
                          konten +=
                          "<td rowspan='" + mlength + "'>"+
                            response.reports[i].petugas +
                          "</td>";
                        }
                      "</tr>";
          }
        }
        $("#body_table_daily").html("");
        $("#body_table_daily").html(konten);
        $('[name=table_daily_length]').attr('hidden', true);
        $('#table_daily_info').attr('hidden', true);
        $('#table_daily_paginate').attr('hidden', true);
      }
    });

    $('#table_daily').DataTable({
      "responsive" : true,
      // "processing": true,
      "sDom" : 'r<"H"lf><"datatable-scroll"t><"F"ip>',
      "searching" : false,
      "responsive": true,
    });
  }

  </script>
@endsection
