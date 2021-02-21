<template>
    <div>
        <div class="row">
            <router-link to="/store-product" class="btn btn-primary">Add Product</router-link>
        </div>
        <br>
        <input type="text" class="form-control" style="width: 300px" placeholder="Search here" v-model="searchTerm">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Photo</th>
                        <th>Category</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Root</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filterSearch" :key="product.id">
                        <td> {{ product.product_name }}</td>
                        <td> {{ product.code }}</td>
                        <td><img :src="product.image" id="em_photo"></td>
                        <td>{{ product.category_name }}</td>
                        <td>{{ product.buying_price }}</td>
                        <td>{{ product.selling_price }}</td>
                        <td>{{ product.root }}</td>
                        <td>
                            <router-link :to="{name:'edit-product', params:{id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                            <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete </font></a>
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
            products:[],
            searchTerm:''
        }
    },

    computed:{
        filterSearch(){                                                 // to search the exact input
            return this.products.filter(product => {
                return product.product_name.match(this.searchTerm)
            })
        }
    },

    methods:{
        allProduct(){                                                                          // to display all the employees data from db into table
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch()
        },
        deleteProduct(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if(result.value){

                    axios.delete('/api/employee/'+id)                                           // to delete selected employee based on id
                    .then(() => {
                        this.employees = this.employees.filter(employee => {
                            return employee.id != id                                            // ** NOT EQUALLY same with the past id 
                        })
                    })
                    .catch(() => {
                        this.$router.push({name: 'employee'})                                   // return back to employee list table
                    })

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            }) 
        },

    },

    created(){
        this.allProduct();
    },

   

}
  

</script>


<style type="text/css">

#em_photo{
    height: 40px;
    width:40px; 
}
</style>