<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li><router-link :to="{name: 'IndexDashboard'}">Home</router-link></li>
              <li class="active">Kelola Perusahaan</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Kelola Perusahaan</div>

                <div class="panel-body">

                    <br/>
                    <div class="table-responsive">
                    
                    <table class="table table-bordered" >
                    <thead>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody v-if="perusahaans.length">
                      <tr v-for="perusahaan,index in perusahaans">
                        <td>{{ perusahaan.kode}}</td>
                        <td>{{ perusahaan.nama}}</td>
                        <td>{{ perusahaan.alamat}}</td>
                        <td>{{ perusahaan.no_telp}}</td>
                        <td>
                        <router-link 
                          :to="{name:'EditPerusahaan' ,params:{id: perusahaan.id}}" 
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
        perusahaans: [],
        url: window.location.origin + (window.location.pathname).replace("home","perusahaan"),
        pencarian: '',
        loading: true
      }
    },
    mounted()  {
     var app = this;
    app.getResults();
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get(app.url + '/view?page=' + page)
        .then(function(resp){
          app.perusahaans = resp.data.data;
          app.suppliersData = resp.data;
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

