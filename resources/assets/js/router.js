//DASHBOARD
import DashboardIndex from './components/dashboard/DashboardIndex.vue';
import UserIndex from './components/user/UserIndex.vue';
import UserCreate from './components/user/UserCreate.vue';
import UserEdit from './components/user/UserEdit.vue';
import SatuanIndex from './components/satuan/SatuanIndex.vue';
import SatuanCreate from './components/satuan/SatuanCreate.vue';
import SatuanEdit from './components/satuan/SatuanEdit.vue';
import PoliIndex from './components/poli/PoliIndex.vue';
import PoliCreate from './components/poli/PoliCreate.vue';
import PoliEdit from './components/poli/PoliEdit.vue';
import RuanganIndex from './components/ruangan/RuanganIndex.vue';
import RuanganCreate from './components/ruangan/RuanganCreate.vue';
import RuanganEdit from './components/ruangan/RuanganEdit.vue';
import KategoriProdukIndex from './components/kategori-produk/KategoriProdukIndex.vue';
import KategoriProdukCreate from './components/kategori-produk/KategoriProdukCreate.vue';
import KategoriProdukEdit from './components/kategori-produk/KategoriProdukEdit.vue';
import KategoriTransaksiIndex from './components/kategori-transaksi/KategoriTransaksiIndex.vue';
import KategoriTransaksiCreate from './components/kategori-transaksi/KategoriTransaksiCreate.vue';
import KategoriTransaksiEdit from './components/kategori-transaksi/KategoriTransaksiEdit.vue';
import SupplierIndex from './components/supplier/SupplierIndex.vue';
import SupplierCreate from './components/supplier/SupplierCreate.vue';
import SupplierEdit from './components/supplier/SupplierEdit.vue';
import KasCreate from './components/kas/KasCreate.vue';
import KasEdit from './components/kas/KasEdit.vue';
import KasIndex from './components/kas/KasIndex.vue';
import PenjaminCreate from './components/penjamin/PenjaminCreate.vue';
import PenjaminEdit from './components/penjamin/PenjaminEdit.vue';
import PenjaminIndex from './components/penjamin/PenjaminIndex.vue';
import PerusahaanEdit from './components/perusahaan/PerusahaanEdit.vue';
import PerusahaanIndex from './components/perusahaan/PerusahaanIndex.vue';
import PasienCreate from './components/pasien/PasienCreate.vue';
import PasienEdit from './components/pasien/PasienEdit.vue';
import PasienIndex from './components/pasien/PasienIndex.vue';
import ProdukCreate from './components/produk/ProdukCreate.vue';
import ProdukEdit from './components/produk/ProdukEdit.vue';
import ProdukIndex from './components/produk/ProdukIndex.vue';

import LaporanKasIndex from './components/laporan-kas/LaporanKasIndex.vue';

import KasMasukCreate from './components/kas-masuk/KasMasukCreate.vue';
import KasMasukEdit from './components/kas-masuk/KasMasukEdit.vue';
import KasMasukIndex from './components/kas-masuk/KasMasukIndex.vue';

import KasKeluarCreate from './components/kas-keluar/KasKeluarCreate.vue';
import KasKeluarEdit from './components/kas-keluar/KasKeluarEdit.vue';
import KasKeluarIndex from './components/kas-keluar/KasKeluarIndex.vue';

import KasMutasiCreate from './components/kas-mutasi/KasMutasiCreate.vue';
import KasMutasiEdit from './components/kas-mutasi/KasMutasiEdit.vue';
import KasMutasiIndex from './components/kas-mutasi/KasMutasiIndex.vue';

import KomisiProdukCreate from './components/komisi-produk/KomisiProdukCreate.vue';
import KomisiProdukEdit from './components/komisi-produk/KomisiProdukEdit.vue';
import KomisiProdukIndex from './components/komisi-produk/KomisiProdukIndex.vue';
import Page404 from './components/error/Page404.vue';

