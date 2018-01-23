<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Kas Mutasi</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Kas Mutasi</div>

                <div class="panel-body">

                    <router-link 
                      :to="{name: 'CreateKasMutasi'}" 
                      class="btn btn-md btn-primary"> 
                        Tambah Kas Mutasi
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
                    <tbody v-if="kasMutasis.length">
                      <tr v-for="kasMutasi,index in kasMutasis">
                        <td>{{ kasMutasi.created_at}}</td>
                        <td>{{ kasMutasi.no_trans}}</td>
                        <td>{{ kasMutasi.nama_dari_kas}}</td>
                        <td>{{ kasMutasi.nama_ke_kas}}</td>
                        <td>{{ kasMutasi.jumlah}}</td>
                        <td>{{ kasMutasi.keterangan}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditKasMutasi' ,params:{id: kasMutasi.id}}" 
                          class="btn btn-xs btn-default"
                       >
                          Edit
                       </router-link>
                        <button 
                          class="btn btn-xs btn-danger" 
                          v-on:click="konfirmasiHapus(kasMutasi.id,index,kasMutasi.no_trans)"
                        >
                          Hapus
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    </table>
                    <vue-pagination
                      :data="kasMutasisData"
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
        kasMutasis: [],
        kasMutasisData: {},
        url: window.location.origin + (window.location.pathname).replace("home","kas-mutasi"),
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
          app.kasMutasis = resp.data.data;
          app.kasMutasisData = resp.data;
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
          app.kasMutasis = resp.data.data;
          app.kasMutasisData = resp.data;
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
            this.alert("Berhasil Menghapus","Berhasil Menghapus Kas Mutasi " + noTrans);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,noTrans){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Kas Mutasi : " + noTrans + "?",
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

