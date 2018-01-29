<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Registrasi Rawat Jalan</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Registrasi Rawat Jalan</div>

                <div class="panel-body">

                    <router-link 
                      :to="{name: 'CreateRegistrasiRawatJalanLama'}" 
                      class="btn btn-md btn-primary"> 
                        Pasien Lama
                    </router-link>
                    <router-link 
                      :to="{name: 'CreateRegistrasiRawatJalanBaru'}" 
                      class="btn btn-md btn-primary"> 
                        Pasien Baru
                    </router-link>
                    <br/>
                    <div>
                    <br/>
                    <input type="text" placeholder="Pencarian ..."  v-model="pencarian" class="form-control" />
                    </div>
                    <br/>
                    <div class="table-responsive">
                    
                    <table class="table table-bordered" >
                    <thead>
                        <th>No Reg</th>
                        <th>No Rm</th>
                        <th>Nama Pasien</th>
                        <th>Poli</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody v-if="registrasiRawatJalans.length">
                      <tr v-for="registrasi,index in registrasiRawatJalans">
                        <td>{{ registrasi.no_reg}}</td>
                        <td>{{ registrasi.pasien}}</td>
                        <td>{{ registrasi.nama_pasien}}</td>
                        <td>{{ registrasi.nama_poli}}</td>
                        <td>
                        <button 
                          class="btn btn-xs btn-success" 
                          v-on:click="rawatPasien(registrasi.id)"
                        >
                          Rawat
                        </button>
                        <button 
                          class="btn btn-xs btn-danger" 
                          v-on:click="konfirmasiHapus(registrasi.id,index,registrasi.no_reg)"
                        >
                          Hapus
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr ><td colspan="5"><center>Tidak Ada Data</center></td></tr>
                    </tbody>
                    </table>
                    <vue-pagination
                      :data="registrasiRawatJalansData"
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
        registrasiRawatJalans: [],
        registrasiRawatJalansData: {},
        url: window.location.origin + (window.location.pathname).replace("home","registrasi-rawat-jalan"),
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
      rawatPasien(id){
        var app = this;
        app.loading = true;
        axios.get(app.url + '/' + id + '/rawat' )
        .then(function(resp){
          app.loading = false;
          app.getResults();
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get(app.url + '/view?page=' + page)
        .then(function(resp){
          app.registrasiRawatJalans = resp.data.data;
          app.registrasiRawatJalansData = resp.data;
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
          app.registrasiRawatJalans = resp.data.data;
          app.registrasiRawatJalansData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaRegistrasiRawatJalan){
          axios.delete(this.url + '/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus RegistrasiRawatJalan " + namaRegistrasiRawatJalan);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaRegistrasiRawatJalan){
      
        this.$swal({
          title: "Yakin Ingin Menghapus RegistrasiRawatJalan " + namaRegistrasiRawatJalan + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaRegistrasiRawatJalan);
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

