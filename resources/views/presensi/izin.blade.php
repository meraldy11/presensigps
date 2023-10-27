@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader text-light" style="background-color: #120C37">
    <div class="left">
        <a href="#" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Data Izin</div>
    <div class="right"></div>
</div>
<style>
    .historycontent{
        display: flex;
        gap: 1px;
    }
    .datapresensi{
        margin-left: 10px;
    }
    .status{
        position: absolute;
        right: 20px;
    }
</style>
<!-- App Header -->
@endsection
@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        @php
            $messagesuccess = Session::get('success');
            $messageerror = Session::get('error');
        @endphp
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ $messagesuccess }}
            </div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger">
                {{ $messageerror }}
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col">
        @foreach ($dataizin as $d)
        @php
            if($d->status=="i"){
                $status = "Izin";
            }else if($d->status=="s"){
                $status = "Sakit";
            }elseif($d->status=="c"){
                $status = "Cuti";
            }else{
                $status = "Not Found";
            }
        @endphp
        <div class="card mt-1">
            <div class="card-body">
                <div class="historycontent">
                    <div class="iconpresensi">
                        @if ($d->status=="i")
                        <ion-icon name="document-outline" style="font-size: 48px; color:darkblue"></ion-icon>
                        @elseif ($d->status=="s")
                        <ion-icon name="medkit-outline" style="font-size: 48px; color:red"></ion-icon>
                        @elseif ($d->status=="c")
                        <ion-icon name="calendar-outline" style="font-size: 48px; color:orange"></ion-icon></ion-icon>
                        @endif

                    </div>
                    <div class="datapresensi">
                        <h3 style="line-height: 3px">{{ date("d-m-Y",strtotime($d->tgl_izin_dari)) }} ({{ $status }})</h3>
                        <small>{{ date("d-m-Y",strtotime($d->tgl_izin_dari)) }} s/d {{ date("d-m-Y",strtotime($d->tgl_izin_sampai)) }}</small>
                        <p>
                            {{ $d->keterangan }}
                        <br>
                        @if ($d->status=="c")
                            <span class="badge bg-warning">{{ $d->nama_cuti }}</span>
                        @endif
                        @if (!empty($d->doc_sid))
                            <span style="color: blue">
                                <ion-icon name="document-attach-outline"></ion-icon>
                                Lihat Surat Ijin
                            </span>
                            @endif
                        </p>

                    </div>

                    <div class="status">
                        @if ($d->status_approved==0)
                            <span class="badge bg-warning">Pending</span>
                        @elseif ($d->status_approved==1)
                            <span class="badge bg-success">Disetujui</span>
                        @elseif ($d->status_approved==2)
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                        <p style="margin-top: 5px; font-weight:bold">{{ hitunghari($d->tgl_izin_dari,$d->tgl_izin_sampai) }} Hari</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- <ul class="listview image-listview">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            <b>{{ date("d-m-Y",strtotime($d->tgl_izin_dari)) }} ({{$d->status=="s" ? "Sakit" : "Izin"}})<br></b>
                            <small class="text-muted">{{$d->keterangan}}</small>
                        </div>
                        @if ($d->status_approved == 0)
                        <span class="badge bg-warning">Menunggu</span>
                        @elseif($d->status_approved == 1)
                        <span class="badge bg-success">Disetujui</span>
                        @elseif($d->status_approved == 2)
                        <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </div>
                </div>
            </li>
        </ul> --}}
    @endforeach
    </div>
</div>

<div class="fab-button animate bottom-right dropdown" style="margin-bottom: 70px">
    <a href="#" class="fab bg-primary" data-toggle="dropdown">
        <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item bg-primary" href="/izinabsen">
        <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="image outline"></ion-icon>
        <p>Izin</p>
        </a>
        <a class="dropdown-item bg-primary" href="/izinsakit">
            <ion-icon name="medkit-outline" role="img" class="md hydrated" aria-label="videocam outline"></ion-icon>
        <p>Sakit</p>
        </a>
        <a class="dropdown-item bg-primary" href="/izincuti">
            <ion-icon name="calendar-outline" role="img" class="md hydrated" aria-label="videocam outline" ></ion-icon>
        <p>Cuti</p>
        </a>
    </div>
</div>
@endsection
