
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexKas'}">Kelola Kas</router-link></li>
              <li class="active">Edit  Kas</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Kas</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Kode</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Kode Kas" v-model="kas.kode" autofocus=""/>
                        <span v-if="errors.kode" class="label label-danger"> {{ errors.kode[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Nama Kas" v-model="kas.nama" autofocus=""/>
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
        kas: {
          nama: '',
          kode: ''
        },
        kasId : null,
        url: window.location.origin + (window.location.pathname).replace("home","kas"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     this.kasId = this.$route.params.id;
     axios.get(app.url+'/'+this.kasId+ '/edit')
     .then((resp) => {
       this.kas =  resp.data;
     })
     .catch((resp) => {
        alert("Something Goes Wrong");    
     });

    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Kas",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newKas = this.kas;
        axios.patch(this.url + '/' + this.kasId, newKas)
        .then((resp) => {
          this.alert('Berhasil Mengubah Kas ' + this.kas.nama );
          this.$router.replace('/kas/');
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

