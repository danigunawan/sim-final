<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Komisi Produk</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Komisi Produk</div>

                <div class="panel-body">

                    <router-link 
                      :to="{name: 'CreateKomisiProduk'}" 
                      class="btn btn-md btn-primary"> 
                        Tambah Komisi Produk Per User
                    </router-link>
                    <br/>
                    <div class="table-responsive">
                    
                    <div align="right">
                    <input type="text" placeholder="Pencarian ..." v-bind:style="{width: '20%' }" v-model="pencarian" class="form-control" />
                    </div>
                    <br/>
                    <table class="table table-bordered" >
                    <thead>
                        <th>Produk</th>
                        <th>User</th>
                        <th>Prosentase</th>
                        <th>Jumlah Uang</th>
                        <th>Jabtan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody v-if="komisiProduks.length">
                      <tr v-for="komisi,index in komisiProduks">
                        <td>{{ komisi.nama_produk}}</td>
                        <td>{{ komisi.nama_user}}</td>
                        <td>{{ komisi.jumlah_prosentase}}</td>
                        <td>{{ komisi.jumlah_uang}}</td>
                        <td>{{ komisi.jabatan}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditKomisiProduk' ,params:{id: komisi.id}}" 
                          class="btn btn-xs btn-default"
                       >
                          Edit
                       </router-link>
                        <button 
                          class="btn btn-xs btn-danger" 
                          v-on:click="konfirmasiHapus(komisi.id,index,komisi.nama_produk)"
                        >
                          Hapus
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    </table>
                    <vue-pagination
                      :data="komisiProduksData"
                      v-on:pagination-change-page="getResults"
                      :limit="4"
                    >
                    </vue-pagination>
                    <vue-simple-spinner v-if="loading" message="Loading..."></vue-simple-spinner>
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
        komisiProduks: [],
        komisiProduksData: {},
        url: window.location.origin + (window.location.pathname).replace("home","komisi-produk"),
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
          app.komisiProduks = resp.data.data;
          app.komisiProduksData = resp.data;
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
          app.komisiProduks = resp.data.data;
          app.komisiProduksData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaKomisiProduk){
          axios.delete(this.url + '/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus KomisiProduk " + namaKomisiProduk);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      prosesKonfirmasiAdmin(id,index,namaKomisiProduk){
          
          axios.get(this.url + '/' + id + '/konfirmasi')
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Mengkonfirmasi","Berhasil Mengkonfirmasi KomisiProduk " + namaKomisiProduk);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaKomisiProduk){
      
        this.$swal({
          title: "Yakin Ingin Menghapus KomisiProduk " + namaKomisiProduk + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaKomisiProduk);
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

