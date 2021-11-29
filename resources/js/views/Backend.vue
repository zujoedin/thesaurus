<template>    
    <container>
        <div class='search-bar'>
            <search-bar @onSearch="setList"></search-bar>
            <add-word @onModalShow="showModal($event)"></add-word>
        </div>
        <list :listResults='listResults' @onModalShow="showModal($event)"></list>
        <modal :search='listResults.search' :edit='listResults.edit' :modal='modal'></modal>
    </container>
</template>

<script>

import SearchBar from '../components/SearchBar.vue'
import AddWord from '../components/AddWord.vue'
import List from '../components/List.vue'
import Container from '../components/partials/Container.vue'
import Modal from '../components/Modal.vue'

export default { 
    components: {  
        Container,
        List,
        SearchBar,
        AddWord,
        Modal
    },
    data(){
        return {           
            listResults:[],
            search:'',
            modal:'',
        }
    },
    mounted(){ 
    },
    methods: {
        setList (listResults) {
            this.listResults = listResults
        },
        showModal(event){
            this.modal = !this.modal
            if(event){                
                this.listResults.search = event
                this.listResults.edit = true
            }else{
                this.listResults.search = ''
                this.listResults.edit = false
            }
        }
    }
  
}
</script>
<style scoped>
.search-bar{
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-direction: row;
    flex-wrap: nowrap;
    align-content: stretch;
}
</style>