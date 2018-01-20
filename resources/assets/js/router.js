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

import KomisiProdukCreate from './components/komisi-produk/KomisiProdukCreate.vue';
import KomisiProdukEdit from './components/komisi-produk/KomisiProdukEdit.vue';
import KomisiProdukIndex from './components/komisi-produk/KomisiProdukIndex.vue';

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
     { path: '/produk', component: ProdukIndex,name: 'IndexProduk' },
     { path: '/produk/create', component: ProdukCreate,name: 'CreateProduk' },
     { path: '/produk/edit/:id', component: ProdukEdit,name: 'EditProduk' },
     { path: '/produk', component: ProdukIndex,name: 'IndexProduk' },
     { path: '/produk/create', component: ProdukCreate,name: 'CreateProduk' },
     { path: '/produk/edit/:id', component: ProdukEdit,name: 'EditProduk' },
     { path: '/komisi-produk', component: KomisiProdukIndex,name: 'IndexKomisiProduk' },
     { path: '/komisi-produk/create', component: KomisiProdukCreate,name: 'CreateKomisiProduk' },
     { path: '/komisi-produk/edit/:id', component: KomisiProdukEdit,name: 'EditKomisiProduk' },
     { path: '/perusahaan', component: PerusahaanIndex,name: 'IndexPerusahaan' },
     { path: '/perusahaan/edit/:id', component: PerusahaanEdit,name: 'EditPerusahaan' },
     { path: '/kategori-produk', component: KategoriProdukIndex,name: 'IndexKategoriProduk' },
     { path: '/kategori-produk/create', component: KategoriProdukCreate,name: 'CreateKategoriProduk' },
     { path: '/kategori-produk/edit/:id', component: KategoriProdukEdit,name: 'EditKategoriProduk' },
     { path: '/kategori-transaksi', component: KategoriTransaksiIndex,name: 'IndexKategoriTransaksi' },
     { path: '/kategori-transaksi/create', component: KategoriTransaksiCreate,name: 'CreateKategoriTransaksi' },
     { path: '/kategori-transaksi/edit/:id', component: KategoriTransaksiEdit,name: 'EditKategoriTransaksi' }
 ];

 export default routes;
