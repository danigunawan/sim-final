
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexSettingDefault'}">Kelola Setting Default</router-link></li>
              <li class="active">Edit  Setting Default</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Setting Default</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Text </label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" readonly="" placeholder="Text  SettingDefault" v-model="settingDefault.text" autofocus=""/>
                        <span v-if="errors.text" class="label label-danger"> {{ errors.text[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Value</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Value SettingDefault" v-model="settingDefault.value" autofocus=""/>
                        <span v-if="errors.value" class="label label-danger"> {{ errors.value[0]}}</span>
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
        settingDefault: {
          text: '',
          value: ''
        },
        kasId : null,
        url: window.location.origin + (window.location.pathname).replace("home","settingDefault"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     this.kasId = this.$route.params.id;
     axios.get(app.url+'/'+this.kasId+ '/edit')
     .then((resp) => {
       this.settingDefault =  resp.data;
     })
     .catch((resp) => {
        alert("Something Goes Wrong");    
     });

    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah SettingDefault",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newSettingDefault = this.settingDefault;
        axios.patch(this.url + '/' + this.kasId, newSettingDefault)
        .then((resp) => {
          this.alert('Berhasil Mengubah SettingDefault ' + this.settingDefault.nama );
          this.$router.replace('/settingDefault/');
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

