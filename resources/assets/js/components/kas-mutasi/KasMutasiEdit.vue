,
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexKasMutasi'}">Kelola Kas Mutasi</router-link></li>
              <li class="active">Edit  Kas Mutasi</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Kas Mutasi</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Dari Kas</label>
                        <div class="col-md-4">
                          <vue-selectize class="form-control" required="" v-model="kasMutasi.dari_kas">                          
                            <option value="">Pilih Kas</option>
                            <option v-for="kas in kasKas" :value="kas.id">{{kas.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.dari_kas" class="label label-danger"> {{ errors.dari_kas[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Ke Kas</label>
                        <div class="col-md-4">
                          <vue-selectize class="form-control" required="" v-model="kasMutasi.ke_kas">                          
                            <option value="">Pilih Kas</option>
                            <option v-for="ke_kas in kasKas" :value="ke_kas.id">{{ ke_kas.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.ke_kas" class="label label-danger"> {{ errors.ke_kas[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jumlah</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Jumlah Kas Mutasi" v-model="kasMutasi.jumlah" autofocus=""/>
                        <span v-if="errors.jumlah" class="label label-danger"> {{ errors.jumlah[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Keterangan</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Keterangan Kas Mutasi" v-model="kasMutasi.keterangan" autofocus=""/>
                        <span v-if="errors.keterangan" class="label label-danger"> {{ errors.keterangan[0]}}</span>
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
        kasMutasi: {
          dari_kas: '',
          ke_kas: '',
          jumlah: '',
          keterangan: ''
        },
        kasMutasiId : null,
        kasKas: [],
        url: window.location.origin + (window.location.pathname).replace("home","kas-mutasi"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     app.getEditingData();
     app.getKas();

    },
    methods: {
      getEditingData(){
         var app = this;
         this.kasMutasiId = this.$route.params.id;
         axios.get(app.url+'/'+this.kasMutasiId+ '/edit')
         .then((resp) => {
           this.kasMutasi =  resp.data;
         })
         .catch((resp) => {
            alert("Something Goes Wrong");    
         });
          
      },
      getKas(){
        
     var app = this;
        axios.get(app.url.replace('kas-mutasi','kas')+ '/all')
        .then(function(resp){
          app.kasKas= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Kas Mutasi",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newKasMutasi = this.kasMutasi;
        axios.patch(this.url + '/' + this.kasMutasiId, newKasMutasi)
        .then((resp) => {
          this.alert('Berhasil Mengubah KasMutasi ' + this.kasMutasi.nama );
          this.$router.replace('/kas-mutasi/');
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

