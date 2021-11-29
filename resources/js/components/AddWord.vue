<template >
    <div class="addWord">        
        <button class="btn btn-primary" title='Click here to add a new word' @click='modalShow()'> 
            <i class='fa fa-plus'></i>  
        </button>
    </div>
</template>

<script>

export default {
    components: { 
        
    },
    data(){
        return {
        }
    },
    mounted(){
      
    },
    methods: {  
        modalShow(){
           this.$emit("onModalShow")
       }  
    },
  
}
</script>
<style scoped>

</style>
