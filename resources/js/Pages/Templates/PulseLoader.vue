<template>
  <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
</template>

<script setup>
 import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

</script>

<script>
export default {
   
    props: {
        loading: {
            type: Boolean,
            default: true
        },
        color: {
            type: String,
            default: '#5dc596'
        },
        size: {
            type: String,
            default: '15px'
        }
    }, 
    data(){
        return {
           
        }
    },

    created() {
       
    }
}




</script>