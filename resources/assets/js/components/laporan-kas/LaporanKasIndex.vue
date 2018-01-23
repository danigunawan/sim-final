<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li>Laporan</li>
              <li class="active">Laporan Transaksi Kas</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Transaksi Kas</div>

                <div class="panel-body">
                     <form v-on:submit.prevent="getResults" class="form-inline">
                      <div class="form-group">
                        <input type="date" required="" class="form-control"  v-model="laporan.dariTanggal" placeholder="Dari Tanggal">
                      </div>
                      <div class="form-group">
                        <input type="date" required="" class="form-control" v-model="laporan.sampaiTanggal" placeholder="Sampai Tanggal">
                      </div>
                      <div class="form-group">
                        <select
                          v-model="laporan.kas"
                          class="form-control" 
                          required="" >
                            <option value="">Pilih Kas</option>
                            <option v-for="kas in kasKas" :value="kas.id">{{ kas.nama}}</option>
                          </select>
                      
                      </div>
                      <button type="submit" class="btn btn-default">Tampil</button>
                    </form> 
                    <br/>
                    <div class="table-responsive">
                    
                    <table class="table table-bordered" >
                    <thead>
                        <th>Tanggal</th>
                        <th>No Transaksi</th>
                        <th>Dari Akun</th>
                        <th>Ke Akun</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                    </thead>
                    <tbody v-if="transaksiKas.length">
                      <tr v-for="transaksi,index in transaksiKas">
                        <td>{{ transaksi.created_at}}</td>
                        <td>{{ transaksi.no_trans}}</td>
                        <td>{{ transaksi.nama_kas}}</td>
                        <td>{{ transaksi.nama_kategori_transaksi}}</td>
                        <td>{{ transaksi.masuk}}</td>
                        <td>{{ transaksi.keluar}}</td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr><td colspan="7"><center>Tidak Ada Data</center></td></tr>
                    </tbody>
                    </table>
                    <vue-pagination 
                      :data="transaksiKasData" 
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
        transaksiKas: [],
        transaksiKasData: {},
        laporan : { 
            kas: '',
            dariTanggal: '',
            sampaiTanggal: '',
            },
        kasKas: [],
        url: window.location.origin + (window.location.pathname).replace("home","transaksi-kas"),
        loading: true
      }
    },
    mounted()  {
     var app = this;
    app.getKas();
    },
    methods: {
      getKas(page){
       var app = this;
        axios.get(app.url.replace('transaksi-kas','kas') + '/all')
        .then(function(resp){
          app.kasKas= resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      getResults(page){
        
        var app = this;
        app.loading = true;
        if(typeof page == 'undefined'){
          page = 1;
        }
        var url = app.url + '/laporan?page=' + page + '&kas=' + app.laporan.kas 
                + '&dariTanggal=' + app.laporan.dariTanggal + '&sampaiTanggal=' + app.laporan.sampaiTanggal;
        axios.get(url)
        .then(function(resp){
          app.transaksiKas = resp.data.data;
          app.transaksiKasData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
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

