<template>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <ul class="breadcrumb">
              <li>Home</li>
              <li><router-link :to="{name: 'IndexPenjualanJalanInap'}">Kelola Penjualan JalanInap</router-link></li>
              <li class="active">Edit  Penjualan JalanInap</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit  Penjualan JalanInap</div>

                <div class="panel-body">
                <div class="row">
                   <div class="col-md-3">
                          <input
                            id="inputRegistrasi"
                            class="form-control"
                            required=""
                            readonly=""
                            v-model="inputPenjualanJalanInap.no_reg">
                   </div>
                   <div class="col-md-2">
                          <vue-selectize
                            class="form-control"
                            v-model="inputPenjualanJalanInap.dokter">
                            <option value="">-- Pilih Dokter--</option>
                            <option v-for="dokter in dokters" :value="dokter.id">{{ dokter.name}} </option>
                          </vue-selectize>
                   </div>
                   <div class="col-md-2">
                          <vue-selectize
                            class="form-control"
                            v-model="inputPenjualanJalanInap.paramedik">
                            <option value="">-- Pilih Paramedik--</option>
                            <option v-for="paramedik in paramediks" :value="paramedik.id">{{ paramedik.name}} </option>
                          </vue-selectize>
                   </div>
                   <div class="col-md-2">
                          <vue-selectize
                            class="form-control"
                            v-model="inputPenjualanJalanInap.farmasi">
                            <option value="">-- Pilih Farmasi--</option>
                            <option v-for="farmasi in farmasis" :value="farmasi.id">{{ farmasi.name}} </option>
                          </vue-selectize>
                   </div>
                </div>
                <hr/>
                <!-- end class row -->
                <div class="row">
                  <div  class="col-md-8">
                    <form v-on:submit.prevent="saveFormInputDetailPenjualanJalanInap()" class="form-inline" >
                      <div class="form-group">
                          <vue-selectize
                            id="inputProduk"
                            class="form-control"
                            required=""
                            v-model="inputPenjualanJalanInap.produk">
                            <option value="">-- Pilih Produk--</option>
                            <option v-for="produk in produks" :value="produk.id">{{ produk.kode}} | {{ produk.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.produk" class="label label-danger"> {{ errors.produk[0]}}</span>
                      </div>
                      <div class="form-group">
                        <input type="number" class="form-control"
                            v-model="inputPenjualanJalanInap.jumlah"
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
                      <tbody v-if="penjualanJalanInap.detailPenjualanJalanInap.length">
                          <tr v-for="detail in penjualanJalanInap.detailPenjualanJalanInap">
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
                                v-on:click="deleteDetailPenjualanJalanInap(detail.id)"
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
                        <label for="name" class="col-md-4 control-label" >Total </label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" placeholder="Total PenjualanJalanInap" v-model="penjualanJalanInap.total_nilai" readonly=""/>
                        <span v-if="errors.total_nilai" class="label label-danger"> {{ errors.total_nilai[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Potongan</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" placeholder="Potongan" v-model="penjualanJalanInap.potongan" />
                        <span v-if="errors.potongan" class="label label-danger"> {{ errors.potongan[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Penjamin</label>
                        <div class="col-md-8">
                          <vue-selectize
                              class="form-control"
                              required=""
                              v-model="penjualanJalanInap.penjamin">
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
                          <vue-selectize class="form-control"  v-model="penjualanJalanInap.kas">
                            <option value="">Pilih Kas</option>
                            <option v-for="kas in kasKas" :value="kas.id">{{ kas.nama}}</option>
                          </vue-selectize>
                        <span v-if="errors.kas" class="label label-danger"> {{ errors.kas[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Dibayar </label>
                        <div class="col-md-8">
                          <input type="text" class="form-control"
                              placeholder="Dibayar"
                              v-model="penjualanJalanInap.jumlah_bayar" />
                        <span v-if="errors.jumlah_bayar" class="label label-danger"> {{ errors.jumlah_bayar[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label" >Piutang</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control"
                                 placeholder="Piutang"
                                 v-model="penjualanJalanInap.piutang_awal" readonly=""/>
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
        penjualanJalanInap: {
          total_nilai: 0,
          kas: 1,
          penjamin: 1,
          potongan: 0,
          jumlah_bayar: '',
          piutang_awal: 0,
          detailPenjualanJalanInap: []
        },
        inputPenjualanJalanInap: {
          produk: '',
          jumlah: '',
          penjamin: 1
        },
        produks: [],
        penjamins: [],
        kasKas: [],
        dokters: [],
        paramediks: [],
        farmasis: [],
        penjualanId: null,
        settingPetugas: null,
        url: window.location.origin + (window.location.pathname).replace("home","penjualan-jalan-inap"),
        errors: [],
        loading: false,
        message: ''
      }
    },
    watch: {
      'penjualanJalanInap.detailPenjualanJalanInap':{
          handler(val){
              this.getTotalPenjualanJalanInap();
          },
          deep: true
      },
     'penjualanJalanInap.jumlah_bayar': {
         handler(val){
             this.getTotalPenjualanJalanInap();
         }
      }
    },
    mounted()  {
     var app = this;
     app.getEditingData();
     app.getProduk();
     app.getKas();
     app.getPenjamin();
     app.getPetugas();
     app.getSetttingPetugas();

    },
    methods: {
      getSetttingPetugas(){

        var app = this;
        axios.get(app.url.replace('penjualan-jalan-inap','setting-petugas')+ '/all')
        .then(function(resp){

          app.settingPetugas = resp.data[0];
          app.inputPenjualanJalanInap.dokter = app.settingPetugas.dokter;
          app.inputPenjualanJalanInap.paramedik = app.settingPetugas.perawat;
          app.inputPenjualanJalanInap.farmasi = app.settingPetugas.farmasi;
          console.log(app.settingPetugas);
        })
        .catch(function(resp){
          console.log(resp);

        });

      },
      getPetugas(){
        var app = this;
        axios.get(app.url.replace('penjualan-jalan-inap','user')+ '/all')
        .then(function(resp){
          for(var i = 0; i < resp.data.length; i++){
            if(resp.data[i].jabatan == 'dokter'){
              app.dokters.push(resp.data[i]);
            } else if(resp.data[i].jabatan == 'perawat'){
            app.paramediks.push(resp.data[i])
            } else if(resp.data[i].jabatan == 'farmasi'){
              app.farmasis.push(resp.data[i]);
            }
          }
        })
        .catch(function(resp){
          console.log(resp);

        });
      },
      deleteDetailPenjualanJalanInap(id){
          axios.delete(this.url + '/' + id + '/delete-tbs-edit-penjualan-jalan-inap')
          .then((resp) => {
            this.getDetailPenjualanJalanInap();
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
           this.penjualanJalanInap.jumlah_bayar =  resp.data.jumlah_bayar;
           this.penjualanJalanInap.penjamin =  resp.data.penjamin;
           this.penjualanJalanInap.kas =  resp.data.kas;
           this.penjualanJalanInap.no_faktur_penjamin =  resp.data.no_faktur_penjamin;
           this.penjualanJalanInap.no_trans = resp.data.no_trans;

         })
         .catch((resp) => {
            alert("Something Goes Wrong");
         });
         axios.get(app.url+'/'+this.penjualanId+ '/edit-detail-penjualan-jalan-inap')
         .then((resp) => {
           this.penjualanJalanInap.detailPenjualanJalanInap=  resp.data;
           this.getTotalPenjualanJalanInap();
         })
         .catch((resp) => {
            alert("Something Goes Wrong");
         });

      },
      getDetailPenjualanJalanInap(){

     var app = this;
     this.penjualanId = this.$route.params.id;
     app.loading = true;
        axios.get(app.url + '/' + this.penjualanId + '/edit-tbs-penjualan-jalan-inap')
        .then(function(resp){
          app.penjualanJalanInap.detailPenjualanJalanInap = resp.data;
          app.loading = false;
          app.getTotalPenjualanJalanInap();
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;

        });

      },
      getTotalPenjualanJalanInap(){
        var app = this;
        var detailPenjualanJalanInap = app.penjualanJalanInap.detailPenjualanJalanInap;
        var totalPenjualanJalanInap = 0;
        for(var i = 0; i < detailPenjualanJalanInap.length; i++){
           var hargaJual = detailPenjualanJalanInap[i].harga_jual;
           var jumlah = detailPenjualanJalanInap[i].jumlah;
           var potongan = detailPenjualanJalanInap[i].potongan;
           totalPenjualanJalanInap += (hargaJual * jumlah) - potongan;
        }
        totalPenjualanJalanInap  = totalPenjualanJalanInap - app.penjualanJalanInap.potongan;
        app.penjualanJalanInap.total_nilai = totalPenjualanJalanInap;
        app.penjualanJalanInap.piutang_awal = totalPenjualanJalanInap  - app.penjualanJalanInap.jumlah_bayar;
      },
      getProduk(){

     var app = this;
        axios.get(app.url.replace('penjualan-jalan-inap','produk')+ '/all')
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
        axios.get(app.url.replace('penjualan-jalan-inap','kas')+ '/all')
        .then(function(resp){
          app.kasKas= resp.data;
        })
        .catch(function(resp){
          console.log(resp);

        });

      },
      getPenjamin(){

     var app = this;
        axios.get(app.url.replace('penjualan-jalan-inap','penjamin')+ '/all')
        .then(function(resp){
          app.penjamins = resp.data;
        })
        .catch(function(resp){
          console.log(resp);

        });

      },
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah PenjualanJalanInap",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newPenjualanJalanInap = this.penjualanJalanInap;
        axios.patch(this.url + '/' + this.penjualanId, newPenjualanJalanInap)
        .then((resp) => {
          this.alert('Berhasil Mengubah PenjualanJalanInap ' + this.penjualanJalanInap.no_trans);
          this.$router.replace('/penjualan-jalan-inap/');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Something Goes Wrong');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
     saveFormInputDetailPenjualanJalanInap(){
        var newDetailPenjualanJalanInap = this.inputPenjualanJalanInap;
         this.penjualanId = this.$route.params.id;
        axios.post(this.url + '/'+ this.penjualanId + '/store-tbs-edit-penjualan-jalan-inap',newDetailPenjualanJalanInap)
        .then((resp) => {
          this.inputPenjualanJalanInap.produk = '';
          this.inputPenjualanJalanInap.jumlah = '';
          this.getDetailPenjualanJalanInap();
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