import ItemMasukCreate from './components/item-masuk/ItemMasukCreate.vue';
import ItemMasukEdit from './components/item-masuk/ItemMasukEdit.vue';
import ItemMasukIndex from './components/item-masuk/ItemMasukIndex.vue';

import ItemKeluarCreate from './components/item-keluar/ItemKeluarCreate.vue';
import ItemKeluarEdit from './components/item-keluar/ItemKeluarEdit.vue';
import ItemKeluarIndex from './components/item-keluar/ItemKeluarIndex.vue';

import PembelianCreate from './components/pembelian/PembelianCreate.vue';
import PembelianEdit from './components/pembelian/PembelianEdit.vue';
import PembelianIndex from './components/pembelian/PembelianIndex.vue';

import RegistrasiRawatJalanCreate from './components/registrasi-rawat-jalan/RegistrasiRawatJalanCreate.vue';
import RegistrasiRawatJalanLamaCreate from './components/registrasi-rawat-jalan/RegistrasiRawatJalanLamaCreate.vue';
import RegistrasiRawatJalanBaruCreate from './components/registrasi-rawat-jalan/RegistrasiRawatJalanBaruCreate.vue';
import RegistrasiRawatJalanIndex from './components/registrasi-rawat-jalan/RegistrasiRawatJalanIndex.vue';

 const routes = [
     {
        path: '/',
        component: DashboardIndex,
        name : 'IndexDashboard'
     },
     { path: '/user', component: UserIndex,name: 'IndexUser' },
     { path: '/user/create', component: UserCreate,name: 'CreateUser' },
     { path: '/user/edit/:id', component: UserEdit,name: 'EditUser' },
     { path: '/satuan', component: SatuanIndex,name: 'IndexSatuan' },
     { path: '/satuan/create', component: SatuanCreate,name: 'CreateSatuan' },
     { path: '/satuan/edit/:id', component: SatuanEdit,name: 'EditSatuan' },
     { path: '/poli', component: PoliIndex,name: 'IndexPoli' },
     { path: '/poli/create', component: PoliCreate,name: 'CreatePoli' },
     { path: '/poli/edit/:id', component: PoliEdit,name: 'EditPoli' },
     { path: '/ruangan', component: RuanganIndex,name: 'IndexRuangan' },
     { path: '/ruangan/create', component: RuanganCreate,name: 'CreateRuangan' },
     { path: '/ruangan/edit/:id', component: RuanganEdit,name: 'EditRuangan' },
     { path: '/supplier', component: SupplierIndex,name: 'IndexSupplier' },
     { path: '/supplier/create', component: SupplierCreate,name: 'CreateSupplier' },
     { path: '/supplier/edit/:id', component: SupplierEdit,name: 'EditSupplier' },
     { path: '/kas', component: KasIndex,name: 'IndexKas' },
     { path: '/kas/create', component: KasCreate,name: 'CreateKas' },
     { path: '/kas/edit/:id', component: KasEdit,name: 'EditKas' },
     { path: '/penjamin', component: PenjaminIndex,name: 'IndexPenjamin' },
     { path: '/penjamin/create', component: PenjaminCreate,name: 'CreatePenjamin' },
     { path: '/penjamin/edit/:id', component: PenjaminEdit,name: 'EditPenjamin' },
     { path: '/pasien', component: PasienIndex,name: 'IndexPasien' },
     { path: '/pasien/create', component: PasienCreate,name: 'CreatePasien' },
     { path: '/pasien/edit/:id', component: PasienEdit,name: 'EditPasien' },
     { path: '/registrasi-rawat-jalan', component: RegistrasiRawatJalanIndex,name: 'IndexRegistrasiRawatJalan' },
     { path: '/registrasi-rawat-jalan/create', component: RegistrasiRawatJalanCreate,name: 'CreateRegistrasiRawatJalan' },
     { path: '/registrasi-rawat-jalan-lama/create', component: RegistrasiRawatJalanLamaCreate,name: 'CreateRegistrasiRawatJalanLama' },
     { path: '/registrasi-rawat-jalan-baru/create', component: RegistrasiRawatJalanBaruCreate,name: 'CreateRegistrasiRawatJalanBaru' },
     { path: '/produk', component: ProdukIndex,name: 'IndexProduk' },
     { path: '/produk/create', component: ProdukCreate,name: 'CreateProduk' },
     { path: '/produk/edit/:id', component: ProdukEdit,name: 'EditProduk' },
     { path: '/pembelian', component: PembelianIndex,name: 'IndexPembelian' },
     { path: '/pembelian/create', component: PembelianCreate,name: 'CreatePembelian' },
     { path: '/pembelian/edit/:id', component: PembelianEdit,name: 'EditPembelian' },
     { path: '/item-masuk', component: ItemMasukIndex,name: 'IndexItemMasuk' },
     { path: '/item-masuk/create', component: ItemMasukCreate,name: 'CreateItemMasuk' },
     { path: '/item-masuk/edit/:id', component: ItemMasukEdit,name: 'EditItemMasuk' },
     { path: '/item-keluar', component: ItemKeluarIndex,name: 'IndexItemKeluar' },
     { path: '/item-keluar/create', component: ItemKeluarCreate,name: 'CreateItemKeluar' },
     { path: '/item-keluar/edit/:id', component: ItemKeluarEdit,name: 'EditItemKeluar' },
     { path: '/kas-masuk', component: KasMasukIndex,name: 'IndexKasMasuk' },
     { path: '/kas-masuk/create', component: KasMasukCreate,name: 'CreateKasMasuk' },
     { path: '/kas-masuk/edit/:id', component: KasMasukEdit,name: 'EditKasMasuk' },
     { path: '/kas-keluar', component: KasKeluarIndex,name: 'IndexKasKeluar' },
     { path: '/kas-keluar/create', component: KasKeluarCreate,name: 'CreateKasKeluar' },
     { path: '/kas-keluar/edit/:id', component: KasKeluarEdit,name: 'EditKasKeluar' },
     { path: '/kas-mutasi', component: KasMutasiIndex,name: 'IndexKasMutasi' },
     { path: '/kas-mutasi/create', component: KasMutasiCreate,name: 'CreateKasMutasi' },
     { path: '/kas-mutasi/edit/:id', component: KasMutasiEdit,name: 'EditKasMutasi' },
     { path: '/komisi-produk', component: KomisiProdukIndex,name: 'IndexKomisiProduk' },
     { path: '/komisi-produk/create', component: KomisiProdukCreate,name: 'CreateKomisiProduk' },
     { path: '/komisi-produk/edit/:id', component: KomisiProdukEdit,name: 'EditKomisiProduk' },
     { path: '/perusahaan', component: PerusahaanIndex,name: 'IndexPerusahaan' },
     { path: '/laporan-kas', component: LaporanKasIndex,name: 'IndexLaporanKas' },
     { path: '/perusahaan/edit/:id', component: PerusahaanEdit,name: 'EditPerusahaan' },
     { path: '/kategori-produk', component: KategoriProdukIndex,name: 'IndexKategoriProduk' },
     { path: '/kategori-produk/create', component: KategoriProdukCreate,name: 'CreateKategoriProduk' },
     { path: '/kategori-produk/edit/:id', component: KategoriProdukEdit,name: 'EditKategoriProduk' },
     { path: '/kategori-transaksi', component: KategoriTransaksiIndex,name: 'IndexKategoriTransaksi' },
     { path: '/kategori-transaksi/create', component: KategoriTransaksiCreate,name: 'CreateKategoriTransaksi' },
     { path: '/kategori-transaksi/edit/:id', component: KategoriTransaksiEdit,name: 'EditKategoriTransaksi' },
     { path: '/*', component:Page404,name: 'Page404' },
 ];

 export default routes;
