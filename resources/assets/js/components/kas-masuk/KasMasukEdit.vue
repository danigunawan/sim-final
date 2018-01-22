,
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexKasMasuk'}">Kelola Kas Masuk</router-link></li>
              <li class="active">Edit  Kas Masuk</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Kas Masuk</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Kas</label>
                        <div class="col-md-4">
                          <vue-selectize class="form-control" required="" v-model="kasMasuk.kas">                          
                            <option value="">Pilih Kas</option>
                            <option v-for="kas in kasKas" :value="kas.id">{{ kas.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.kas" class="label label-danger"> {{ errors.kas[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Kategori Transaksi</label>
                        <div class="col-md-4">
                          <vue-selectize class="form-control" required="" v-model="kasMasuk.kategori_transaksi">                          
                            <option value="">Pilih Kategori Transaksi</option>
                            <option v-for="kategori_transaksi in kategoriTransaksis" :value="kategori_transaksi.id">{{ kategori_transaksi.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.kategori_transaksi" class="label label-danger"> {{ errors.kategori_transaksi[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jumlah</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Jumlah Kas Masuk" v-model="kasMasuk.jumlah" autofocus=""/>
                        <span v-if="errors.jumlah" class="label label-danger"> {{ errors.jumlah[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Keterangan</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Keterangan Kas Masuk" v-model="kasMasuk.keterangan" autofocus=""/>
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
        kasMasuk: {
          kas: '',
          kategori_transaksi: '',
          jumlah: '',
          keterangan: ''
        },
        kasMasukId : null,
        kasKas: [],
        kategoriTransaksis: [],
        url: window.location.origin + (window.location.pathname).replace("home","kas-masuk"),
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
         this.kasMasukId = this.$route.params.id;
         axios.get(app.url+'/'+this.kasMasukId+ '/edit')
         .then((resp) => {
           this.kasMasuk =  resp.data;
         })
         .catch((resp) => {
            alert("Something Goes Wrong");    
         });
          
      },
      getKategoriTransaksi(){
        
     var app = this;
        axios.get(app.url.replace('kas-masuk','kategori-transaksi')+ '/all')
        .then(function(resp){
          app.kategoriTransaksis= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      getKas(){
        
     var app = this;
        axios.get(app.url.replace('kas-masuk','kas')+ '/all')
        .then(function(resp){
          app.kasKas= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Kas Masuk",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newKasMasuk = this.kasMasuk;
        axios.patch(this.url + '/' + this.kasMasukId, newKasMasuk)
        .then((resp) => {
          this.alert('Berhasil Mengubah KasMasuk ' + this.kasMasuk.nama );
          this.$router.replace('/kas-masuk/');
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

