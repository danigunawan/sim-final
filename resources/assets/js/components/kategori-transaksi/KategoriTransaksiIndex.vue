<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Kategori Transaksi</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Kategori Transaksi</div>

                <div class="panel-body">

                    <router-link 
                      :to="{name: 'CreateKategoriTransaksi'}" 
                      class="btn btn-md btn-primary"> 
                        Tambah Kategori Transaksi
                    </router-link>
                    <br/>
                    <div class="table-responsive">
                    
                    <div align="right">
                    <input type="text" placeholder="Pencarian ..." v-bind:style="{width: '20%' }" v-model="pencarian" class="form-control" />
                    </div>
                    <br/>
                    <table class="table table-bordered" >
                    <thead>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody v-if="kategoriTransaksis.length">
                      <tr v-for="kategoriTransaksi,index in kategoriTransaksis">
                        <td>{{ kategoriTransaksi.nama}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditKategoriTransaksi' ,params:{id: kategoriTransaksi.id}}" 
                          class="btn btn-xs btn-default"
                       >
                          Edit
                       </router-link>
                        <button 
                          class="btn btn-xs btn-danger" 
                          v-on:click="konfirmasiHapus(kategoriTransaksi.id,index,kategoriTransaksi.nama)"
                        >
                          Hapus
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>


<script>
  export default {
    data: function() {
      return {
        kategoriTransaksis: [],
        kategoriTransaksisData: {},
        url: window.location.origin + (window.location.pathname).replace("home","kategori-transaksi"),
        pencarian: '',
        loading: true
      }
    },
    mounted()  {
     var app = this;
    app.getResults();
    },
    watch: {
       pencarian: function(newSearch){
         this.getHasilPencarian();
       }  
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get(app.url + '/view?page=' + page)
        .then(function(resp){
          app.kategoriTransaksis = resp.data.data;
          app.kategoriTransaksisData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      getHasilPencarian(page){
          
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get(app.url + '/search?q='+app.pencarian+'&page=' + page)
        .then(function(resp){
          app.kategoriTransaksis = resp.data.data;
          app.kategoriTransaksisData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaKategoriTransaksi){
          axios.delete(this.url + '/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Kategori Transaksi " + namaKategoriTransaksi);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      prosesKonfirmasiAdmin(id,index,namaKategoriTransaksi){
          
          axios.get(this.url + '/' + id + '/konfirmasi')
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Mengkonfirmasi","Berhasil Mengkonfirmasi Kategori Transaksi " + namaKategoriTransaksi);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaKategoriTransaksi){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Kategori Transaksi " + namaKategoriTransaksi + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaKategoriTransaksi);
          }
        })  
      },
      alert(title,pesan){
        this.$swal({
          title: title,
          text: pesan,
          icon: "success"
        });
      }
    }
  }

</script>

