<template>
    
</template>


<script type="text/javascript">

export default {
    created(){
        localStorage.removeItem('token')                                // remove the token from localStorage in server
        localStorage.removeItem('user')                                 // remove the user from localStorage in server
        Toast.fire({                                                    // sweetAlert success notification
            icon: 'success',
            title: 'Logout successfully'
        })
        this.$router.push({ name: '/' })                                // go to login page
    }
}


</script>

<style type="text/css">

</style>