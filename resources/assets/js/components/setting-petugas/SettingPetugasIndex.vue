<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Setting Petugas</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Setting Petugas</div>

                <div class="panel-body">

                    <br/>
                    <div class="table-responsive">

                    <table class="table table-bordered" >
                    <thead>
                        <th>Dokter</th>
                        <th>Perawat</th>
                        <th>Farmasi</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody >
                      <tr >
                        <td>{{ settingPetugas.nama_dokter}}</td>
                        <td>{{ settingPetugas.nama_perawat}}</td>
                        <td>{{ settingPetugas.nama_farmasi}}</td>
                        <td>
                        <router-link
                          :to="{name:'EditSettingPetugas' ,params:{id: settingPetugas.id}}"
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
        settingPetugas: [],
        url: window.location.origin + (window.location.pathname).replace("home","setting-petugas"),
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
          app.settingPetugas = resp.data;
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
          app.settingPetugas = resp.data;
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
