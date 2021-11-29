<template>
    
    <container>
        <div class="search">        
            <div class="input-group mb-3">           
                <input type="text" class="form-control" v-model='search' placeholder="Search for any word!">
                <div class="input-group-append">
                    <button @click='searchData(search)' class="btn btn-primary"><i class='fa fa-search'></i></button>
                </div>              
            </div>
        </div> 
        <div>
              <ul class="list-group" >
                <li class="list-group-item title">Search Results</li>        
                <li v-for='word in searchResult' :key='word.id' class="list-group-item">
                    {{word}}                                   
                </li>
            </ul>
        </div>
        <div>
              <ul class="list-group"> 
                  <li class="list-group-item title">All Words</li>        
                <li v-for='word in dataSet' :key='word.id' class="list-group-item">
                    {{word}}                                   
                </li>
            </ul>
        </div>
    </container>
    
</template>

<script>

import Container from '../components/partials/Container.vue'

export default {
    components: { 
        Container
    },
    data(){
        return {
            dataSet: [ 
                ["house","apartman","condo","building"],
                ["car","truck","vehicle","auto","motor"],
                ["computer","pc","brain","laptop"],
                ["animal","beast","pet","creature"],
                ["wall","block","barrier","facade"],
                ["country","land","people","public","region"],
                ["water","rain"],
            ],
            searchResult:[],
            search:''
        }
    },
    mounted(){
      
    },
    methods: {  
        searchData(word){
            let self = this
            self.searchResult = []
            this.dataSet.forEach(function(element,index){
                element.forEach(function(e,i){
                    if(e==word){
                        self.searchResult.push(self.dataSet[index])
                    }
                })
            })                
        }          
    }
  
}
</script>


<style scoped>

.list-group-item{
    transition: background-color 0.1s ease-in;
}
.list-group-item:hover{
    background-color: #66f;
    color:#fff
}
.results{
    margin-bottom:20px;
    text-align:center
}
.list-group{
    margin-bottom: 20px;
}
.title{
    background:#66f;
    color:#fff
}
</style>