<template >
    <div class="list">        
        <div class='results' v-if='listLength>0'>
            We have found: <span class='text-primary'>{{listLength}}</span> synonims in the database!
        </div>
        <div v-if='listLength==0 && search!=""'>We have not found <span class='text-danger'>{{search}}</span>, do you want to add it to the dictionary?
            <button @click='modalShow(search)' class='btn btn-sm btn-primary'>Add</button>
        </div>
        <div>
            <ul class="list-group" >        
                <li v-for='(word,index) in listResults.list' :key='word.id' class="list-group-item">
                    {{word.word}} 
                    <button  title='Delete' @click="deleteWord(word.id,index)" class='btn float-right btn-sm btn-danger ml-2'>
                        <i class='fa fa-remove'></i>
                    </button>
                    <button  title='Edit' @click='modalShow(word.word)' class='btn float-right btn-sm btn-primary' >
                         <i class='fa fa-pencil'></i>
                    </button>
                 
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

import axios from 'axios'

export default {
    props:['listResults'], 
    components: {    
    },
    data(){
        return {
            listLength: 0,
            search:'',
            value: [],
            options: []
        }
    },
    mounted(){  
                    
    },
    methods: {
        getListLength(){
            this.listLength = this.listResults.list.length
        },
        getWord(){
            this.search = this.listResults.search
        },        
        deleteWord(id,index){
            let self = this
            axios.post('/api/delete-word',{
                id: id
            }).then(function (response) {                
                self.listResults.list.splice(index);
            }).catch(function (error) {
                console.log(error);
            });
        },
        modalShow(value){
           this.$emit("onModalShow",value)
        },
    },
    watch:{
        listResults () {
            this.getListLength()
            this.getWord()
        },
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>

.list-group-item{
    transition: background-color 0.5s ease-in;
}
.list-group-item:hover{
    background-color: #fafafa;
}
.results{
    margin-bottom:20px;
    text-align:center
}
</style>