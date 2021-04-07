<template>
    <div>
        <div class="row">
            <router-link to="/store-customer" class="btn btn-primary">Add Customer</router-link>
        </div>
        <br>
        <input type="text" class="form-control" style="width: 300px" placeholder="Search here" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Customer Name</th>
                        <th>Customer Photo</th>
                        <th>Customer Phone No</th>
                        <th>Customer Email</th>
                        <th>Customer Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in filterSearch" :key="customer.id">
                        <td> {{ customer.name }}</td>
                        <td><img :src="customer.photo" id="em_photo"></td>
                        <td>{{ customer.phone }}</td>
                        <td>{{ customer.email }}</td>
                        <td>{{ customer.address }}</td>
                        <td>
                            <router-link :to="{name:'edit-customer', params:{id:customer.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                            <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete </font></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
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
        return{
            customers:[],
            searchTerm:''
        }
    },

    computed:{
        filterSearch(){                                                 // to search the exact input
            return this.customers.filter(customer => {
                return customer.name.match(this.searchTerm)
            })
        }
    },

    methods:{
        allCustomer(){                                                                          // to display all the employees data from db into table
            axios.get('/api/customer/')
            .then(({data}) => (this.customers = data))
            .catch()
        },
        deleteCustomer(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You wan't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if(result.value){

                    axios.delete('/api/customer/'+id)                                           // to delete selected employee based on id
                    .then(() => {
                        this.customers = this.customers.filter(customer => {
                            return customer.id != id                                            // ** NOT EQUALLY same with the past id 
                        })
                    })
                    .catch(() => {
                        this.$router.push({name: 'customer'})                                   // return back to employee list table
                    })

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
            
        }
    },

    created(){
        this.allCustomer();
    }

}
  

</script>


<style type="text/css">

#em_photo{
    height: 40px;
    width:40px; 
}
</style>