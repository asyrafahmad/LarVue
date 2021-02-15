<template>
    <div>
        <div class="row">
            <router-link to="/employee" class="btn btn-primary">All Supplier</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Supplier Update</h1>
                        </div>
                        <form class="user" @submit.prevent="supplierUpdate" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Full Name" v-model="form.name">
                                        <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Email" v-model="form.email">
                                        <small class="text-danger" v-if="errors.email">{{ errors.email[0]}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Address" v-model="form.address">
                                        <small class="text-danger" v-if="errors.address">{{ errors.address[0]}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Shop Name" v-model="form.shopname">
                                        <small class="text-danger" v-if="errors.shopname">{{ errors.salary[0]}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Phone Number" v-model="form.phone">
                                        <small class="text-danger" v-if="errors.phone">{{ errors.phone[0]}}</small>
                                    </div>
                                    <div class="col-md-6">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                                        <small class="text-danger" v-if="errors.photo">{{ errors.photo[0]}}</small>
                                        <label class="custom-file-label" for="customFile">Choose File</label>
                                    </div>
                                    <div class="col-md-6">
                                        <img :src="form.photo" style="height: 40px; width: 40px;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                            <hr>
                           
                        </form>
                        <hr>
                        <div class="text-center">
                        
                        </div>
                        <div class="text-center">
                        
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script type="text/javascript">

export default {

    created(){
        if(!User.loggedIn()){                        // stay at home page if user login token is still save after logged in
            this.$router.push({ name: '/'})
        }
    },
    data(){
        return {
            form:{
                name: '',
                email: '',
                phone: '',
                shopname: '',
                address: '',
                photo: '',
                newphoto: '',
            },
            errors:{}
        }
    },
    created(){
        let id = this.$route.params.id                                      // get the selected id from URL param

        axios.get('/api/supplier/'+id)                                      // to display selected employee based on id
        .then(({data}) => (this.form = data))
        .catch(console.log('error'))
    },

    methods:{

        supplierUpdate(){
            let id = this.$route.params.id
            axios.patch('/api/supplier/'+id,this.form)
            .then(() => {
                this.$router.push({ name: 'supplier'})                      // direct to all employee page
                Notification.success()                                      // notify success
            })
            .catch(error => this.errors = error.response.data.errors)
        },

        onFileSelected(event){
            let file = event.target.files[0];                               // file details location in console event
            if(file.size > 1048770){                                        // upload image must be less than 1MB
                Notification.image_validation()  
            }else{
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.newphoto = event.target.result
                };
                reader.readAsDataURL(file)
            }
        }

    }

}
  

</script>


<style>

</style>