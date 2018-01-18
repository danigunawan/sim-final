
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexKategoriProduk'}">Kelola Kategori Produk</router-link></li>
              <li class="active">Tambah Kategori Produk</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Kategori Produk</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Nama Kategori Produk" v-model="kategoriProduk.nama" autofocus=""/>
                        <span v-if="errors.nama" class="label label-danger"> {{ errors.nama[0]}}</span>
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
        kategoriProduk: {
          nama: ''
        },
        url: window.location.origin + (window.location.pathname).replace("home","kategori-produk"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Menambah Kategori Produk",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newKategoriProduk = this.kategoriProduk;
        axios.post(this.url,newKategoriProduk)
        .then((resp) => {
          this.alert('Berhasil Menambah Kategori Produk ' + this.kategoriProduk.nama );
          this.$router.replace('/kategori-produk/');
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

