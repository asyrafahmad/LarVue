<template>
    <div>
        <div class="row">
            <rotuer-link to="" class="btn btn-primary">All Employee</rotuer-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add Employee</h1>
                        </div>
                        <form class="user" @submit.prevent="signup">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Full Name" v-model="form.name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Email" v-model="form.email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Address" v-model="form.address">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Salary" v-model="form.salary">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="exampleInputFirstName" placeholder="Enter Joining Date" v-model="form.joining_Date">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Nid" v-model="form.nid">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Phone Number" v-model="form.phone">
                                    </div>
                                    <div class="col-md-6">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose File</label>
                                    </div>
                                    <div class="col-md-6">
                                        <img srv="form.photo" style="height: 40px; width: 40px;">
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
                name: null,
                email: null,
                password: null,
                confirm_password: null
            },
            errors:{}
        }
    },

}
  

</script>


<style>

</style>