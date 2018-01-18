
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexKateogriProduk'}">Kelola Kategori Produk</router-link></li>
              <li class="active">Edit  Kategori Produk</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Kategori Produk</div>

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
        kategoriProdukId : null,
        url: window.location.origin + (window.location.pathname).replace("home","kategori-produk"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     this.kategoriProdukId = this.$route.params.id;
     axios.get(app.url+'/'+this.kategoriProdukId+ '/edit')
     .then((resp) => {
       this.kategoriProduk =  resp.data;
     })
     .catch((resp) => {
        alert("Something Goes Wrong");    
     });

    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Kategori Produk",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newKateogriProduk = this.kategoriProduk;
        axios.patch(this.url + '/' + this.kategoriProdukId, newKateogriProduk)
        .then((resp) => {
          this.alert('Berhasil Mengubah Kategori Produk ' + this.kategoriProduk.nama );
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

