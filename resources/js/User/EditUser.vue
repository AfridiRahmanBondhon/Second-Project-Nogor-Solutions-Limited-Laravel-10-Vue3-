<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>
                    Users
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody v-if="this.dataUser.length >0">
                        <tr v-for="(dataUser,index) in this.dataUser" :key="index">
                            <td>{{dataUser.name}}</td>
                            <td>
                                <!-- <RouterLink :to="{path: '/nogor/'+dataNogor.id+'/edit'}" class="btn btn-primary">Edit</RouterLink> -->
                                <button type="button" @click="deleteData(dataUser.id)" class="btn btn-danger">Delete</button>
                                <!-- <button type="button" @click="softDeleteData(dataNogor.id)" class="btn btn-success">Soft Delete</button> -->
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="5">Loading..</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({ /* options */ });
    export default {
        name: "userEdit",
        data(){
            return{
                dataUser:[],
            }
        },
        mounted(){
            this.getDataUser();
        },
        methods:{
            getDataUser(){
                axios.get(`/api/userAuthentication/userdata`).then(res=>{
                    this.dataUser = res.data.datas;
                    //console.log(this.dataUser);
                    //console.log(this.dataUser.image)
                    //console.log(res)
                });
            },
            deleteData(dataId){
                if (confirm('Are you sure you want to delete data?')){
                    axios.delete(`/api/userAuthentication/${dataId}/delete`)
                        .then(res => {
                            if (res.data.status==200) {
                                toaster.warning(`Data Deleted Successfully`,{position:"top",diration:5000});
                            }
                            this.getDataUser();
                            //alert(res.data.message)
                            this.getDataNogor()
                        }).catch(function (error) {
                        if (error.response) {
                            if (error.response.status == 404){
                                alert(error.response.data.message);
                            }
                        }
                    });
                }
            },
        },
    }
</script>

<style scoped>

</style>
