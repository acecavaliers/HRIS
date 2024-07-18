<template>
    <div v-if="showAlert">
        <div :class="'rounded-md bg-'+alertColor+'-50 p-4'">
        <div class="flex">
            <div class="flex-shrink-0">
                <CheckCircleIcon v-if="alertType == 'success'" class="h-5 w-5 text-green-400" aria-hidden="true" />
                <ExclamationTriangleIcon v-if="alertType == 'warning'" class="h-5 w-5 text-yellow-400" aria-hidden="true" />
                <XCircleIcon v-if="alertType == 'danger'" class="h-5 w-5 text-red-400" aria-hidden="true" />
            </div>
            <div class="ml-3">
            <h3 :class="'text-sm font-medium text-'+alertColor+'-800'">{{ alertTitle }}</h3>


            <div :class="'mt-2 text-sm text-'+alertColor+'-700'">
                <p>{{ alertDescription }}</p>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script setup>
import { ExclamationTriangleIcon } from '@heroicons/vue/20/solid'
import { CheckCircleIcon, XMarkIcon, XCircleIcon} from '@heroicons/vue/20/solid'
</script>

<script>
export default {
    props: ['alertTitle', 'alertDescription'],

    data(){
        return {
            alertType: '',
            alertColor: '',
            showAlert: false
        }
    },

    methods: {
        getAlertColor(){
            if(this.alertType == 'success'){
                this.alertColor = 'green'
            }else if(this.alertType == 'warning'){
                this.alertColor = 'yellow'
            }else if(this.alertType == 'danger'){
                this.alertColor = 'red'
            }else if(this.alertType == 'info'){
                this.alertColor = 'blue'
            }else{
                this.alertColor = ''
            }
        },

        showalert(){
            this.showAlert = false;
        }
    },
    created(){
        this.emitter.on('alertType', (evt) => {
            this.alertType = evt;
            this.getAlertColor();
        })
        this.emitter.on('showAlert', (evt) => {
            this.showAlert = evt;
        })


    }
}




</script>
