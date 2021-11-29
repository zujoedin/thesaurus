<template >
    <div class="search">        
        <div class="input-group mb-3">           
            <input type="text" class="form-control" v-model='search' placeholder="Search for any word!">
            <div class="input-group-append">
                <button @click='searchList()' class="btn btn-primary"><i class='fa fa-search'></i></button>
            </div>
        </div>
    </div>    
</template>

<script>

import axios from 'axios'
export default {
    components: { 
        
    },
    data(){
        return {    
           search: '',
        }
    },
    mounted(){
    },
    methods: {   
        searchList(){
            let self = this
            let search = this.search
            if(search==''){
                alert('You have to type in the word!')
                return
            }
            axios.post('/api/search',{
                search: search
            }).then(function (response) {
                let listWords = response.data
                // It would maybe be better to send one variable as an array
                self.$emit("onSearch",{'list':listWords,'search':search,'edit':false})          
            }).catch(function (error) {
                console.log(error);
            });
        },  
    },   
}
</script>
<style scoped>
.search{
    width: 50%;
}
</style>