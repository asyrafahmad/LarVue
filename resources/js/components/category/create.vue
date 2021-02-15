<template>
    <div>
        <div class="row">
            <router-link to="/supplier" class="btn btn-primary">All Category</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add Category</h1>
                        </div>
                        <form class="user" @submit.prevent="categoryInsert" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Category name" v-model="form.category_name">
                                        <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
                category_name: null,
            },
            errors:{}
        }
    },

    methods:{

        categoryInsert(){
            axios.post('/api/category',this.form)
            .then(() => {
                this.$router.push({ name: 'category'})                      // direct to all employee page
                Notification.success()                                      // notify success
            })
            .catch(error => this.errors = error.response.data.errors)
        },

        // get selected image
        onFileSelected(event){
            console.log(event);                                             // view upload image event
            let file = event.target.files[0];                               // file details location in console event
            if(file.size > 1048770){                                        // upload image must be less than 1MB
                Notification.image_validation() 
                
            }else{
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.photo = event.target.result
                    console.log(event.target.result)
                };
                reader.readAsDataURL(file)
            }

        }

    }

}
  

</script>


<style>

</style>