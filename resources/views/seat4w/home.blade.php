@extends('layouts.admin-seat4w')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl col-md-6 mb-3">
          <a href="{{route('seat4w-report.daily.index')}}" style="text-decoration: none;">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">DAILY Report</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0 Report</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <p class="text-danger"><b>menunggu approval</b></p>

                </div>
            </div>
          </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl col-md-6 mb-3" style="display:none;">
            <a href="{{route('seat4w-report.m1.index')}}" style="text-decoration: none;">
              <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-md font-weight-bold text-success text-uppercase mb-1">SMALL Report</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($reportM1)}} Report</div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                          </div>
                      </div>
                      <p class="text-danger"><b>menunggu approval</b></p>

                  </div>
              </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl col-md-6 mb-3" style="display:none;">
            <a href="{{route('seat4w-report.m3.index')}}" style="text-decoration: none;">
              <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-md font-weight-bold text-info text-uppercase mb-1">MEDIUM Report</div>
                              <div class="row no-gutters align-items-center">
                                  <div class="col-auto">
                                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{count($reportM3)}} Report</div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                          </div>
                      </div>
                      <p class="text-danger"><b>menunggu approval</b></p>
                  </div>
              </div>
            </a>
        </div>

        <div class="col-xl col-md-6 mb-3" style="display:none;">
            <a href="{{route('seat4w-report.m6.index')}}" style="text-decoration: none;">
              <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-md font-weight-bold text-warning text-uppercase mb-1">HIGH Report</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($reportM6)}} Report</div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                          </div>
                      </div>
                      <p class="text-danger"><b>menunggu approval</b></p>
                  </div>
              </div>
            </a>
        </div>

        <div class="col-xl col-md-6 mb-3" style="display:none;">
          <a href="{{route('seat4w-report.mVH.index')}}" style="text-decoration: none;">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-warning text-uppercase mb-1">YEAR Report</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($reportMVH)}} Report</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <p class="text-danger"><b>menunggu approval</b></p>
                </div>
            </div>
          </a>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-body">
            <table class="table">
              <thead class="table-sm">
                <tr>
                  <th scope="col" rowspan="2">#</th>
                  <th scope="col" rowspan="2">Nama</th>
                  <th scope="col" rowspan="2">Jabatan</th>
                  <th scope="col" colspan="4" class="text-center">Jumlah Approval pending</th>
                </tr>
                <tr>
                  <th scope="col">SMALL Report</th>
                  <th scope="col">MEDIUM Report</th>
                  <th scope="col">HIGH Report</th>
                  <th scope="col">YEAR Report</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $column_name = ['id_leader', 'id_foreman', 'id_supervisor', 'id_manager'];
                @endphp
                @php $checked_user = array(); $no = 1; @endphp
                @foreach ($user_flow as $data)
                  @for ($i=0; $i < 4; $i++)
                    @if (auth()->user()->id == $data[$column_name[$i]])
                    @break;
                    @else
                      @if (in_array($data[$column_name[$i]], $checked_user))
                        @continue
                      @endif
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{App\user::where('id', $data[$column_name[$i]])->first()->nama}}</td>
                        <td>{{App\user::where('id', $data[$column_name[$i]])->first()->getLevel()->first()->level}}</td>
                        @php
                          switch (App\user::where('id', $data[$column_name[$i]])->first()->getLevel()->first()->level) {
                            case 'Leader':
                              $reportM1 = App\M1Report::where('approval1', '')->orWhereNull('approval1')->get();
                              $reportM3 = App\M3Report::where('approval1', '')->orWhereNull('approval1')->get();
                              $reportM6 = App\M6Report::where('approval1', '')->orWhereNull('approval1')->get();
                              $reportMVH = App\MVHReport::where('approval1', '')->orWhereNull('approval1')->get();
                              echo "<td>".count($reportM1)."</td>";
                              echo "<td>".count($reportM3)."</td>";
                              echo "<td>".count($reportM6)."</td>";
                              echo "<td>".count($reportMVH)."</td>";
                              break;

                            case 'Foreman':
                              $reportM1 = App\M1Report::where('approval1', '!=', '')->where('approval2', '')->orWhereNull('approval2')->get();
                              $reportM3 = App\M3Report::where('approval1', '!=', '')->where('approval2', '')->orWhereNull('approval2')->get();
                              $reportM6 = App\M6Report::where('approval1', '!=', '')->where('approval2', '')->orWhereNull('approval2')->get();
                              $reportMVH = App\M6Report::where('approval1', '!=', '')->where('approval2', '')->orWhereNull('approval2')->get();
                              echo "<td>".count($reportM1)."</td>";
                              echo "<td>".count($reportM3)."</td>";
                              echo "<td>".count($reportM6)."</td>";
                              echo "<td>".count($reportMVH)."</td>";
                              break;

                            case 'Supervisor':
                              $reportM1 = App\M1Report::where('approval1', '!=', '')->where('approval2', '!=', '')->where('approval3', '')->orWhereNull('approval3')->get();
                              $reportM3 = App\M3Report::where('approval1', '!=', '')->where('approval2', '!=', '')->where('approval3', '')->orWhereNull('approval3')->get();
                              $reportM6 = App\M6Report::where('approval1', '!=', '')->where('approval2', '!=', '')->where('approval3', '')->orWhereNull('approval3')->get();
                              $reportMVH = App\MVHReport::where('approval1', '!=', '')->where('approval2', '!=', '')->where('approval3', '')->orWhereNull('approval3')->get();
                              echo "<td>".count($reportM1)."</td>";
                              echo "<td>".count($reportM3)."</td>";
                              echo "<td>".count($reportM6)."</td>";
                              echo "<td>".count($reportMVH)."</td>";
                              break;

                            default:
                              // code...
                              break;
                          }
                        @endphp
                      </tr>
                    @endif
                    @php
                      array_push($checked_user, $data[$column_name[$i]]);
                      $no++;
                    @endphp
                  @endfor
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection
