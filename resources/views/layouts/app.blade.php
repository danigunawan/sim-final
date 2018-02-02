<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                           @if(Auth::check())
                        <li><router-link :to="{name: 'IndexDashboard'}" >Home</router-link></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Penjualan
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><router-link :to="{name: 'IndexPenjualanApotek'}" >Apotek</router-link></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Master Data
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><router-link :to="{name: 'IndexUser'}" >User</router-link></li>
                                <li><router-link :to="{name: 'IndexSatuan'}" >Satuan</router-link></li>
                                <li><router-link :to="{name: 'IndexSupplier'}" >Supplier</router-link></li>
                                <li><router-link :to="{name: 'IndexProduk'}" >Produk</router-link></li>
                                <li><router-link :to="{name: 'IndexKomisiProduk'}" >Komisi Produk</router-link></li>
                                <li><router-link :to="{name: 'IndexPenjamin'}" >Penjamin</router-link></li>
                                <li><router-link :to="{name: 'IndexPasien'}" >Pasien</router-link></li>
                                <li><router-link :to="{name: 'IndexKas'}" >Kas</router-link></li>
                                <li><router-link :to="{name: 'IndexPoli'}" >Poli</router-link></li>
                                <li><router-link :to="{name: 'IndexRuangan'}" >Ruangan</router-link></li>
                                <li><router-link :to="{name: 'IndexKategoriProduk'}" >Kategori Produk</router-link></li>
                                <li><router-link :to="{name: 'IndexKategoriTransaksi'}" >Kategori Transaksi</router-link></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transaksi Kas
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><router-link :to="{name: 'IndexKasMasuk'}" >Kas Masuk</router-link></li>
                                <li><router-link :to="{name: 'IndexKasKeluar'}" >Kas Keluar</router-link></li>
                                <li><router-link :to="{name: 'IndexKasMutasi'}" >Kas Mutasi</router-link></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Registrasi
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><router-link :to="{name: 'IndexRegistrasiRawatJalan'}" >Rawat Jalan</router-link></li>
                                <li><router-link :to="{name: 'IndexRegistrasiRawatInap'}" >Rawat Inap</router-link></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Laporan 
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><router-link :to="{name: 'IndexLaporanKas'}" >Transaksi Kas</router-link></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Persediaan
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><router-link :to="{name: 'IndexPembelian'}" >Pembelian</router-link></li>
                                <li><router-link :to="{name: 'IndexItemMasuk'}" >Item Masuk</router-link></li>
                                <li><router-link :to="{name: 'IndexItemKeluar'}" >Item Keluar</router-link></li>
                            </ul>
                            </ul>
                        </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js?v=1.0.1') }}"></script>
</body>
</html>
