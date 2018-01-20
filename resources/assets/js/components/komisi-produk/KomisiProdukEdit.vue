,
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexKomisiProduk'}">Kelola Komisi Produk</router-link></li>
              <li class="active">Edit  Komisi Produk</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Komisi Produk</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Produk</label>
                        <div class="col-md-4">
                          <select class="form-control" required="" v-model="komisiProduk.produk">                          
                            <option value="">Pilih Produk</option>
                            <option v-for="produk in produks" :value="produk.id">{{ produk.nama}}</option>
                          </select>
                        <span v-if="errors.produk" class="label label-danger"> {{ errors.produk[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >User</label>
                        <div class="col-md-4">
                          <select class="form-control" required="" v-model="komisiProduk.user">                          
                            <option value="">Pilih User</option>
                            <option v-for="user in users" :value="user.id">{{ user.name}}</option>
                          </select>
                        <span v-if="errors.user" class="label label-danger"> {{ errors.user[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jumlah Prosentase</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Jumlah Prosentase Komisi Produk" v-model="komisiProduk.jumlah_prosentase" autofocus=""/>
                        <span v-if="errors.jumlah_prosentase" class="label label-danger"> {{ errors.jumlah_prosentase[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jumlah Uang</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Jumlah Uang Komisi Produk" v-model="komisiProduk.jumlah_uang" autofocus=""/>
                        <span v-if="errors.jumlah_uang" class="label label-danger"> {{ errors.jumlah_uang[0]}}</span>
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
        komisiProduk: {
          produk: '',
          user: '',
          jumlah_prosentase: '',
          jumlah_uang: ''
        },
        produks: [],
        users: [],
        komisirProdukId: null,
        url: window.location.origin + (window.location.pathname).replace("home","komisi-produk"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     app.getKomisiProduk();
     app.getProduks();
     app.getUsers();

    },
    methods: {
      getKomisiProduk(){
         var app = this;
         this.komisiProdukId = this.$route.params.id;
         axios.get(app.url+'/'+this.komisiProdukId+ '/edit')
         .then((resp) => {
           this.komisiProduk =  resp.data;
         })
         .catch((resp) => {
            alert("Something Goes Wrong");    
         });
          
      },
      getProduks(){
        
     var app = this;
        axios.get(app.url.replace('komisi-produk','produk')+ '/all')
        .then(function(resp){
          app.produks= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      getUsers(){
        
      var app = this;
        axios.get(app.url.replace('komisi-produk','user')+ '/all')
        .then(function(resp){
          app.users= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Komisi Produk",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newKomisiProduk = this.komisiProduk;
        axios.patch(this.url + '/' + this.komisiProdukId, newKomisiProduk)
        .then((resp) => {
          this.alert('Berhasil Mengubah Komisi Produk ');
          this.$router.replace('/komisi-produk/');
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

