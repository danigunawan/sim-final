
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
                    <p>Pencarian Pasien</p>
                    <form v-on:submit.prevent="pencarianPasien()" class="form-inline" >
                      <div class="form-group">
                          <input 
                             type="text" 
                             class="form-control" 
                             placeholder="No RM"
                             v-model="pencarian.no_rm" 
                           />
                        <span v-if="errors.no_rm" class="label label-danger"> {{ errors.no_rm[0]}}</span>
                      </div>
                      <div class="form-group">
                          <input 
                             type="text" 
                             class="form-control" 
                             placeholder="Nama"
                             v-model="pencarian.nama" 
                           />
                        <span v-if="errors.nama" class="label label-danger"> {{ errors.nama[0]}}</span>
                      </div>
                      <div class="form-group">
                          <input 
                             type="text" 
                             class="form-control" 
                             placeholder="Tanggal Lahir"
                             v-model="pencarian.tanggal_lahir" 
                           />
                        <span v-if="errors.tanggal_lahir" class="label label-danger"> {{ errors.tanggal_lahir[0]}}</span>
                      </div>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                      </div>
                    </form>
                    <br/>
                    <table class="table table-bordered">
                     <thead>
                       <th>No RM</th>
                       <th>Nama Pasien</th>
                       <th>TTL</th>
                       <th>Alamat</th>
                     </thead> 
                     <tbody v-if="pasiens.length">
                       <tr v-for="pasien in pasiens" v-on:click="pilihPasien(pasien)">
                         <td>{{ pasien.no_rm}}</td>
                         <td>{{ pasien.nama}}</td>
                         <td>{{ pasien.tanggal_lahir}}</td>
                         <td>{{ pasien.alamat}}</td>
                       
                       </tr>
                     </tbody>
                     <tbody v-else >
                       <tr><td colspan="4"><center>Tidak Ada Data</center></td></tr>
                     </tbody>
                    </table>
                    <vue-spinner v-if="loading"></vue-spinner>
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >No RM</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" readonly="" placeholder="No RM" v-model="registrasi.no_rm" />
                        <span v-if="errors.no_rm" class="label label-danger"> {{ errors.no_rm[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" readonly=""placeholder="Nama Pasien" v-model="registrasi.nama" />
                        <span v-if="errors.nama" class="label label-danger"> {{ errors.nama[0]}}</span>
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
                        <label for="name" class="col-md-2 control-label" >Ruangan</label>
                        <div class="col-md-4">
                          <vue-selectize 
                            class="form-control" 
                            required=""
                            v-model="registrasi.ruangan"
                            id="ruangan"
                          >               
                            <option value="">Pilih Ruangan </option>
                            <option v-for="ruangan in ruangans" :value="ruangan.id">{{ ruangan.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.ruangan" class="label label-danger"> {{ errors.ruangan[0]}}</span>
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
          no_rm: '',
          nama: '',
          penjamin: '',
          dokter: '',
          poli: '',
          ruangan: '',
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
        pencarian: {
          no_rm: '',
          nama: '',
          tanggal_lahir: ''
        },
        polis: [],
        pasiens: [],
        penjamins: [],
        dokters: [],
        ruangans: [],
        url: window.location.origin + (window.location.pathname).replace("home","registrasi-rawat-inap"),
        errors: [],
        message: '',
        loading: false
      }
    },
    mounted()  {
     var app = this;
     app.getPolis();
     app.getRuangan();
     app.getDokter();
     app.getPenjamins();
    },    
    methods: {
      pilihPasien(pasien){
        var app = this;
        app.registrasi.no_rm = pasien.no_rm;
        app.registrasi.nama = pasien.nama;
        app.registrasi.penjamin = pasien.penjamin;
        app.pasiens = [];
        document.getElementById('poli-selectized').focus();

      },
      pencarianPasien(){
        
     var app = this;
     app.loading = true;
     var no_rm = app.pencarian.no_rm;
     var nama = app.pencarian.nama;
     var tanggal_lahir = app.pencarian.tanggal_lahir;
     var url = app.url.replace('registrasi-rawat-inap','pasien/pencarian-registrasi?');
     url += 'no_rm=' + no_rm + '&nama=' + nama + '&tanggal_lahir=' + tanggal_lahir;
        axios.get(url)
        .then(function(resp){
          app.pasiens = resp.data.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        });
        
      },
      getRuangan(){
        
     var app = this;
        axios.get(app.url.replace('registrasi-rawat-inap','ruangan/all') )
        .then(function(resp){
          app.ruangans = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      getDokter(){
        
     var app = this;
        axios.get(app.url.replace('registrasi-rawat-inap','user/dokter') )
        .then(function(resp){
          app.dokters = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      getPenjamins(){
        
     var app = this;
        axios.get(app.url.replace('registrasi-rawat-inap','penjamin')+ '/all')
        .then(function(resp){
          app.penjamins= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      getPolis(){
        
     var app = this;
        axios.get(app.url.replace('registrasi-rawat-inap','poli')+ '/all')
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
        axios.post(this.url + '/lama',newRegistrasi)
        .then((resp) => {
          this.alert('Berhasil Menambah Registrasi Rawat Inap ' + this.registrasi.nama );
          this.$router.replace('/registrasi-rawat-inap/');
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

