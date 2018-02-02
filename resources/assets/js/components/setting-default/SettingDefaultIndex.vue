<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Setting Default</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Setting Default</div>

                <div class="panel-body">

                    <br/>
                    <div class="table-responsive">
                    
                    <table class="table table-bordered" >
                    <thead>
                        <th>Text</th>
                        <th>Value</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody v-if="settingDefaults.length">
                      <tr v-for="settingDefault,index in settingDefaults">
                        <td>{{ settingDefault.text}}</td>
                        <td>{{ settingDefault.value}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditSettingDefault' ,params:{id: settingDefault.id}}" 
                          class="btn btn-xs btn-default"
                       >
                          Edit
                       </router-link>
                        </td>
                      </tr>
                    </tbody>
                    </table>
                   </div>
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
        settingDefaults: [],
        kasData: {},
        url: window.location.origin + (window.location.pathname).replace("home","setting-default"),
        pencarian: '',
        loading: true
      }
    },
    mounted()  {
     var app = this;
    app.getResults();
    },
    watch: {
       pencarian: function(newSearch){
         this.getHasilPencarian();
       }  
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get(app.url + '/view?page=' + page)
        .then(function(resp){
          app.settingDefaults = resp.data.data;
          app.kasData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      getHasilPencarian(page){
          
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get(app.url + '/search?q='+app.pencarian+'&page=' + page)
        .then(function(resp){
          app.settingDefaults = resp.data.data;
          app.kasData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      alert(title,pesan){
        this.$swal({
          title: title,
          text: pesan,
          icon: "success"
        });
      }
    }
  }

</script>

