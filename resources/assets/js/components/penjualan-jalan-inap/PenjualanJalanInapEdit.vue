<template>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexPenjualanApotek'}">Kelola Penjualan Apotek</router-link></li>
              <li class="active">Edit  Penjualan Apotek</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Penjualan Apotek</div>

                <div class="panel-body">
                <div class="row">
                  <div  class="col-md-8">
                    <form v-on:submit.prevent="saveFormInputDetailPenjualanApotek()" class="form-inline" >
                      <div class="form-group">
                          <vue-selectize 
                            id="inputProduk"
                            class="form-control" 
                            required="" 
                            v-model="inputPenjualanApotek.produk">                          
                            <option value="">-- Pilih Produk--</option>
                            <option v-for="produk in produks" :value="produk.id">{{ produk.kode}} | {{ produk.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.produk" class="label label-danger"> {{ errors.produk[0]}}</span>
                      </div>
                      <div class="form-group">
                        <input type="number" class="form-control"
                            v-model="inputPenjualanApotek.jumlah"
                            placeholder="Jumlah Jual"
                        />
                        <span v-if="errors.produk" class="label label-danger"> {{ errors.produk[0]}}</span>
                      </div>
                      <div class="form-group">
                          <button class="btn btn-primary" type="submit">Submit</button>
                      </div>
                    </form>
                    <br/>
                    <div>
                    <table class="table table-bordered">
                      <thead>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Jual</th>
                        <th>Potongan</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                      </thead>
                      <tbody v-if="penjualanApotek.detailPenjualanApotek.length">
                          <tr v-for="detail in penjualanApotek.detailPenjualanApotek">
                            <td>{{ detail.nama_produk}}</td>
                            <td><input type="text" v-model="detail.jumlah" 
                                       class="form-control" />
                            </td>
                            <td><input type="text" v-model="detail.harga_jual" 
                                       class="form-control" />
                            </td>
                            <td><input type="text" v-model="detail.potongan" 
                                       class="form-control" />
                            </td>
                            <td>{{ detail.total}}</td>
                            <td>
                              <button 
                                class="btn btn-xs btn-danger" 
                                v-on:click="deleteDetailPenjualanApotek(detail.id)"
                                >
                                Hapus
                              </button>
                            </td>
                          </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td colspan="6"><center>Tidak Ada Data</center></td>
                        </tr>
                      </tbody>
                    </table>
                      <vue-spinner v-if="loading"></vue-spinner>
                    </div>
                    <!-- end div table -->

                  </div>
                  <!-- end col md 8 -->
                  <div class="col-md-4">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Total PenjualanApotek</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" placeholder="Total PenjualanApotek" v-model="penjualanApotek.total_nilai" readonly=""/>
                        <span v-if="errors.total_nilai" class="label label-danger"> {{ errors.total_nilai[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Potongan</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" placeholder="Potongan" v-model="penjualanApotek.potongan" />
                        <span v-if="errors.potongan" class="label label-danger"> {{ errors.potongan[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Penjamin</label>
                        <div class="col-md-8">
                          <vue-selectize 
                              class="form-control" 
                              required="" 
                              v-model="penjualanApotek.penjamin">                          
                            <option value="">Pilih Penjamin</option>
                            <option 
                              v-for="penjamin in penjamins" 
                              :value="penjamin.id">
                                {{ penjamin.nama}}
                            </option>
                          </vue-selectize>
                        <span v-if="errors.penjamin" class="label label-danger"> {{ errors.penjamin[0]}}</span>
                        </div>
                      </div>
                       
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Cara Bayar</label>
                        <div class="col-md-8">
                          <vue-selectize class="form-control"  v-model="penjualanApotek.kas">                          
                            <option value="">Pilih Kas</option>
                            <option v-for="kas in kasKas" :value="kas.id">{{ kas.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.kas" class="label label-danger"> {{ errors.kas[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Dibayar / Uang Muka</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" 
                              placeholder="Dibayar" 
                              v-model="penjualanApotek.jumlah_bayar" />
                        <span v-if="errors.jumlah_bayar" class="label label-danger"> {{ errors.jumlah_bayar[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Piutang</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control"  
                                 placeholder="Piutang"
                                 v-model="penjualanApotek.piutang_awal" readonly=""/>
                        <span v-if="errors.piutang_awal" class="label label-danger"> {{ errors.piutang_awal[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-md-offset-2">
                          <button 
                            class="btn btn-primary" 
                            type="submit"
                            >
                            Submit
                          </button>
                        </div>
                      </div>
                    </form>
                    
                  </div>
                  <!-- end col md 4 -->
                </div>
                <!-- end div row -->
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
        penjualanApotek: {
          total_nilai: 0,
          kas: 1,
          penjamin: 1,
          potongan: 0,
          jumlah_bayar: '',
          piutang_awal: 0,
          detailPenjualanApotek: []
        },
        inputPenjualanApotek: {
          produk: '',
          jumlah: '',
          penjamin: 1
        },
        produks: [],
        penjamins: [],
        kasKas: [],
        penjualanId: null,
        url: window.location.origin + (window.location.pathname).replace("home","penjualan-apotek"),
        errors: [],
        loading: false,
        message: ''
      }
    },
    watch: {
      'penjualanApotek.detailPenjualanApotek':{
          handler(val){
              this.getTotalPenjualanApotek();
          },
          deep: true
      },
     'penjualanApotek.jumlah_bayar': {
         handler(val){
             this.getTotalPenjualanApotek();
         }
      }
    },
    mounted()  {
     var app = this;
     app.getEditingData();
     app.getProduk();
     app.getKas();
     app.getPenjamin();

    },
    methods: {
      deleteDetailPenjualanApotek(id){
          axios.delete(this.url + '/' + id + '/delete-tbs-edit-penjualan-apotek')
          .then((resp) => {
            this.getDetailPenjualanApotek();
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      
      },
      getEditingData(){
         var app = this;
         this.penjualanId = this.$route.params.id;
         axios.get(app.url+'/'+this.penjualanId+ '/edit')
         .then((resp) => {
           this.penjualanApotek.jumlah_bayar =  resp.data.jumlah_bayar;
           this.penjualanApotek.penjamin =  resp.data.penjamin;
           this.penjualanApotek.kas =  resp.data.kas;
           this.penjualanApotek.no_faktur_penjamin =  resp.data.no_faktur_penjamin;
           this.penjualanApotek.no_trans = resp.data.no_trans;

         })
         .catch((resp) => {
            alert("Something Goes Wrong");    
         });
         axios.get(app.url+'/'+this.penjualanId+ '/edit-detail-penjualan-apotek')
         .then((resp) => {
           this.penjualanApotek.detailPenjualanApotek=  resp.data;
           this.getTotalPenjualanApotek();
         })
         .catch((resp) => {
            alert("Something Goes Wrong");    
         });
          
      },
      getDetailPenjualanApotek(){
        
     var app = this;
     this.penjualanId = this.$route.params.id;
     app.loading = true;
        axios.get(app.url + '/' + this.penjualanId + '/edit-tbs-penjualan-apotek')
        .then(function(resp){
          app.penjualanApotek.detailPenjualanApotek = resp.data;
          app.loading = false;
          app.getTotalPenjualanApotek();
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        });
        
      },
      getTotalPenjualanApotek(){
        var app = this;
        var detailPenjualanApotek = app.penjualanApotek.detailPenjualanApotek;
        var totalPenjualanApotek = 0;
        for(var i = 0; i < detailPenjualanApotek.length; i++){
           var hargaJual = detailPenjualanApotek[i].harga_jual;
           var jumlah = detailPenjualanApotek[i].jumlah;
           var potongan = detailPenjualanApotek[i].potongan;
           totalPenjualanApotek += (hargaJual * jumlah) - potongan; 
        }
        totalPenjualanApotek  = totalPenjualanApotek - app.penjualanApotek.potongan;
        app.penjualanApotek.total_nilai = totalPenjualanApotek;
        app.penjualanApotek.piutang_awal = totalPenjualanApotek  - app.penjualanApotek.jumlah_bayar;
      },
      getProduk(){
        
     var app = this;
        axios.get(app.url.replace('penjualan-apotek','produk')+ '/all')
        .then(function(resp){
          app.produks= resp.data;
         document.getElementById("inputProduk-selectized").focus();
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        ;
      },
      getKas(){
        
     var app = this;
        axios.get(app.url.replace('penjualan-apotek','kas')+ '/all')
        .then(function(resp){
          app.kasKas= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      getPenjamin(){
        
     var app = this;
        axios.get(app.url.replace('penjualan-apotek','penjamin')+ '/all')
        .then(function(resp){
          app.penjamins = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah PenjualanApotek",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newPenjualanApotek = this.penjualanApotek;
        axios.patch(this.url + '/' + this.penjualanId, newPenjualanApotek)
        .then((resp) => {
          this.alert('Berhasil Mengubah PenjualanApotek ' + this.penjualanApotek.no_trans);
          this.$router.replace('/penjualan-apotek/');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Something Goes Wrong');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
     saveFormInputDetailPenjualanApotek(){
        var newDetailPenjualanApotek = this.inputPenjualanApotek;
         this.penjualanId = this.$route.params.id;
        axios.post(this.url + '/'+ this.penjualanId + '/store-tbs-edit-penjualan-apotek',newDetailPenjualanApotek)
        .then((resp) => {
          this.inputPenjualanApotek.produk = '';
          this.inputPenjualanApotek.jumlah = '';
          this.getDetailPenjualanApotek();
         document.getElementById("inputProduk-selectized").focus();
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

