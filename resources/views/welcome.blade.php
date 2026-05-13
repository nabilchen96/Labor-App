<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sipencatar Politeknik Penerbangan Palembang</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('frontend/vendors/owl-carousel/css/owl.carousel.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/vendors/owl-carousel/css/owl.theme.default.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/vendors/aos/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="shortcut icon" href="https://poltekbangplg.ac.id/wp-content/uploads/2020/06/favicon.ico"
        type="image/x-icon" />
    @stack('style')
    <style>
        .contact-us .contact-us-bgimage {
            padding: 20px !important;
            border-radius: 15px;
        }

        .card.card-body {
            padding: 0;
        }

        .features-overview .content-header {
            padding: 0;
        }

        .navbar {
            padding: 18px 0;
        }

        .font-weight-semibold {
            padding-top: 50px;
        }

        .img-proporsional {
            float: center;
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .img-proporsional:hover,
        .img-proporsional:focus {
            transform: scale(1.1);
        }

        @media only screen and (max-width: 800px) {
            .card .card-body {
                padding: 0 0 43px 0;
            }

            .sika-map {
                margin-bottom: 30px;
            }

            .sika-map iframe {
                height: 320px;
            }

            .sika-description h1 {
                font-size: 25px;
            }

            .web-title {
                display: none;
            }

            .btn-contact-us {
                margin-left: 0 !important;
            }

            .close-icon {
                margin-right: 20px;
            }

            .kuesioner img {
                display: none;
            }

            .card-kuesioner {
                margin: 20px;
            }

            .detail-news-image {
                height: 250px !important;
            }

            /* .icon-image{
        height: 30%;
      } */
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .nav-x {
            display: inline-block;
            overflow: auto;
            overflow-y: hidden;
            max-width: 100%;
            /* margin: 0 0 1em; */
            white-space: nowrap;
        }

        .nav-x li {
            display: inline-block;
            vertical-align: top;
        }

        .nav-x:hover> ::-webkit-scrollbar-thumb {
            visibility: visible;
        }

        ::-webkit-scrollbar {
            width: 0.5rem;
        }
    </style>
</head>

<body id="body" data-spy="scroll" data-target=".navbar" data-offset="100">
    <header id="header-section">
        <nav class="navbar navbar-expand-lg pl-3 pl-sm-0" style="background-color: #d3d8e2;" id="navbar">
            <div class="container" data-aos="fade-down">
                <div class="navbar-brand-wrapper d-flex w-100">
                    <img class="icon-image d-none d-lg-block d-md-block" src="{{ asset('frontend/images/logo.png') }}"
                        style="margin-top: -5px; width: 13%;" alt="">
                    <img class="icon-image d-lg-none d-md-none" src="{{ asset('frontend/images/logo.png') }}"
                        style="margin-top: -5px; width: 25%;" alt="">
                    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="mdi mdi-menu navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-menu-wrapper" id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-lg-center align-items-start ml-auto right">
                        <li class="d-flex align-items-center justify-content-between pl-4 pl-lg-0">
                            <div class="navbar-collapse-logo">
                                {{-- <img src="{{ asset('frontend/images/Group2.svg') }}" alt=""> --}}
                                <img src="{{ asset('frontend/images/logo.png') }}" style="width: 50%;" alt="">
                            </div>
                            <button class="navbar-toggler close-button" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="close-icon toggle-icon mdi mdi-close navbar-toggler-icon pl-5"></span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::is('/')) active @endif"
                                href="{{ url('/') }}"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#jadwal"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (Request::is('/')) active @endif"
                                href="{{ url('/') }}">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#video">Video</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="#jadwal">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#peminjaman">Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#kunjungan">Kunjungan</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#berita">Berita</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="banner" style="background: #d3d8e2;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <h2 class="font-weight-semibold text-left mb-2 mt-4" data-aos="zoom-in" data-aos-delay="100">
                        E-Laboratorium <br> Poltekbang Palembang
                        <!-- Portal Taruna Poltekbang Palembang -->
                    </h2>

                    <p class="text-left mb-5">
                        Sistem Manajemen Peminjaman, Penggunaan Alat, <br> Pengecekan, dan
                        Penjadwalan Lab Poltekbang Palembang
                    </p>
                    <div class="d-flex justify-content-start">
                        <a href="{{ url('/admin') }}" class="btn btn-primary mr-3">
                            <span class="mdi mdi-lock"></span> Login</a>

                        <a href="#peminjaman" class="btn btn-warning">
                            Peminjaman Lab</a>
                    </div>

                </div>
                <div class="col-lg-6">
                    <iframe width="100%" height="350" src="https://www.youtube.com/embed/ILT7Pm54f7U"
                        title="VIDEO PROFIL POLITEKNIK PENERBANGAN PALEMBANG" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
            <br><br>
        </div>
    </div>

    <div class="container" id="jadwal">
        @php
            $jadwals = App\Models\JadwalLab::with(['laboratorium', 'user1', 'user2', 'user3', 'user4', 'user5'])->get();

            $hariList = ['senin', 'selasa', 'rabu', 'kamis', 'jumat'];
            $grouped = [];

            foreach ($jadwals as $jadwal) {
                $namaLab = $jadwal->laboratorium->nama_lab ?? 'Tanpa Nama';
                $hari = strtolower($jadwal->hari);

                $grouped[$namaLab]['nama'] = $namaLab;
                $grouped[$namaLab]['jadwal'][$hari][] = [
                    'id' => $jadwal->id,
                    'jam' => $jadwal->jam_awal . ' - ' . $jadwal->jam_akhir,
                    'petugas' => collect([
                        $jadwal->user1,
                        $jadwal->user2,
                        $jadwal->user3,
                        $jadwal->user4,
                        $jadwal->user5,
                    ])
                        ->filter()
                        ->pluck('name')
                        ->all(),
                ];
            }

            // pastikan semua hari ada walau kosong
            foreach ($grouped as &$lab) {
                foreach ($hariList as $hari) {
                    $lab['jadwal'][$hari] = $lab['jadwal'][$hari] ?? [];
                }
            }
        @endphp
        <div class="text-center content-header mt-5">
            <h2>🗓️ Jadwal</h2>
            <h6 class="section-subtitle text-muted mb-4">
                Jadwal Jaga Laboratorium <br> Politeknik Penerbangan Palembang
            </h6>
        </div>
        <div class="table-responsive">
            <table id="myTable" style="font-size: 14px;"
                class="mt-2 table table-bordered table-striped align-middle text-sm bg-white">
                <thead class="bg-info text-white">
                    <tr>
                        <th class="fw-bold text-start" style="width: 16%;">Laboratorium</th>
                        @foreach ($hariList as $hari)
                            <th class="fw-bold text-start text-uppercase">{{ $hari }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grouped as $lab)
                        <tr class="align-top">
                            <td class="fw-semibold text-nowrap">{{ $lab['nama'] }}</td>
                            @foreach ($hariList as $hari)
                                <td class="align-top">
                                    @forelse($lab['jadwal'][$hari] as $item)
                                        <div class="card shadow-sm mb-3 mt-3">
                                            <div class="card-body p-2">
                                                <div class="small text-secondary mb-2">
                                                    <i class="fas fa-clock me-1 text-primary"></i> {{ $item['jam'] }}
                                                </div>

                                                <hr class="my-2">

                                                @foreach ($item['petugas'] as $nama)
                                                    <div class="small text-muted">
                                                        <i class="fas fa-user me-1 text-success"></i>
                                                        {{ $nama }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @empty
                                        <span class="small text-muted">-</span>
                                    @endforelse
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

    <div class="container" id="peminjaman">
        <div class="text-center content-header mt-5">
            <h2>🗓️ Peminjaman</h2>
            <h6 class="section-subtitle text-muted mb-4">
                Form dan Jadwal Peminjaman Laboratorium <br> Politeknik Penerbangan Palembang
            </h6>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Ajukan Peminjaman
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <form id="formPeminjaman">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-4">
                                <label class="form-label">Nama Peminjam <sup>*</sup></label>
                                <input type="text" required placeholder="Nama Peminjam" class="form-control"
                                    name="nama_peminjam" id="nama_peminjam" value="{{ old('nama_peminjam') }}">
                                <small class="text-danger error-nama_peminjam"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Laboratorium <sup>*</sup></label>
                                <select name="laboratorium_id" id="laboratorium_id" required class="form-control">
                                    <option value="">-- PILIH LABORATORIUM --</option>
                                    @php
                                        $laboratorium = DB::table('laboratoria')->get();
                                    @endphp
                                    @foreach ($laboratorium as $lab)
                                        <option value="{{ $lab->id }}"
                                            {{ old('laboratorium_id') == $lab->id ? 'selected' : '' }}>
                                            {{ $lab->nama_lab }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger error-laboratorium_id"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Tgl Pinjam <sup>*</sup></label>
                                <input type="datetime-local" required class="form-control" name="tanggal_peminjaman"
                                    id="tanggal_peminjaman" value="{{ old('tanggal_peminjaman') }}">
                                <small class="text-danger error-tanggal_peminjaman"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Tgl Kembali <sup>*</sup></label>
                                <input type="datetime-local" required class="form-control"
                                    name="tanggal_pengembalian" id="tanggal_pengembalian"
                                    value="{{ old('tanggal_pengembalian') }}">
                                <small class="text-danger error-tanggal_pengembalian"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Keperluan <sup>*</sup></label>
                                <textarea name="keperluan" required id="keperluan" cols="30" rows="3" class="form-control"
                                    placeholder="Keperluan">{{ old('keperluan') }}</textarea>
                                <small class="text-danger error-keperluan"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Instruktur <sup>*</sup></label>
                                <select name="instruktur_id" id="instruktur_id" required class="form-control">
                                    <option value="">-- PILIH INSTRUKTUR --</option>
                                    @php
                                        $instruktur = DB::table('instrukturs')->get();
                                    @endphp
                                    @foreach ($instruktur as $ins)
                                        <option value="{{ $ins->id }}"
                                            {{ old('instruktur_id') == $ins->id ? 'selected' : '' }}>
                                            {{ $ins->nama_instruktur }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger error-instruktur_id"></small>
                            </div>

                            <hr>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" id="btnKirim">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 mt-2">
                {{-- <h3 class="btn btn-sm btn-primary mb-3">Form Peminjaman</h3> --}}
                {{-- <div class="card border">
                    <div class="card-body p-4">
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-12 mt-2">
                <div style="font-size: 14px; overflow: scroll; overflow-x: auto; white-space: nowrap;">
                    <table id="myTable2" class="table table-striped" style="width: 100%;">
                        <thead class="bg-info text-white">
                            <tr>
                                <th>No.</th>
                                <th>Nama Peminjam</th>
                                <th>Laboratorium</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Instruktur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $jadwal = DB::table('peminjamen')
                                    ->leftjoin('laboratoria', 'laboratoria.id', '=', 'peminjamen.laboratorium_id')
                                    ->leftjoin('instrukturs', 'instrukturs.id', '=', 'peminjamen.instruktur_id')
                                    ->get();
                            @endphp
                            @foreach ($jadwal as $k => $item)
                                <tr>
                                    <td class="pt-4 pb-4">{{ $k + 1 }}</td>
                                    <td class="pt-4 pb-4">{{ $item->nama_peminjam }}</td>
                                    <td class="pt-4 pb-4">{{ $item->nama_lab }}</td>
                                    <td class="pt-4 pb-4">{{ $item->tanggal_peminjaman }}</td>
                                    <td class="pt-4 pb-4">{{ $item->tanggal_pengembalian }}</td>
                                    <td class="pt-4 pb-4">{{ $item->nama_instruktur }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container" id="kunjungan">
        <div class="text-center content-header mt-5">
            <h2>🗓️ Kunjungan</h2>
            <h6 class="section-subtitle text-muted mb-4">
                Buku Tamu dan Log Penggunaan Alat <br> Politeknik Penerbangan Palembang
            </h6>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-2 mb-5">

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">Buku Tamu /
                            Absensi</button>
                        <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Log
                            Penggunaan Alat</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        <div class="card border mt-2">
                            <div class="card-body p-4">
                                <form id="formPengunjung">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Pengunjung <sup>*</sup></label>
                                                <input type="text" class="form-control" name="pengunjung"
                                                    id="pengunjung" placeholder="Nama Pengunjung" required>
                                                <small class="text-danger error-pengunjung"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Peminjaman <sup>*</sup></label>
                                                <select name="peminjaman_id" id="peminjaman_id" required
                                                    class="form-control">
                                                    <option value="">-- PILIH PEMINJAMAN --</option>
                                                    @php
                                                        $peminjaman = DB::table('peminjamen')
                                                            ->leftJoin(
                                                                'laboratoria',
                                                                'laboratoria.id',
                                                                '=',
                                                                'peminjamen.laboratorium_id',
                                                            )
                                                            ->select('peminjamen.*', 'laboratoria.nama_lab')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($peminjaman as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nama_peminjam }} [{{ $item->nama_lab }}]
                                                            [{{ $item->tanggal_peminjaman }}]
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <small class="text-danger error-peminjaman_id"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Waktu Masuk <sup>*</sup></label>
                                                <input type="datetime-local" class="form-control" name="waktu_masuk"
                                                    id="waktu_masuk" required>
                                                <small class="text-danger error-waktu_masuk"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Waktu Keluar <sup>*</sup></label>
                                                <input type="datetime-local" class="form-control" name="waktu_keluar"
                                                    id="waktu_keluar" required>
                                                <small class="text-danger error-waktu_keluar"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Keperluan <sup>*</sup></label>
                                        <textarea name="keperluan" id="keperluan" cols="30" rows="3" class="form-control"
                                            placeholder="Keperluan" required></textarea>
                                        <small class="text-danger error-keperluan"></small>
                                    </div>

                                    <button type="submit" class="btn btn-primary" id="btnSubmit2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card border mt-2">
                            <div class="card-body p-4">
                                <form id="formPenggunaan">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Pengguna <sup>*</sup></label>
                                                <input type="text" class="form-control" name="user_nama"
                                                    id="user_nama" placeholder="Nama Pengguna" required>
                                                <small class="text-danger error-user_nama"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Peminjaman <sup>*</sup></label>
                                                <select name="peminjaman_id" id="peminjaman_id" required
                                                    class="form-control">
                                                    <option value="">-- PILIH PEMINJAMAN --</option>
                                                    @foreach ($peminjaman as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nama_peminjam }} [{{ $item->nama_lab }}]
                                                            [{{ $item->tanggal_peminjaman }}]
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <small class="text-danger error-peminjaman_id"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Waktu Mulai <sup>*</sup></label>
                                                <input type="datetime-local" class="form-control" name="waktu_mulai"
                                                    id="waktu_mulai" required>
                                                <small class="text-danger error-waktu_mulai"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Waktu Selesai <sup>*</sup></label>
                                                <input type="datetime-local" class="form-control"
                                                    name="waktu_selesai" id="waktu_selesai" required>
                                                <small class="text-danger error-waktu_selesai"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Alat <sup>*</sup></label>
                                                <select name="alat_id" id="alat_id" class="form-control" required>
                                                    @php
                                                        $alat = DB::table('alat_laboratoria')
                                                            ->leftJoin(
                                                                'laboratoria',
                                                                'laboratoria.id',
                                                                '=',
                                                                'alat_laboratoria.laboratorium_id',
                                                            )
                                                            ->select('alat_laboratoria.*', 'laboratoria.nama_lab')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($alat as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_alat }}
                                                            [{{ $item->nama_lab }}]</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-danger error-alat_id"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Kondisi <sup>*</sup></label>
                                                <select name="kondisi_awal" id="kondisi_awal" class="form-control"
                                                    required>
                                                    <option>Baik</option>
                                                    <option>Rusak Berat</option>
                                                    <option>Rusak Ringan</option>
                                                    <option>Lainnya</option>
                                                </select>
                                                <small class="text-danger error-kondisi_awal"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Catatan <sup>*</sup></label>
                                        <textarea name="catatan" id="catatan" cols="30" rows="3" class="form-control" placeholder="Catatan"
                                            required></textarea>
                                        <small class="text-danger error-catatan"></small>
                                    </div>

                                    <button type="submit" class="btn btn-primary" id="btnSubmit3">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div id="faq"></div>


    <iframe class="embed-responsive"
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15938.708954153537!2d104.6991992!3d-2.9089414!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5e411b86b9a1b4e9!2sPoliteknik%20Penerbangan%20Palembang!5e0!3m2!1sid!2sid!4v1613966893900!5m2!1sid!2sid"
        height="420" title="poltekbangplg" style="border:0" allowfullscreen></iframe>

    <div class="container">
        <section class="contact-details" id="contact-details-section">
            <div class="row text-center text-md-left mt-5">
                <div class="col-12 col-md-6 col-lg-3 grid-margin">
                    <img src="{{ asset('frontend/images/logo.png') }}" width="30%" alt=""
                        class="pb-2">
                    <div class="pt-2">
                        <p class="text-muted m-0">Jl. Adi Sucipto No.3012, Sukodadi, Kec. Sukarami, Palembang, Sumatera
                            Selatan, 30961</p>
                        <p class="text-muted m-0">Email: info@poltekbangplg.ac.id</p>
                        <p class="text-muted m-0">Telpon: 0711-410930</p>
                        <p class="text-muted m-0">Fax: 0711-420385</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 grid-margin">
                    <h5 class="pb-2">Sosial Media</h5>
                    <div class="d-flex justify-content-center justify-content-md-start">
                        <a target="_blank" href="https://www.facebook.com/poltekbangplg/"><span
                                class="mdi mdi-facebook"></span></a>
                        <a target="_blank" href="https://twitter.com"><span class="mdi mdi-twitter"></span></a>
                        <a target="_blank" href="https://www.instagram.com/poltekbangplg/"><span
                                class="mdi mdi-instagram"></span></a>
                        <a target="_blank" href="https://www.youtube.com/channel/UC_AW0-niVg52RtQB5NeG34g"><span
                                class="mdi mdi-youtube-play"></span></a>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 grid-margin">
                    <h5 class="pb-2">Akses Akademik</h5>
                    <a target="_blank" href="https://siakad.poltekbangplg.ac.id">
                        <p class="m-0 pt-1 pb-2">Sistem Informasi Akademik</p>
                    </a>
                    <a target="_blank" href="https://feedeer.poltekbangplg.ac.id:8082">
                        <p class="m-0 pt-1 pb-2">Feeder Dikti</p>
                    </a>
                    <a target="_blank" href="http://sister.poltekbangplg.ac.id/auth/login">
                        <p class="m-0 pt-1 pb-2">Sister Dikti</p>
                    </a>
                    <a target="_blank" href="https://e-learning.poltekbangplg.ac.id/">
                        <p class="m-0 pt-1 pb-2">Learning Management System</p>
                    </a>
                    <a target="_blank" href="https://library.poltekbangplg.ac.id/">
                        <p class="m-0 pt-1">Library Management System</p>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 grid-margin">
                    <h5 class="pb-2">Akses Aplikasi Lain</h5>
                    <a target="_blank" href="https://sik.dephub.go.id/">
                        <p class="m-0 pt-1 pb-2">Sistem Informasi Kepegawaian</p>
                    </a>
                    <a target="_blank" href="https://esurat.dephub.go.id/site/login">
                        <p class="m-0 pt-1 pb-2">E-persuratan</p>
                    </a>
                    <a target="_blank" href="https://skemaraja.dephub.go.id/">
                        <p class="m-0 pt-1 pb-2">Skemaraja</p>
                    </a>
                    <a target="_blank" href="https://marketing.poltekbangplg.ac.id">
                        <p class="m-0 pt-1 pb-2">E-marketing</p>
                    </a>
                    <a target="_blank" href="https://e-spm.poltekbangplg.ac.id/">
                        <p class="m-0 pt-1">Sistem Penjamin Mutu Internal</p>
                    </a>
                </div>
            </div>
        </section>
        <footer class="border-top">
            <p class="text-center text-muted pt-4">Copyright © <?php echo date('Y'); ?> Politeknik Penerbangan
                Palembang.</p>
        </footer>
    </div>

    <script src="{{ asset('frontend/vendors/jquery/jquery.min.js') }}"></script>
    {{--
    <script src="{{ asset('frontend/vendors/bootstrap/bootstrap.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="{{ asset('frontend/vendors/owl-carousel/js/owl.carousel.min.js') }}"></script>
    {{--
    <script src="{{ asset('frontend/vendors/aos/js/aos.js') }}"></script> --}}
    <script src="{{ asset('frontend/js/landingpage.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js "></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        $("#myTable, #myTable2").DataTable({
            "ordering": false,
        })
    </script>
    <script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        axios.get('https://poltekbangplg.ac.id/wp-json/wp/v2/posts?categories=107').then(function(res) {

            console.log(res.data);

            let postData = ''
            let stop = false

            res.data.forEach((e, i) => {

                if (i === 6) {
                    stop = true;
                }
                if (stop || e.categories[0] === 216) {
                    return;
                }

                postData +=

                    `
                    <div class="col-lg-4">
                        <a href="${e.link}" target="_blank">
                        <div>
                            <div class="card">
                                <div class="card-body">
                                    <img src="${e.jetpack_featured_media_url}" width="100%"
                                        alt="" class="img-fluid mb-3 img-proporsional"
                                        style="border-radius: 15px;">
                                    <h5 class="card-title">${e.title.rendered}</h5>
                                    
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    `
            });


            document.querySelector('#post').innerHTML = postData
        })
    </script>
    <script>
        document.getElementById('formPeminjaman').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let btn = document.getElementById('btnKirim');
            btn.disabled = true;
            btn.innerText = 'Mengirim...';

            // Hapus pesan error lama
            document.querySelectorAll('[class^="error-"]').forEach(el => el.innerText = '');

            // Ambil data form
            let formData = new FormData(form);

            axios.post('{{ url('/store-peminjaman') }}', formData)
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    form.reset();
                    window.location.reload();
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        // Tampilkan error validasi dari backend
                        let errors = error.response.data.errors;
                        for (const key in errors) {
                            document.querySelector('.error-' + key).innerText = errors[key][0];
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan pada server.'
                        });
                    }
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerText = 'Kirim';
                });
        });
    </script>
    <script>
        document.getElementById('formPengunjung').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let btn = document.getElementById('btnSubmit2');
            btn.disabled = true;
            btn.innerText = 'Mengirim...';

            // Hapus pesan error lama
            document.querySelectorAll('[class^="error-"]').forEach(el => el.innerText = '');

            let formData = new FormData(form);

            axios.post('{{ url('/store-kunjungan') }}', formData)
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    form.reset();
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        let errors = error.response.data.errors;
                        for (const key in errors) {
                            document.querySelector('.error-' + key).innerText = errors[key][0];
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan pada server.'
                        });
                    }
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerText = 'Submit';
                });
        });
    </script>
    <script>
        document.getElementById('formPenggunaan').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let btn = document.getElementById('btnSubmit3');
            btn.disabled = true;
            btn.innerText = 'Mengirim...';

            // Hapus pesan error lama
            document.querySelectorAll('[class^="error-"]').forEach(el => el.innerText = '');

            let formData = new FormData(form);

            axios.post('{{ url('/store-penggunaan-alat') }}', formData)
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    form.reset();
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        let errors = error.response.data.errors;
                        for (const key in errors) {
                            document.querySelector('.error-' + key).innerText = errors[key][0];
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan pada server.'
                        });
                    }
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerText = 'Submit';
                });
        });
    </script>
</body>

</html>
