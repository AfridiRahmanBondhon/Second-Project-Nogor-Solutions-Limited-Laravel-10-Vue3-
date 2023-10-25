<template>
    <div class="container">
        <div class="card">
            <div class="card-header">Registration Page</div>
            <div class="card-body">
                <form id="registration" enctype="multipart/form-data" >
                    <div class="mb-3">
                        <label class="col-12 text-secondary">Name</label>
                        <input @keyup="validate()" v-model="model.user.name" type="text" name="name"  class="form-controll col-4 text-center rounded" />
                        <p class="text-danger" v-if="errorList.name">{{ errorList.name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="col-12 text-secondary">Email</label>
                        <input @keyup="validate()" v-model="model.user.email" type="text" name="email"  class="form-controll col-4 text-center rounded" />
                        <p class="text-danger" v-if="errorList.email">{{ errorList.email }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="col-12 text-secondary">Password</label>
                        <input @keyup="validate()" v-model="model.user.password" type="password" name="password" class="form-controll col-4 text-center rounded" />
                        <p class="text-danger" v-if="errorList.password">{{ errorList.password }}</p>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary col-md-4" @click.prevent="saveData" type="button">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({ /* options */ });

    export default {
        name: "userRegistration",
        data(){
            return{
                errorList : {},
                model:{
                    user:{
                        name:'',
                        email:'',
                        password:'',
                    }
                }
            }
        },
        methods:{
            saveData(){
                console.log(Object.keys(this.errorList.name).length);
                if(Object.keys(this.errorList.name).length>0){
                    return false;
                }else if(Object.keys(this.errorList.email).length>0){
                    return false
                }else if (Object.keys(this.errorList.password).length>0){
                    return false
                }
                /*const form=document.getElementById('registration');
                let formData = new FormData(form);*/
                axios.post('/api/userAuthentication',this.model.user)
                    .then(res=>{
                        if (res.data.status==200) {
                            window.location.href='/login';
                            toaster.success(`Registration Successful`,{position:"top",diration:5000});
                        }
                        this.model.user={
                            name:'',
                            email:'',
                            password:'',
                        }
                    }).catch(function (error) {
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
            },
            validate(){
                for (const property in this.model.user) {
                    //console.log(`${property}: ${this.model.user[property]}`);
                    if(this.model.user[property]==''){
                        this.errorList[property] = property + " is required";
                    }
                    else{
                        this.errorList[property] ='';
                    }
                }
            },
        }
    }
</script>

<style scoped>

</style>
