<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Item Keluar</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Item Keluar</div>

                <div class="panel-body">

                    <router-link 
                      :to="{name: 'CreateItemKeluar'}" 
                      class="btn btn-md btn-primary"> 
                        Tambah Item Keluar
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
                    <tbody v-if="itemKeluars.length">
                      <tr v-for="itemKeluar,index in itemKeluars">
                        <td>{{ itemKeluar.created_at}}</td>
                        <td>{{ itemKeluar.no_trans}}</td>
                        <td>{{ itemKeluar.nama_produk}}</td>
                        <td>{{ itemKeluar.harga_pokok}}</td>
                        <td>{{ itemKeluar.jumlah}}</td>
                        <td>{{ itemKeluar.total_nilai}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditItemKeluar' ,params:{id: itemKeluar.id}}" 
                          class="btn btn-xs btn-default"
                       >
                          Edit
                       </router-link>
                        <button 
                          class="btn btn-xs btn-danger" 
                          v-on:click="konfirmasiHapus(itemKeluar.id,index,itemKeluar.no_trans)"
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
                      :data="itemKeluarsData"
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
        itemKeluars: [],
        itemKeluarsData: {},
        url: window.location.origin + (window.location.pathname).replace("home","item-keluar"),
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
          app.itemKeluars = resp.data.data;
          app.itemKeluarsData = resp.data;
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
          app.itemKeluars = resp.data.data;
          app.itemKeluarsData = resp.data;
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
            this.alert("Berhasil Menghapus","Berhasil Menghapus Item Keluar " + noTrans);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,noTrans){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Item Keluar : " + noTrans + "?",
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

