<template>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexPembelian'}">Kelola Pembelian</router-link></li>
              <li class="active">Edit  Pembelian</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Pembelian</div>

                <div class="panel-body">
                <div class="row">
                  <div  class="col-md-8">
                    <form v-on:submit.prevent="saveFormInputDetailPembelian()" class="form-inline" >
                      <div class="form-group">
                          <vue-selectize 
                            id="inputProduk"
                            class="form-control" 
                            required="" 
                            v-model="inputPembelian.produk">                          
                            <option value="">-- Pilih Produk--</option>
                            <option v-for="produk in produks" :value="produk.id">{{ produk.kode}} | {{ produk.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.produk" class="label label-danger"> {{ errors.produk[0]}}</span>
                      </div>
                      <div class="form-group">
                        <input type="number" class="form-control"
                            v-model="inputPembelian.jumlah"
                            placeholder="Jumlah Beli"
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
                        <th>Harga Beli</th>
                        <th>Potongan</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                      </thead>
                      <tbody v-if="pembelian.detailPembelian.length">
                          <tr v-for="detail in pembelian.detailPembelian">
                            <td>{{ detail.nama_produk}}</td>
                            <td><input type="text" v-model="detail.jumlah" 
                                       class="form-control" />
                            </td>
                            <td><input type="text" v-model="detail.harga_beli" 
                                       class="form-control" />
                            </td>
                            <td><input type="text" v-model="detail.potongan" 
                                       class="form-control" />
                            </td>
                            <td>{{ detail.total}}</td>
                            <td>
                              <button 
                                class="btn btn-xs btn-danger" 
                                v-on:click="deleteDetailPembelian(detail.id)"
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
                        <label for="name" class="col-md-4 control-label" >Total Pembelian</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" placeholder="Total Pembelian" v-model="pembelian.total_nilai" readonly=""/>
                        <span v-if="errors.total_nilai" class="label label-danger"> {{ errors.total_nilai[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >No Faktur Supplier</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" placeholder="No Faktu Supplier" v-model="pembelian.no_faktur_supplier" />
                        <span v-if="errors.no_faktur_supplier" class="label label-danger"> {{ errors.no_faktur_supplier[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Supplier</label>
                        <div class="col-md-8">
                          <vue-selectize 
                              class="form-control" 
                              required="" 
                              v-model="pembelian.supplier">                          
                            <option value="">Pilih Supplier</option>
                            <option 
                              v-for="supplier in suppliers" 
                              :value="supplier.id">
                                {{ supplier.nama}}
                            </option>
                          </vue-selectize>
                        <span v-if="errors.supplier" class="label label-danger"> {{ errors.supplier[0]}}</span>
                        </div>
                      </div>
                       
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Cara Bayar</label>
                        <div class="col-md-8">
                          <vue-selectize class="form-control"  v-model="pembelian.kas">                          
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
                              v-model="pembelian.jumlah_bayar" />
                        <span v-if="errors.jumlah_bayar" class="label label-danger"> {{ errors.jumlah_bayar[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Saldo Terhutang</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control"  
                                 placeholder="Saldo Terhutang"
                                 v-model="pembelian.hutang_awal" readonly=""/>
                        <span v-if="errors.hutang_awal" class="label label-danger"> {{ errors.hutang_awal[0]}}</span>
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
        pembelian: {
          total_nilai: 0,
          kas: '',
          supplier: '',
          no_faktur_supplier: '',
          jumlah_bayar: '',
          hutang_awal: 0,
          no_trans: 0,
          detailPembelian: []
        },
        inputPembelian: {
          produk: '',
          jumlah: ''
        },
        produks: [],
        suppliers: [],
        kasKas: [],
        pembelianId: null,
        url: window.location.origin + (window.location.pathname).replace("home","pembelian"),
        errors: [],
        loading: false,
        message: ''
      }
    },
    watch: {
      'pembelian.detailPembelian':{
          handler(val){
              this.getTotalPembelian();
          },
          deep: true
      },
     'pembelian.jumlah_bayar': {
         handler(val){
             this.getTotalPembelian();
         }
      }
    },
    mounted()  {
     var app = this;
     app.getEditingData();
     app.getProduk();
     app.getKas();
     app.getSupplier();

    },
    methods: {
      deleteDetailPembelian(id){
          axios.delete(this.url + '/' + id + '/delete-tbs-edit-pembelian')
          .then((resp) => {
            this.getDetailPembelian();
          })
          .catch((resp) =>{
            alert("Something Goes Wrong")
            console.log(resp);
          })
      
      },
      getEditingData(){
         var app = this;
         this.pembelianId = this.$route.params.id;
         axios.get(app.url+'/'+this.pembelianId+ '/edit')
         .then((resp) => {
           this.pembelian.jumlah_bayar =  resp.data.jumlah_bayar;
           this.pembelian.supplier =  resp.data.supplier;
           this.pembelian.kas =  resp.data.kas;
           this.pembelian.no_faktur_supplier =  resp.data.no_faktur_supplier;
           this.pembelian.no_trans = resp.data.no_trans;

         })
         .catch((resp) => {
            alert("Something Goes Wrong");    
         });
         axios.get(app.url+'/'+this.pembelianId+ '/edit-detail-pembelian')
         .then((resp) => {
           this.pembelian.detailPembelian=  resp.data;
           this.getTotalPembelian();
         })
         .catch((resp) => {
            alert("Something Goes Wrong");    
         });
          
      },
      getDetailPembelian(){
        
     var app = this;
     this.pembelianId = this.$route.params.id;
     app.loading = true;
        axios.get(app.url + '/' + this.pembelianId + '/edit-tbs-pembelian')
        .then(function(resp){
          app.pembelian.detailPembelian = resp.data;
          app.loading = false;
          app.getTotalPembelian();
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        });
        
      },
      getTotalPembelian(){
        var app = this;
        var detailPembelian = app.pembelian.detailPembelian;
        var totalPembelian = 0;
        for(var i = 0; i < detailPembelian.length; i++){
           var hargaBeli = detailPembelian[i].harga_beli;
           var jumlah = detailPembelian[i].jumlah;
           var potongan = detailPembelian[i].potongan;
           totalPembelian += (hargaBeli * jumlah) - potongan; 
        }
        app.pembelian.total_nilai = totalPembelian;
        app.pembelian.hutang_awal = totalPembelian - app.pembelian.jumlah_bayar;
      },
      getProduk(){
        
     var app = this;
        axios.get(app.url.replace('pembelian','produk')+ '/all')
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
        axios.get(app.url.replace('pembelian','kas')+ '/all')
        .then(function(resp){
          app.kasKas= resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      getSupplier(){
        
     var app = this;
        axios.get(app.url.replace('pembelian','supplier')+ '/all')
        .then(function(resp){
          app.suppliers = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
         
        });
        
      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Pembelian",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newPembelian = this.pembelian;
        axios.patch(this.url + '/' + this.pembelianId, newPembelian)
        .then((resp) => {
          this.alert('Berhasil Mengubah Pembelian ' + this.pembelian.no_trans);
          this.$router.replace('/pembelian/');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Something Goes Wrong');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
     saveFormInputDetailPembelian(){
        var newDetailPembelian = this.inputPembelian;
         this.pembelianId = this.$route.params.id;
        axios.post(this.url + '/'+ this.pembelianId + '/store-tbs-edit-pembelian',newDetailPembelian)
        .then((resp) => {
          this.inputPembelian.produk = '';
          this.inputPembelian.jumlah = '';
          this.getDetailPembelian();
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

