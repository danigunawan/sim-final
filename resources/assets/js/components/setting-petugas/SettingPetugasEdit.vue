
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexSettingPetugas'}">Kelola Setting Petugas</router-link></li>
              <li class="active">Edit  Setting Petugas</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Setting Petugas</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Dokter </label>
                        <div class="col-md-4">
                          <vue-selectize
                            class="form-control"
                            v-model="settingPetugas.dokter">
                            <option value="">-- Pilih Dokter--</option>
                            <option v-for="petugas in dokters" :value="petugas.id">{{ petugas.name}} </option>
                          </vue-selectize>
                        <span v-if="errors.dokter" class="label label-danger"> {{ errors.dokter[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Perawat </label>
                        <div class="col-md-4">
                          <vue-selectize
                            class="form-control"
                            v-model="settingPetugas.perawat">
                            <option value="">-- Pilih Perawat--</option>
                            <option v-for="petugas in perawats" :value="petugas.id">{{ petugas.name}} </option>
                          </vue-selectize>
                        <span v-if="errors.perawat" class="label label-danger"> {{ errors.perawat[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Farmasi </label>
                        <div class="col-md-4">
                          <vue-selectize
                            class="form-control"
                            v-model="settingPetugas.farmasi">
                            <option value="">-- Pilih Farmasi--</option>
                            <option v-for="petugas in farmasis" :value="petugas.id">{{ petugas.name}} </option>
                          </vue-selectize>
                        <span v-if="errors.farmasi" class="label label-danger"> {{ errors.farmasi[0]}}</span>
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
        settingPetugas: {
          text: '',
          value: ''
        },
        settingPetugasId : null,
        dokters: [],
        perawats: [],
        farmasis: [],
        url: window.location.origin + (window.location.pathname).replace("home","setting-petugas"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     this.settingPetugasId = this.$route.params.id;
     axios.get(app.url+'/'+this.settingPetugasId+ '/edit')
     .then((resp) => {
       this.settingPetugas =  resp.data;
     })
     .catch((resp) => {
        alert("Something Goes Wrong");
     });
     app.getPetugas();

    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah SettingPetugas",
          text: pesan,
          icon: "success"
        });
      },
      getPetugas(){
        var app = this;
        axios.get(app.url.replace('setting-petugas','user')+ '/all')
        .then(function(resp){
          for(var i = 0; i < resp.data.length; i++){
            if(resp.data[i].jabatan == 'dokter'){
              app.dokters.push(resp.data[i]);
            } else if(resp.data[i].jabatan == 'perawat'){
            app.perawats.push(resp.data[i])
            } else if(resp.data[i].jabatan == 'farmasi'){
              app.farmasis.push(resp.data[i]);
            }
          }
        })
        .catch(function(resp){
          console.log(resp);

        });
      },
      saveForm(){
        var newSettingPetugas = this.settingPetugas;
        axios.patch(this.url + '/' + this.settingPetugasId, newSettingPetugas)
        .then((resp) => {
          this.alert('Berhasil Mengubah SettingPetugas ' + this.settingPetugas.nama );
          this.$router.replace('/setting-petugas/');
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
