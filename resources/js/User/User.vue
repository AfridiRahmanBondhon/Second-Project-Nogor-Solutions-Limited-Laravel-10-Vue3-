<template>
    <div class="container">
        <div class="card">
            <div class="card-header">Profile</div>
            <div class="card-body">
                <div class="mb-3">
                    <RouterLink to="/registration" class="btn btn-primary col-md-4" type="button">Registration</RouterLink>
                </div>
                <div class="mb-3">
                    <RouterLink to="/login" class="btn btn-primary col-md-4" type="button">Login</RouterLink>
                </div>
                <div class="mb-3">
                    <button @click="logOut()" class="btn btn-danger col-md-4" type="button">Logout</button>
                </div>
                <div class="mb-3">
                    <RouterLink to="/admin/editUser" class="btn btn-primary col-md-4" type="button">Edit User</RouterLink>
                </div>
                <div class="mb-3">
                    <RouterLink to="/admin/resetPassword" class="btn btn-primary col-md-4" type="button">Change Password</RouterLink>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({ /* options */ });

    export default {
        name: "userProfile",
        data(){
            return{
                errorList:{},
            }
        },

        methods:{
            logOut(){
                axios.post(`/api/userAuthentication/logout`)
                    .then(response=>{
                        if (response.data.status=200){
                            localStorage.removeItem("lastname")
                            toaster.warning(`You are Logged Out`,{position:"top",diration:5000});
                            window.location.href='/profile';
                        }
                    })
                    .catch(function (error) {
                        if (error.response) {
                            if (error.response.status == 202){
                                this.errorList = error.response.data.errors;
                            }
                            /*console.log(error.response.data);
                            console.log(error.response.status);
                            console.log(error.response.headers);*/
                        } else if (error.request) {
                            console.log(error.request);
                        } else {
                            console.log('Error', error.message);
                        }
                        console.log(error.config);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
