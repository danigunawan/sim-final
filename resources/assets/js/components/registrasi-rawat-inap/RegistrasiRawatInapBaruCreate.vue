
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexRegistrasiRawatInap'}"> Registrasi Rawat Inap</router-link></li>
              <li class="active">Tambah Registrasi Rawat Inap</li>
            </ul>

            <div class="panel panel-default">
                <div class="panel-heading">Tambah Registrasi Rawat Inap</div>
                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Nama Pasien" v-model="registrasi.nama" />
                        <span v-if="errors.nama" class="label label-danger"> {{ errors.nama[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jenis Kelamin</label>
                        <div class="col-md-4">
                          <select class="form-control" required="" v-model="registrasi.jenis_kelamin">                          
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
                          <input type="date" class="form-control" required="" placeholder="Tanggal Lahir Pasien" v-model="registrasi.tanggal_lahir" />
                        <span v-if="errors.tanggal_lahir" class="label label-danger"> {{ errors.tanggal_lahir[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Alamat</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Alamat Pasien" v-model="registrasi.alamat" />
                        <span v-if="errors.alamat" class="label label-danger"> {{ errors.alamat[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >No Telp</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="No Telp Pasien" v-model="registrasi.no_telp" />
                        <span v-if="errors.no_telp" class="label label-danger"> {{ errors.no_telp[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Penjamin</label>
                        <div class="col-md-4">
                          <vue-selectize 
                            class="form-control" 
                            required=""
                            v-model="registrasi.penjamin"
                            id="penjamin"
                          >               
                            <option value="">Pilih Penjamin </option>
                            <option v-for="penjamin in penjamins" :value="penjamin.id">{{ penjamin.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.penjamin" class="label label-danger"> {{ errors.penjamin[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Poli</label>
                        <div class="col-md-4">
                          <vue-selectize 
                            class="form-control" 
                            required="" 
                            v-model="registrasi.poli"
                            id="poli"
                          >     
                            <option value="">Pilih Poli</option>
                            <option v-for="poli in polis" :value="poli.id">{{ poli.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.poli" class="label label-danger"> {{ errors.poli[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Dokter</label>
                        <div class="col-md-4">
                          <vue-selectize class="form-control" required="" v-model="registrasi.dokter">                          
                            <option value="">Pilih Dokter</option>
                            <option v-for="dokter in dokters" :value="dokter.id">{{ dokter.name}}</option>
                          </vue-selectize>
                        <span v-if="errors.dokter" class="label label-danger"> {{ errors.dokter[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Keadaan Umum</label>
                        <div class="col-md-4">
                          <vue-selectize class="form-control" required="" v-model="registrasi.keadaan_umum">                          
                            <option value="">Pilih Keadaan Umum </option>
                            <option >Tampak Normal </option>
                            <option >Pucat dan Lemas </option>
                            <option >Sadar dan Cidera </option>
                            <option >Pingsan atau tidak sadar </option>
                            <option >Meninggal Sebelum Tiba </option>
                          </vue-selectize>
                        <span v-if="errors.keadaan_umum" class="label label-danger"> {{ errors.keadaan_umum[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Alergi Obat</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control"  placeholder="Alergi Obat" v-model="registrasi.alergi_obat" />
                        <span v-if="errors.alergi_obat" class="label label-danger"> {{ errors.alergi_obat[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Sistole / Diastole</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control"  placeholder="Sistole / Diastole" v-model="registrasi.sistole_diastole" />
                        <span v-if="errors.sistole_diastole" class="label label-danger"> {{ errors.sistole_diastole[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Frekuensi Pernapasan</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control"  placeholder="Frekuensi Pernapasan" v-model="registrasi.frekuensi_pernapasan" />
                        <span v-if="errors.frekuensi_pernapasan" class="label label-danger"> {{ errors.frekuensi_pernapasan[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Suhu</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control"  placeholder="Suhu" v-model="registrasi.suhu" />
                        <span v-if="errors.suhu" class="label label-danger"> {{ errors.suhu[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nadi</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control"  placeholder="Nadi" v-model="registrasi.nadi" />
                        <span v-if="errors.nadi" class="label label-danger"> {{ errors.nadi[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Berat Bedan</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control"  placeholder="Berat Bedan" v-model="registrasi.berat_badan" />
                        <span v-if="errors.berat_badan" class="label label-danger"> {{ errors.berat_badan[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Tinggi Bedan</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control"  placeholder="Tinggi Bedan" v-model="registrasi.tinggi_badan" />
                        <span v-if="errors.tinggi_badan" class="label label-danger"> {{ errors.tinggi_badan[0]}}</span>
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
        registrasi: {
          nama: '',
          jenis_kelamin: '',
          tanggal_lahir: '',
          alamat: '',
          no_telp: '',
          penjamin: '',
          dokter: '',
          poli: '',
          keadaan_umum: '',
          alergi_obat: '',
          sistole_diastole: '',
          registrasi: '',
          frekuensi_pernapasan: '',
          suhu: '',
          nadi: '',
          berat_badan: '',
          tinggi_badan: '',
        },
        polis: [],
        penjamins: [],
        dokters: [],
        url: window.location.origin + (window.location.pathname).replace("home","registrasi-rawat-jalan"),
        errors: [],
        message: '',
        loading: false
      }
    },
    mounted()  {
     var app = this;
     app.getPolis();
     app.getDokter();
     app.getPenjamins();
    },    
    methods: {
      getDokter(){
        
     var app = this;
        axios.get(app.url.replace('registrasi-rawat-jalan','user/dokter') )
        .then(function(resp){
          app.dokters = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      getPenjamins(){
        
     var app = this;
        axios.get(app.url.replace('registrasi-rawat-jalan','penjamin')+ '/all')
        .then(function(resp){
          app.penjamins= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      getPolis(){
        
     var app = this;
        axios.get(app.url.replace('registrasi-rawat-jalan','poli')+ '/all')
        .then(function(resp){
          app.polis = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Menambah Registrasi Rawat Inap",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newRegistrasi = this.registrasi;
        axios.post(this.url + '/baru',newRegistrasi)
        .then((resp) => {
          this.alert('Berhasil Menambah Registrasi Rawat Inap ' + this.registrasi.nama );
          this.$router.replace('/registrasi-rawat-jalan/');
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

