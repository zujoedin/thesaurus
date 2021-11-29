<template >
    <div>
        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if='showSuccess'>
            <strong>Great</strong> You have added a new word
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" @click='showSuccess=false'>&times;</span>
            </button>
        </div>
        <div class="modal" v-if='modalShowData'>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><span v-if='!edit'>Add</span><span v-else>Edit</span> Word</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  @click='modalCloseData()'>
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="word">Word</label>
                            <input type="email" class="form-control" :readonly='edit' required id="word" v-model='newWord' placeholder="Enter new word">
                        </div>
                        <div class="form-group">
                            <label for="word">Synonyms</label>
                               <multiselect v-model="value" tag-placeholder="Add this as new synonym" placeholder="Search or add a synonym" label="word" track-by="word" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click='saveData()'>Save</button>
                        <button type="button" class="btn btn-secondary" @click='modalCloseData()'>Close</button>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
import axios from 'axios'

export default {
    props:['search','edit','modal'],
    components: { 
        Multiselect,        
    },
    data(){
        return { 
           value:[],
           options:[],
           newWord:'',
           modalShowData:false,
           showSuccess:false
        }
    },
    mounted(){    
    
    },
    methods: {   
        getOptions(){
            let self = this
            let search = ''
            // check if we are editing the word
            if(self.edit==true){
                search = self.search
            }                       
            axios.post('/api/get-words',{
                search: search
            }).then(function (response) {
                self.options = response.data
                // value of multiselect doesnt need to be displayed in case of new blank word
                if(self.edit){
                    self.value = response.data
                }else{
                   self.value = []
                }
            }).catch(function (error) {
                console.log(error);
            });
        }, 
        //Multiselect functionality
        addTag (newTag) {
            let tag = {
                word: newTag,
            }
            this.options.push(tag)
            this.value.push(tag)
        },
        // Save data is used for edit and for save new word
        // Synonyms are sent as an array
        saveData(){   
            let self = this       
            self.modalShowData = false
            if(self.newWord==''){
                alert("You didnt insert any words!")
                return
            }
            axios.post('/api/save-words',{
                selected: self.value,
                word: self.newWord
            }).then(function (response) {
                self.showSuccess = true;        
            }).catch(function (error) {
                console.log(error);
            });
        },

        modalCloseData(){
            this.modalShowData = false
        },        
    },
    watch:{
        // Because the prop cannot be changed watcher is used to change the value of the modal
        modal(){
            this.getOptions()
            this.modalShowData = true
        },
        // Used to control input if you want to add a new word directly from search
        search(){
            this.newWord = this.search
        },
    }
}
</script>
<style scoped>
.search{
    width: 50%;
}
.modal{
    display:block
}
</style>