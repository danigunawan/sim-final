<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Pembelian</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Pembelian</div>

                <div class="panel-body">

                    <router-link 
                      :to="{name: 'CreatePembelian'}" 
                      class="btn btn-md btn-primary"> 
                        Tambah Pembelian
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
                        <th>Supplier</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody v-if="pembelians.length">
                      <tr v-for="pembelian,index in pembelians">
                        <td>{{ pembelian.created_at}}</td>
                        <td>{{ pembelian.no_trans}}</td>
                        <td>{{ pembelian.nama_supplier}}</td>
                        <td>{{ pembelian.total_nilai}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditPembelian' ,params:{id: pembelian.id}}" 
                          class="btn btn-xs btn-default"
                       >
                          Edit
                       </router-link>
                        <button 
                          class="btn btn-xs btn-danger" 
                          v-on:click="konfirmasiHapus(pembelian.id,index,pembelian.no_trans)"
                        >
                          Hapus
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="7"><center>Tidak Ada Data</center></td>
                      </tr>
                    </tbody>
                    </table>
                    <vue-pagination
                      :data="pembeliansData"
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
        pembelians: [],
        pembeliansData: {},
        url: window.location.origin + (window.location.pathname).replace("home","pembelian"),
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
          app.pembelians = resp.data.data;
          app.pembeliansData = resp.data;
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
          app.pembelians = resp.data.data;
          app.pembeliansData = resp.data;
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
            this.alert("Berhasil Menghapus","Berhasil Menghapus Pembelian " + noTrans);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,noTrans){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Pembelian : " + noTrans + "?",
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

