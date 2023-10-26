<template>
    <div class="container align-middle">
        <div class="row align-middle">
            <div class="col-lg-6 align-middle">
                <div class="card">
                    <div class="card-header bg-success text-bg-success align-middle">{{ fakestoreapiproduct.title }}</div>
                    <div class="card-body">
                        <img :src="fakestoreapiproduct.image" alt="error" style="height: 500px;width: 500px">
                        <div class="text-bg-success text-center rounded">
                            <label>{{ fakestoreapiproduct.category }}</label>
                        </div>
                        <div class="text-bg-info rounded">
                            <label>{{ fakestoreapiproduct.description }}</label>
                        </div>
                        <div class="text-bg-secondary text-end rounded">
                            <label >{{ fakestoreapiproduct.rating }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    name:'product',
    data(){
        return{
            fakestoreapiproduct:[],
        }
    },
    mounted(){
        this.getProduct(this.$route.params.id);
    },
    methods:{
        getProduct(dataId){
            axios.get(`https://fakestoreapi.com/products/${dataId}`).then(response=>{
                this.fakestoreapiproduct=response.data;
                //console.log(dataId);
            })
        }
    }

}
</script>
