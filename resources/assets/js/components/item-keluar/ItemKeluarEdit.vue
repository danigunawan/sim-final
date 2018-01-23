<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexItemKeluar'}">Kelola Item Keluar</router-link></li>
              <li class="active">Edit  Item Keluar</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Item Keluar</div>

                <div class="panel-body">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Item</label>
                        <div class="col-md-4">
                          <vue-selectize class="form-control" required="" v-model="itemKeluar.produk">                          
                            <option value="">Pilih Item</option>
                            <option v-for="produk in items" :value="produk.id">{{ produk.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.produk" class="label label-danger"> {{ errors.produk[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jumlah</label>
                        <div class="col-md-4">
                          <input type="text" class="form-control" required="" placeholder="Jumlah Item Keluar" v-model="itemKeluar.jumlah" autofocus=""/>
                        <span v-if="errors.jumlah" class="label label-danger"> {{ errors.jumlah[0]}}</span>
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
        itemKeluar: {
          produk: '',
          jumlah: '',
          harga_pokok: ''
        },
        itemKeluarId : null,
        items: [],
        kategoriTransaksis: [],
        url: window.location.origin + (window.location.pathname).replace("home","item-keluar"),
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     app.getEditingData();
     app.getItem();
     app.getKategoriTransaksi();

    },
    methods: {
      getEditingData(){
         var app = this;
         this.itemKeluarId = this.$route.params.id;
         axios.get(app.url+'/'+this.itemKeluarId+ '/edit')
         .then((resp) => {
           this.itemKeluar =  resp.data;
         })
         .catch((resp) => {
            alert("Something Goes Wrong");    
         });
          
      },
      getItem(){
        
     var app = this;
        axios.get(app.url.replace('item-keluar','produk')+ '/all')
        .then(function(resp){
          app.items= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Item Keluar",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newItemKeluar = this.itemKeluar;
        axios.patch(this.url + '/' + this.itemKeluarId, newItemKeluar)
        .then((resp) => {
          this.alert('Berhasil Mengubah ItemKeluar ' + this.itemKeluar.nama );
          this.$router.replace('/item-keluar/');
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

