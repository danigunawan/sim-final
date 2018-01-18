
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexPoli'}">Kelola Poli</router-link></li>
              <li class="active">Edit  Poli</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Poli</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Nama Poli" v-model="poli.nama" autofocus=""/>
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
        poli: {
          nama: ''
        },
        poliId : null,
        url: window.location.origin + (window.location.pathname).replace("home","poli"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     this.poliId = this.$route.params.id;
     axios.get(app.url+'/'+this.poliId+ '/edit')
     .then((resp) => {
       this.poli =  resp.data;
     })
     .catch((resp) => {
        alert("Something Goes Wrong");    
     });

    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Poli",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newPoli = this.poli;
        axios.patch(this.url + '/' + this.poliId, newPoli)
        .then((resp) => {
          this.alert('Berhasil Mengubah Poli ' + this.poli.nama );
          this.$router.replace('/poli/');
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

