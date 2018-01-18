,
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexPasien'}">Kelola Pasien</router-link></li>
              <li class="active">Edit  Pasien</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Pasien</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Nama Pasien" v-model="pasien.nama" autofocus=""/>
                        <span v-if="errors.nama" class="label label-danger"> {{ errors.nama[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jenis Kelamin</label>
                        <div class="col-md-4">
                          <select class="form-control" required="" v-model="pasien.jenis_kelamin">                          
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                          </select>
                        <span v-if="errors.jenis_kelamin" class="label label-danger"> {{ errors.jenis_kelamin[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Tanggal Lahir</label>
                        <div class="col-md-4">
                          <input type="date" class="form-control" required="" placeholder="Tanggal Lahir Pasien" v-model="pasien.tanggal_lahir" autofocus=""/>
                        <span v-if="errors.tanggal_lahir" class="label label-danger"> {{ errors.tanggal_lahir[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >No Telp</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="No Telp Pasien" v-model="pasien.no_telp" autofocus=""/>
                        <span v-if="errors.no_telp" class="label label-danger"> {{ errors.no_telp[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Alamat</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Alamat Pasien" v-model="pasien.alamat" autofocus=""/>
                        <span v-if="errors.alamat" class="label label-danger"> {{ errors.alamat[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Penjamin</label>
                        <div class="col-md-4">
                          <select class="form-control" required="" v-model="pasien.penjamin">                          
                            <option value="">Pilih Pasien</option>
                            <option v-for="penjamin in penjamins" :value="penjamin.id">{{ penjamin.nama}}</option>
                          </select>
                        <span v-if="errors.penjamin" class="label label-danger"> {{ errors.penjamin[0]}}</span>
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
        pasien: {
          nama: '',
          alamat: '',
          tanggal_lahir: '',
          jenis_kelamin: '',
          penjamin: '',
          no_telp: ''
        },
        pasienId : null,
        penjamins: [],
        url: window.location.origin + (window.location.pathname).replace("home","pasien"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     this.pasienId = this.$route.params.id;
     axios.get(app.url+'/'+this.pasienId+ '/edit')
     .then((resp) => {
       this.pasien =  resp.data;
     })
     .catch((resp) => {
        alert("Something Goes Wrong");    
     });
     app.getPenjamins();

    },
    methods: {
      getPenjamins(){
        
     var app = this;
        axios.get(app.url.replace('pasien','penjamin')+ '/all')
        .then(function(resp){
          app.penjamins = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Pasien",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newPasien = this.pasien;
        axios.patch(this.url + '/' + this.pasienId, newPasien)
        .then((resp) => {
          this.alert('Berhasil Mengubah Pasien ' + this.pasien.nama );
          this.$router.replace('/pasien/');
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

