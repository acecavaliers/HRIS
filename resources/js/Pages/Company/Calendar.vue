<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import CalendarMonth from '@/Pages/Templates/CalendarMonth.vue';
import CalendarDay from '@/Pages/Templates/CalendarDay.vue';
import CalendarWeek from '@/Pages/Templates/CalendarWeek.vue';
import CalendarYear from '@/Pages/Templates/CalendarYear.vue';
</script>

<template>
    <Head title="Calendar" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Calendar</h2>
        </template>


        <span v-if="calendarviewlayout == 'month'">
            <CalendarMonth></CalendarMonth>
        </span>
        <span v-else-if="calendarviewlayout == 'week'">
            <CalendarWeek></CalendarWeek>
        </span>
        <span v-else-if="calendarviewlayout == 'day'">
            <CalendarDay></CalendarDay>
        </span>
        <span v-else-if="calendarviewlayout == 'year'">
            <CalendarYear></CalendarYear>
        </span>
        <span v-else>
            <CalendarMonth></CalendarMonth>
        </span>


    </MasterLayout>

</template>


<script>
export default {
    data(){
        return{
            calendarviewlayout: 'month'
        }
    },
    created(){

        this.emitter.on('calendarviewlayout', (layout) => {
              this.calendarviewlayout = layout
          })
    }
}


</script>





