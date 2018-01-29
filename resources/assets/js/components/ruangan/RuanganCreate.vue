
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexRuangan'}">Kelola Ruangan</router-link></li>
              <li class="active">Tambah Ruangan</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Ruangan</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Kode</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Kode Ruangan" v-model="ruangan.kode" />
                        <span v-if="errors.kode" class="label label-danger"> {{ errors.kode[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Nama Ruangan" v-model="ruangan.nama" />
                        <span v-if="errors.nama" class="label label-danger"> {{ errors.nama[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jumlah Kasur</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Jumlah Kasur Ruangan" v-model="ruangan.jumlah_kasur" />
                        <span v-if="errors.jumlah_kasur" class="label label-danger"> {{ errors.jumlah_kasur[0]}}</span>
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
        ruangan: {
          nama: '',
          kode: '',
          jumlah_kasur: ''
        },
        url: window.location.origin + (window.location.pathname).replace("home","ruangan"),
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
          title: "Berhasil Menambah Ruangan",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newRuangan = this.ruangan;
        axios.post(this.url,newRuangan)
        .then((resp) => {
          this.alert('Berhasil Menambah Ruangan ' + this.ruangan.nama );
          this.$router.replace('/ruangan/');
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

