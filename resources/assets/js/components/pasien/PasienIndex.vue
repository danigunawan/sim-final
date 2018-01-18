<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Pasien</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Pasien</div>

                <div class="panel-body">

                    <router-link 
                      :to="{name: 'CreatePasien'}" 
                      class="btn btn-md btn-primary"> 
                        Tambah Pasien
                    </router-link>
                    <br/>
                    <div class="table-responsive">
                    
                    <div align="right">
                    <input type="text" placeholder="Pencarian ..." v-bind:style="{width: '20%' }" v-model="pencarian" class="form-control" />
                    </div>
                    <br/>
                    <table class="table table-bordered" >
                    <thead>
                        <th>No RM</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Penjamin</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody v-if="pasiens.length">
                      <tr v-for="pasien,index in pasiens">
                        <td>{{ pasien.no_rm}}</td>
                        <td>{{ pasien.nama}}</td>
                        <td>{{ pasien.jenis_kelamin}}</td>
                        <td>{{ pasien.tanggal_lahir}}</td>
                        <td>{{ pasien.alamat}}</td>
                        <td>{{ pasien.no_telp}}</td>
                        <td>{{ pasien.nama_penjamin}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditPasien' ,params:{id: pasien.id}}" 
                          class="btn btn-xs btn-default"
                       >
                          Edit
                       </router-link>
                        <button 
                          class="btn btn-xs btn-danger" 
                          v-on:click="konfirmasiHapus(pasien.id,index,pasien.nama)"
                        >
                          Hapus
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    </table>
                    <vue-pagination
                      :data="pasiensData"
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
        pasiens: [],
        pasiensData: {},
        url: window.location.origin + (window.location.pathname).replace("home","pasien"),
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
          app.pasiens = resp.data.data;
          app.pasiensData = resp.data;
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
          app.pasiens = resp.data.data;
          app.pasiensData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaPasien){
          axios.delete(this.url + '/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Pasien " + namaPasien);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      prosesKonfirmasiAdmin(id,index,namaPasien){
          
          axios.get(this.url + '/' + id + '/konfirmasi')
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Mengkonfirmasi","Berhasil Mengkonfirmasi Pasien " + namaPasien);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaPasien){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Pasien " + namaPasien + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaPasien);
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

