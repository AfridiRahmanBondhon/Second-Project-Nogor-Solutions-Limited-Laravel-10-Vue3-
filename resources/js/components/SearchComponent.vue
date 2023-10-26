<template>
    <div class="container">
        <div class="row searchFilter" >
            <div class="col-sm-12" >
                <div class="input-group" >
                    <input id="table_filter" v-model="searchData" type="text" class="form-control" aria-label="Text input with segmented button dropdown" >
                    <div class="input-group-btn" >
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span class="label-icon" >Category</span> <span class="caret" >&nbsp;</span></button>
                        <div class="dropdown-menu dropdown-menu-right" >
                            <ul class="category_filters" >
                                <li >
                                    <input class="cat_type category-input" @click="passCategory('all')" data-label="All" id="all" value="" name="radios" type="radio" >
                                    <label for="all" >All</label>
                                </li>
                                <li v-for="(category,index) in categories" :key="index">
                                    <input type="radio" name="radios" @click="passCategory(category)">
                                    <label class="category-label">{{ category }}</label>
                                </li>
                                <!-- <li >
                                    <input type="radio" name="radios" id="Marketing" value="Marketing" ><label class="category-label" for="Marketing" >{{ categories[1] }}</label>
                                </li>
                                <li >
                                    <input type="radio" name="radios" id="Programming" value="Programming" ><label class="category-label" for="Programming" >{{ categories[0] }}</label>
                                </li>
                                <li >
                                    <input type="radio" name="radios" id="Sales" value="Sales" ><label class="category-label" for="Sales" >{{ categories[0] }}</label>
                                </li>
                                <li >
                                    <input type="radio" name="radios" id="Support" value="Support" ><label class="category-label" for="Support" >Support</label>
                                </li> -->
                            </ul>
                        </div>
                        <button @click="searchDataMethod(searchData)" id="searchBtn" type="button" class="btn btn-secondary btn-search" ><span class="glyphicon glyphicon-search" >&nbsp;</span> <span class="label-icon" >Search</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{

    data(){
        return{
            searchData:'',
        }
    },
    props:{
        categories:Array,
    },
    methods:{
        passCategory(category){
            this.$emit('passChildCategory',category);
        },
        searchDataMethod(searchData){
            //console.log(searchData);
            this.$emit('childSearhDataMethod',searchData);
        },
        // callParentMethod(fakedataId) {
        //     this.$emit('childMethodCall',fakedataId); // Emit the custom event
        // }
    }
}
</script>
