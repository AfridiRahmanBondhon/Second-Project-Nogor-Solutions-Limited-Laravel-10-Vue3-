<template>

    <CategoryComponent :categories="fakestoreapicategories" @passChildCategory="recievedCategory"/>

    <SearchComponent :categories="fakestoreapicategories" @passChildCategory="recievedCategory" @childSearhDataMethod="searchProduct"/>
    
    <!-- <div class="container">
        <div class="row">
            <div class="col-md-3" v-for="(fakedata,index) in this.fakestoreapiproducts" :key="index">
                <div class="card">
                    <div class="card-header" @click="indevisual(fakedata.id)" >{{fakedata.title}}</div>
                    <div class="card-body" @click="indevisual(fakedata.id)">
                        <img :src="fakedata.image" alt="error" style="height: 200px;width: 280px">
                        <div class="text-bg-success text-center rounded">
                            <label>{{ fakedata.category }}</label>
                        </div>
                        <div class="text-bg-secondary text-end rounded">
                            <label >{{ fakedata.rating.rate }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    
    <ProductComponent :product="fakestoreapiproducts" @childMethodCall="indevisual"/>
</template>

<script>
import axios from 'axios';
import ProductComponent from '../components/ProductComponent.vue';
import SearchComponent from '../components/SearchComponent.vue';
import CategoryComponent from '../components/CategoryComponent.vue';

export default {
    name:"product",
    components: {
        ProductComponent,
        SearchComponent,
        CategoryComponent,
    },
    data(){
        return{
            category:'',
            fakestoreapiproducts:[],
            fakestoreapicategories:[],

        }
    },
    mounted(){
        this.getProducts();
        this.getCategories();
    },
    methods:{
        getProducts(){
            axios.get(`https://fakestoreapi.com/products`).then(response=>{
                this.fakestoreapiproducts=response.data;
                //console.log(this.fakestoreapiproducts.id);
            })
        },
        getCategories(){
            axios.get(`https://fakestoreapi.com/products/categories`).then(response=>{
                this.fakestoreapicategories=response.data;
                //console.log(this.fakestoreapicategories);
            })
        },
        indevisual(fakedataId){
            this.$router.push(`/products/${fakedataId}/details`);
            //window.location.href=`/products/${fakedataId}/details`;
        },
        recievedCategory(category){
            this.category=category;
            if(this.category=='all'){
                this.getProducts();
            }else{
                this.getFilteredProducts(this.category);
            }
        },
        getFilteredProducts(categoryName){
            axios.get(`https://fakestoreapi.com/products/category/${categoryName}`).then(response=>{
                this.fakestoreapiproducts=response.data;
                //console.log(this.fakestoreapicategories);
            })
        },
        searchProduct(searchData){
            axios.get(`https://fakestoreapi.com/products`).then(response=>{
                console.log('hi')
                this.fakestoreapiproducts=response.data;
                const query = searchData.trim().toLowerCase();
                //console.log(query);
                this.fakestoreapiproducts = this.fakestoreapiproducts.filter(item => item.title.toLowerCase().includes(query));
                //console.log(this.fakestoreapiproducts.filter(item => item.title.toLowerCase().includes(query)));
            })
        },
    }
}
</script>
