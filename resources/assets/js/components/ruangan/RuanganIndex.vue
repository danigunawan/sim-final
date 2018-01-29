<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Ruangan</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Ruangan</div>

                <div class="panel-body">

                    <router-link 
                      :to="{name: 'CreateRuangan'}" 
                      class="btn btn-md btn-primary"> 
                        Tambah Ruangan
                    </router-link>
                    <br/>
                    <div class="table-responsive">
                    
                    <div align="right">
                    <input type="text" placeholder="Pencarian ..." v-bind:style="{width: '20%' }" v-model="pencarian" class="form-control" />
                    </div>
                    <br/>
                    <table class="table table-bordered" >
                    <thead>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Jumlah Kasur</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody v-if="ruangans.length">
                      <tr v-for="ruangan,index in ruangans">
                        <td>{{ ruangan.kode}}</td>
                        <td>{{ ruangan.nama}}</td>
                        <td>{{ ruangan.jumlah_kasur}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditRuangan' ,params:{id: ruangan.id}}" 
                          class="btn btn-xs btn-default"
                       >
                          Edit
                       </router-link>
                        <button 
                          class="btn btn-xs btn-danger" 
                          v-on:click="konfirmasiHapus(ruangan.id,index,ruangan.nama)"
                        >
                          Hapus
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr><td colspan="4"><center>Tidak Ada Data</center></td></tr>
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
        ruangans: [],
        ruangansData: {},
        url: window.location.origin + (window.location.pathname).replace("home","ruangan"),
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
          app.ruangans = resp.data.data;
          app.ruangansData = resp.data;
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
          app.ruangans = resp.data.data;
          app.ruangansData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaRuangan){
          axios.delete(this.url + '/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Ruangan " + namaRuangan);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaRuangan){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Ruangan " + namaRuangan + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaRuangan);
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

