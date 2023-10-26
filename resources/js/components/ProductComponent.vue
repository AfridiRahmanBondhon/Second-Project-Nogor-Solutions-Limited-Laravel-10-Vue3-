<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3" v-for="(fakedata,index) in this.product" :key="index">
                <div class="card">
                    <div class="card-header" @click="callParentMethod(fakedata.id)" >{{fakedata.title}}</div>
                    <div class="card-body" @click="callParentMethod(fakedata.id)" >
                        <img :src="fakedata.image" alt="error" style="height: 200px;width: 200px">
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
    </div>
</template>

<script>

export default{
    props:{
        product:Object
    },
    methods:{
        callParentMethod(fakedataId) {
            this.$emit('childMethodCall',fakedataId); // Emit the custom event
        }
    }
}
</script>
