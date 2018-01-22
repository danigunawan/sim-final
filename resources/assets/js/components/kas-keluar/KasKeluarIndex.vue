<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Kas Keluar</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Kas Keluar</div>

                <div class="panel-body">

                    <router-link 
                      :to="{name: 'CreateKasKeluar'}" 
                      class="btn btn-md btn-primary"> 
                        Tambah Kas Keluar
                    </router-link>
                    <br/>
                    <div class="table-responsive">
                    
                    <div align="right">
                    <input type="text" placeholder="Pencarian ..." v-bind:style="{width: '20%' }" v-model="pencarian" class="form-control" />
                    </div>
                    <br/>
                    <table class="table table-bordered" >
                    <thead>
                        <th>Tanggal</th>
                        <th>No Trans</th>
                        <th>Kas</th>
                        <th>Kategori</th>
                        <th>jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody v-if="kasKeluars.length">
                      <tr v-for="kasKeluar,index in kasKeluars">
                        <td>{{ kasKeluar.created_at}}</td>
                        <td>{{ kasKeluar.no_trans}}</td>
                        <td>{{ kasKeluar.nama_kas}}</td>
                        <td>{{ kasKeluar.nama_kategori_transaksi}}</td>
                        <td>{{ kasKeluar.jumlah}}</td>
                        <td>{{ kasKeluar.keterangan}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditKasKeluar' ,params:{id: kasKeluar.id}}" 
                          class="btn btn-xs btn-default"
                       >
                          Edit
                       </router-link>
                        <button 
                          class="btn btn-xs btn-danger" 
                          v-on:click="konfirmasiHapus(kasKeluar.id,index,kasKeluar.no_trans)"
                        >
                          Hapus
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    </table>
                    <vue-pagination
                      :data="kasKeluarsData"
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
        kasKeluars: [],
        kasKeluarsData: {},
        url: window.location.origin + (window.location.pathname).replace("home","kas-keluar"),
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
          app.kasKeluars = resp.data.data;
          app.kasKeluarsData = resp.data;
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
          app.kasKeluars = resp.data.data;
          app.kasKeluarsData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,noTrans){
          axios.delete(this.url + '/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Kas Keluar " + noTrans);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,noTrans){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Kas Keluar : " + noTrans + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,noTrans);
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

