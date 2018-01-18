
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexKategoriTransaksi'}">Kelola Kategori Transaksi</router-link></li>
              <li class="active">Tambah Kategori Transaksi</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Kategori Transaksi</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Nama Kategori Transaksi" v-model="kategoriTransaksi.nama" autofocus=""/>
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
        kategoriTransaksi: {
          nama: ''
        },
        url: window.location.origin + (window.location.pathname).replace("home","kategori-transaksi"),
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
          title: "Berhasil Menambah Kategori Transaksi",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newKategoriTransaksi = this.kategoriTransaksi;
        axios.post(this.url,newKategoriTransaksi)
        .then((resp) => {
          this.alert('Berhasil Menambah Kategori Transaksi ' + this.kategoriTransaksi.nama );
          this.$router.replace('/kategori-transaksi/');
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

