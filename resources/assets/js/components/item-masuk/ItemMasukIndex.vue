<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Item Masuk</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Item Masuk</div>

                <div class="panel-body">

                    <router-link 
                      :to="{name: 'CreateItemMasuk'}" 
                      class="btn btn-md btn-primary"> 
                        Tambah Item Masuk
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
                        <th>Produk</th>
                        <th>Harga Pokok</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody v-if="itemMasuks.length">
                      <tr v-for="itemMasuk,index in itemMasuks">
                        <td>{{ itemMasuk.created_at}}</td>
                        <td>{{ itemMasuk.no_trans}}</td>
                        <td>{{ itemMasuk.nama_produk}}</td>
                        <td>{{ itemMasuk.harga_pokok}}</td>
                        <td>{{ itemMasuk.jumlah}}</td>
                        <td>{{ itemMasuk.total_nilai}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditItemMasuk' ,params:{id: itemMasuk.id}}" 
                          class="btn btn-xs btn-default"
                       >
                          Edit
                       </router-link>
                        <button 
                          class="btn btn-xs btn-danger" 
                          v-on:click="konfirmasiHapus(itemMasuk.id,index,itemMasuk.no_trans)"
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
                      :data="itemMasuksData"
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
        itemMasuks: [],
        itemMasuksData: {},
        url: window.location.origin + (window.location.pathname).replace("home","item-masuk"),
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
          app.itemMasuks = resp.data.data;
          app.itemMasuksData = resp.data;
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
          app.itemMasuks = resp.data.data;
          app.itemMasuksData = resp.data;
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
            this.alert("Berhasil Menghapus","Berhasil Menghapus Item Masuk " + noTrans);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,noTrans){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Item Masuk : " + noTrans + "?",
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

