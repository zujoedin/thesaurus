<template>
  <div id="app">
    <the-navbar></the-navbar>
    <router-view/>
    <the-footer></the-footer>
  </div>
</template>

<script>

import TheNavbar from './components/layouts/TheNavbar.vue'
import TheFooter from './components/layouts/TheFooter.vue'
export default {
  components: {  
      TheNavbar,
      TheFooter
  }
}
</script>


<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

</style>
