
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexPenjamin'}">Kelola Penjamin</router-link></li>
              <li class="active">Tambah Penjamin</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Penjamin</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Nama Penjamin" v-model="penjamin.nama" autofocus=""/>
                        <span v-if="errors.nama" class="label label-danger"> {{ errors.nama[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Alamat</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Alamat Penjamin" v-model="penjamin.alamat" autofocus=""/>
                        <span v-if="errors.alamat" class="label label-danger"> {{ errors.alamat[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >No Telp</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="No Telp Penjamin" v-model="penjamin.no_telp" autofocus=""/>
                        <span v-if="errors.no_telp" class="label label-danger"> {{ errors.no_telp[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Level Harga</label>
                        <div class="col-md-4">
                          <select class="form-control" required="" v-model="penjamin.level_harga">                          
                            <option value="">Pilih Level Harga</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                          </select>
                        <span v-if="errors.level_harga" class="label label-danger"> {{ errors.level_harga[0]}}</span>
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
        penjamin: {
          nama: '',
          alamat: '',
          no_telp: '',
          level_harga: ''
        },
        url: window.location.origin + (window.location.pathname).replace("home","penjamin"),
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
          title: "Berhasil Menambah Penjamin",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newPenjamin = this.penjamin;
        axios.post(this.url,newPenjamin)
        .then((resp) => {
          this.alert('Berhasil Menambah Penjamin ' + this.penjamin.nama );
          this.$router.replace('/penjamin/');
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

