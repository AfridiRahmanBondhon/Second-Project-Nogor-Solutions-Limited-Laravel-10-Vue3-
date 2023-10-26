<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="col-md-1">
                    <button @click="passCategory('all')" class="btn btn-secondary border border-primary rounded align-middle col-md-12">
                        <label class="rounded align-middle" >All</label>
                    </button>
                </div>
                <div class="col-md-2" v-for="(category,index) in categories" :key="index">
                    <button @click="passCategory(category)" class="btn btn-secondary border border-primary rounded align-middle col-md-12" >
                        <label class=" rounded align-middle">{{ category }}</label>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

export default{
    props:{
        categories:Array,
    },
    methods:{
        passCategory(category){
            this.$emit('passChildCategory',category);
        },
    }
}

</script>
