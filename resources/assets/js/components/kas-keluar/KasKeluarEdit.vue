,
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexKasKeluar'}">Kelola Kas Keluar</router-link></li>
              <li class="active">Edit  Kas Keluar</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Kas Keluar</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Kas</label>
                        <div class="col-md-4">
                          <vue-selectize class="form-control" required="" v-model="kasKeluar.kas">                          
                            <option value="">Pilih Kas</option>
                            <option v-for="kas in kasKas" :value="kas.id">{{ kas.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.kas" class="label label-danger"> {{ errors.kas[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Kategori Transaksi</label>
                        <div class="col-md-4">
                          <vue-selectize class="form-control" required="" v-model="kasKeluar.kategori_transaksi">                          
                            <option value="">Pilih Kategori Transaksi</option>
                            <option v-for="kategori_transaksi in kategoriTransaksis" :value="kategori_transaksi.id">{{ kategori_transaksi.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.kategori_transaksi" class="label label-danger"> {{ errors.kategori_transaksi[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jumlah</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Jumlah Kas Keluar" v-model="kasKeluar.jumlah" autofocus=""/>
                        <span v-if="errors.jumlah" class="label label-danger"> {{ errors.jumlah[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Keterangan</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Keterangan Kas Keluar" v-model="kasKeluar.keterangan" autofocus=""/>
                        <span v-if="errors.keterangan" class="label label-danger"> {{ errors.keterangan[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                      </div>
                    </form>
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
        kasKeluar: {
          kas: '',
          kategori_transaksi: '',
          jumlah: '',
          keterangan: ''
        },
        kasKeluarId : null,
        kasKas: [],
        kategoriTransaksis: [],
        url: window.location.origin + (window.location.pathname).replace("home","kas-keluar"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     app.getEditingData();
     app.getKas();
     app.getKategoriTransaksi();

    },
    methods: {
      getEditingData(){
         var app = this;
         this.kasKeluarId = this.$route.params.id;
         axios.get(app.url+'/'+this.kasKeluarId+ '/edit')
         .then((resp) => {
           this.kasKeluar =  resp.data;
         })
         .catch((resp) => {
            alert("Something Goes Wrong");    
         });
          
      },
      getKategoriTransaksi(){
        
     var app = this;
        axios.get(app.url.replace('kas-keluar','kategori-transaksi')+ '/all')
        .then(function(resp){
          app.kategoriTransaksis= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      getKas(){
        
     var app = this;
        axios.get(app.url.replace('kas-keluar','kas')+ '/all')
        .then(function(resp){
          app.kasKas= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Kas Keluar",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newKasKeluar = this.kasKeluar;
        axios.patch(this.url + '/' + this.kasKeluarId, newKasKeluar)
        .then((resp) => {
          this.alert('Berhasil Mengubah KasKeluar ' + this.kasKeluar.nama );
          this.$router.replace('/kas-keluar/');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Something Goes Wrong');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      }
    }
  }

</script>

