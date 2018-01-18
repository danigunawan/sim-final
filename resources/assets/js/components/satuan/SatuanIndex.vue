<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Satuan</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Satuan</div>

                <div class="panel-body">

                    <router-link 
                      :to="{name: 'CreateSatuan'}" 
                      class="btn btn-md btn-primary"> 
                        Tambah Satuan
                    </router-link>
                    <br/>
                    <div class="table-responsive">
                    
                    <div align="right">
                    <input type="text" placeholder="Pencarian ..." v-bind:style="{width: '20%' }" v-model="pencarian" class="form-control" />
                    </div>
                    <br/>
                    <table class="table table-bordered" >
                    <thead>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody v-if="satuans.length">
                      <tr v-for="satuan,index in satuans">
                        <td>{{ satuan.nama}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditSatuan' ,params:{id: satuan.id}}" 
                          class="btn btn-xs btn-default"
                       >
                          Edit
                       </router-link>
                        <button 
                          class="btn btn-xs btn-danger" 
                          v-on:click="konfirmasiHapus(satuan.id,index,satuan.nama)"
                        >
                          Hapus
                        </button>
                        </td>
                      </tr>
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
        satuans: [],
        satuansData: {},
        url: window.location.origin + (window.location.pathname).replace("home","satuan"),
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
          app.satuans = resp.data.data;
          app.satuansData = resp.data;
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
          app.satuans = resp.data.data;
          app.satuansData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaSatuan){
          axios.delete(this.url + '/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Satuan " + namaSatuan);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      prosesKonfirmasiAdmin(id,index,namaSatuan){
          
          axios.get(this.url + '/' + id + '/konfirmasi')
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Mengkonfirmasi","Berhasil Mengkonfirmasi Satuan " + namaSatuan);
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaSatuan){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Satuan " + namaSatuan + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaSatuan);
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

