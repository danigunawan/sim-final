
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexItemMasuk'}">Kelola Item Masuk</router-link></li>
              <li class="active">Tambah Item Masuk</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Item Masuk</div>
                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Item</label>
                        <div class="col-md-4">
                          <vue-selectize class="form-control" required="" v-model="itemMasuk.produk">                          
                            <option value="">Pilih Item</option>
                            <option v-for="produk in items" :value="produk.id">{{ produk.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.produk" class="label label-danger"> {{ errors.produk[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Harga Pokok</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" placeholder="Harga Pokok Item Masuk" v-model="itemMasuk.harga_pokok" autofocus=""/>
                        <span v-if="errors.harga_pokok" class="label label-danger"> {{ errors.harga_pokok[0]}}</span>
                        <span class="label label-primary">Jika tidak input, maka akan di gunakan harga beli</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jumlah</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Jumlah Item Masuk" v-model="itemMasuk.jumlah" autofocus=""/>
                        <span v-if="errors.jumlah" class="label label-danger"> {{ errors.jumlah[0]}}</span>
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
        itemMasuk: {
          produk: '',
          jumlah: '',
          harga_pokok: ''
        },
        items: [],
        kategoriTransaksis: [],
        url: window.location.origin + (window.location.pathname).replace("home","item-masuk"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     app.getItem();
     app.getKategoriTransaksi();
    },    
    methods: {
      getItem(){
        
     var app = this;
        axios.get(app.url.replace('item-masuk','produk')+ '/all')
        .then(function(resp){
          app.items= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Menambah Item Masuk",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newItemMasuk = this.itemMasuk;
        axios.post(this.url,newItemMasuk)
        .then((resp) => {
          this.alert('Berhasil Menambah ItemMasuk ' + this.itemMasuk.jumlah );
          this.$router.replace('/item-masuk/');
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

