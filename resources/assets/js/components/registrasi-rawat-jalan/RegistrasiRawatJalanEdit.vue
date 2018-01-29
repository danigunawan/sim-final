,
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexProduk'}">Kelola Produk</router-link></li>
              <li class="active">Edit  Produk</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Produk</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Kode</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Kode Produk" v-model="produk.kode" autofocus=""/>
                        <span v-if="errors.kode" class="label label-danger"> {{ errors.kode[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Nama Produk" v-model="produk.nama" autofocus=""/>
                        <span v-if="errors.nama" class="label label-danger"> {{ errors.nama[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Tipe</label>
                        <div class="col-md-4">
                          <select class="form-control" required="" v-model="produk.tipe_produk">                          
                            <option value="">Pilih Tipe Produk</option>
                            <option value="barang">barang</option>
                            <option value="jasa">jasa</option>
                          </select>
                        <span v-if="errors.tipe_produk" class="label label-danger"> {{ errors.tipe_produk[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Satuan</label>
                        <div class="col-md-4">
                          <select class="form-control" required="" v-model="produk.satuan">                          
                            <option value="">Pilih Satuan</option>
                            <option v-for="satuan in satuans" :value="satuan.id">{{ satuan.nama}}</option>
                          </select>
                        <span v-if="errors.satuan" class="label label-danger"> {{ errors.satuan[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Kategori Produk</label>
                        <div class="col-md-4">
                          <select class="form-control" required="" v-model="produk.kategori_produk">                          
                            <option value="">Pilih Kategori Produk</option>
                            <option v-for="kategori_produk in kategori_produks" :value="kategori_produk.id">{{ kategori_produk.nama}}</option>
                          </select>
                        <span v-if="errors.kategori_produk" class="label label-danger"> {{ errors.kategori_produk[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Harga Beli</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Harga Beli Produk" v-model="produk.harga_beli" autofocus=""/>
                        <span v-if="errors.harga_beli" class="label label-danger"> {{ errors.harga_beli[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Harga Jual 1</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Harga Jual 1 Produk" v-model="produk.harga_jual_1" autofocus=""/>
                        <span v-if="errors.harga_jual_1" class="label label-danger"> {{ errors.harga_jual_1[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Harga Jual 2</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control"  placeholder="Harga Jual 2 Produk" v-model="produk.harga_jual_2" autofocus=""/>
                        <span v-if="errors.harga_jual_2" class="label label-danger"> {{ errors.harga_jual_2[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Harga Jual 3</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control"  placeholder="Harga Jual 3 Produk" v-model="produk.harga_jual_3" autofocus=""/>
                        <span v-if="errors.harga_jual_3" class="label label-danger"> {{ errors.harga_jual_3[0]}}</span>
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
        produk: {
          kode: '',
          nama: '',
          tipe_produk: '',
          satuan: '',
          kategori_produk: '',
          harga_beli: '',
          harga_jual_1: '',
          harga_jual_2: '',
          harga_jual_3: ''
        },
        produkId : null,
        satuans: [],
        kategori_produks: [],
        url: window.location.origin + (window.location.pathname).replace("home","produk"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     this.produkId = this.$route.params.id;
     axios.get(app.url+'/'+this.produkId+ '/edit')
     .then((resp) => {
       this.produk =  resp.data;
     })
     .catch((resp) => {
        alert("Something Goes Wrong");    
     });
     app.getSatuans();
     app.getKategoriProduks();

    },
    methods: {
      getKategoriProduks(){
        
     var app = this;
        axios.get(app.url.replace('produk','kategori-produk')+ '/all')
        .then(function(resp){
          app.kategori_produks= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      getSatuans(){
        
     var app = this;
        axios.get(app.url.replace('produk','satuan')+ '/all')
        .then(function(resp){
          app.satuans = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Produk",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newProduk = this.produk;
        axios.patch(this.url + '/' + this.produkId, newProduk)
        .then((resp) => {
          this.alert('Berhasil Mengubah Produk ' + this.produk.nama );
          this.$router.replace('/produk/');
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

