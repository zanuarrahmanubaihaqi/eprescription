@extends('layouts.admin')

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
          <a href="#" style="text-decoration: none;">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Jumlah Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($resep) }} Transaksi</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <p class="text-danger"><b>Transaksi Pada Klinik</b></p>

                </div>
            </div>
          </a>
        </div>

    </div>

    <!-- <div class="row">
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
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> -->
@endsection
