<template>
    <div class="flex h-full flex-col">
        <header
            class="flex flex-none items-center justify-between border-b border-gray-200 px-6 py-4"
        >
            <div>
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    <time :datetime="MonthDayandYear" class="sm:hidden">
                        {{ dateToWords(dateToday) }}
                        <!-- {{ currentMonthinDays }} {{ dayOfMonth }} {{ currentYearinDays }} -->
                    </time>
                    <time :datetime="MonthDayandYear" class="hidden sm:inline" >
                        {{ dateToWords(dateToday) }}
                        <!-- {{ currentMonthinDays }} {{ dayOfMonth }} {{ currentYearinDays }} -->
                    </time>
                </h1>
                <p class="mt-1 text-sm text-gray-500">{{ currentDay }}</p>
            </div>
            <div class="flex items-center">
                <div
                    class="relative flex items-center rounded-md bg-white shadow-sm md:items-stretch"
                >
                    <button
                        @click="getPreviousDay"
                        type="button"
                        class="flex h-9 w-12 items-center justify-center rounded-l-md border-y border-l border-gray-300 pr-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pr-0 md:hover:bg-gray-50"
                    >
                        <span class="sr-only">Previous day</span>
                        <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                    <button
                        type="button"
                        @click="getToday"
                        class="hidden border-y border-gray-300 px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus:relative md:block"
                    >
                        Today
                    </button>
                    <span
                        class="relative -mx-px h-5 w-px bg-gray-300 md:hidden"
                    />
                    <button
                        @click="getNextDay"
                        type="button"
                        class="flex h-9 w-12 items-center justify-center rounded-r-md border-y border-r border-gray-300 pl-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pl-0 md:hover:bg-gray-50"
                    >
                        <span class="sr-only">Next day</span>
                        <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                </div>
                <div class="hidden md:ml-4 md:flex md:items-center">
                    <Menu as="div" class="relative">
                        <MenuButton
                            type="button"
                            class="flex items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                        >
                            Day view
                            <ChevronDownIcon
                                class="-mr-1 h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                        </MenuButton>

                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                            <MenuItems
                                class="absolute right-0 z-10 mt-3 w-36 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            >
                                <div class="py-1">
                                    <MenuItem v-slot="{ active }">
                                        <a
                                            @click="calendarViewLayout('day')"
                                            :class="[
                                                active
                                                    ? 'bg-gray-100 text-gray-900'
                                                    : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                            ]"
                                            >Day view</a
                                        >
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <a
                                            @click="calendarViewLayout('week')"
                                            :class="[
                                                active
                                                    ? 'bg-gray-100 text-gray-900'
                                                    : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                            ]"
                                            >Week view</a
                                        >
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <a
                                            @click="calendarViewLayout('month')"
                                            :class="[
                                                active
                                                    ? 'bg-gray-100 text-gray-900'
                                                    : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                            ]"
                                            >Month view</a
                                        >
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <a
                                            @click="calendarViewLayout('year')"
                                            :class="[
                                                active
                                                    ? 'bg-gray-100 text-gray-900'
                                                    : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                            ]"
                                            >Year view</a
                                        >
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                    <div class="ml-6 h-6 w-px bg-gray-300" />
                    <button
                        type="button"
                        class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                    >
                        Add event
                    </button>
                </div>
                <Menu as="div" class="relative ml-6 md:hidden">
                    <MenuButton
                        class="-mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500"
                    >
                        <span class="sr-only">Open menu</span>
                        <EllipsisHorizontalIcon
                            class="h-5 w-5"
                            aria-hidden="true"
                        />
                    </MenuButton>

                    <transition
                        enter-active-class="transition ease-out duration-100"
                        enter-from-class="transform opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95"
                    >
                        <MenuItems
                            class="absolute right-0 z-10 mt-3 w-36 origin-top-right divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        >
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Create event</a
                                    >
                                </MenuItem>
                            </div>
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Go to today</a
                                    >
                                </MenuItem>
                            </div>
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a
                                        @click="calendarViewLayout('day')"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Day view</a
                                    >
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a
                                        @click="calendarViewLayout('week')"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Week view</a
                                    >
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a
                                        @click="calendarViewLayout('month')"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Month view</a
                                    >
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a
                                        @click="calendarViewLayout('year')"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Year view</a
                                    >
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>
        </header>
        <div class="isolate flex flex-auto overflow-hidden bg-white">
            <div ref="container" class="flex flex-auto flex-col overflow-auto">
                <div
                    ref="containerNav"
                    class="sticky top-0 z-10 grid flex-none grid-cols-7 bg-white text-xs text-gray-500 shadow ring-1 ring-black ring-opacity-5 md:hidden"
                >
                    <span class="flex flex-col items-center pb-1.5 pt-3"
                        >S</span
                    >
                    <span class="flex flex-col items-center pb-1.5 pt-3"
                        >M</span
                    >
                    <span class="flex flex-col items-center pb-1.5 pt-3"
                        >T</span
                    >
                    <span class="flex flex-col items-center pb-1.5 pt-3"
                        >W</span
                    >
                    <span class="flex flex-col items-center pb-1.5 pt-3"
                        >T</span
                    >
                    <span class="flex flex-col items-center pb-1.5 pt-3"
                        >F</span
                    >
                    <span class="flex flex-col items-center pb-1.5 pt-3"
                        >S</span
                    >
                    <button
                        v-for="day in weeks"
                        :key="day.date"
                        type="button"
                        :class="[
                            day.isCurrentMonth ? '' : '',
                            (day.isSelected || day.isToday) && '',
                            day.isSelected && '',
                            !day.isSelected && day.isToday && '',
                            !day.isSelected &&
                                day.isCurrentMonth &&
                                !day.isToday &&
                                '',
                            !day.isSelected &&
                                !day.isCurrentMonth &&
                                !day.isToday &&
                                '',
                            'pl-8 mt-1 flex h-6 w-6 items-center justify-center rounded-full text-base font-semibold text-gray-900',
                        ]"
                    >
                        <time
                            :datetime="day.date"
                            :class="[
                                day.isSelected &&
                                    'flex h-8 w-8 items-center justify-center rounded-full',
                                day.isSelected &&
                                    day.isToday &&
                                    'bg-indigo-600',
                                day.isSelected && !day.isToday && 'bg-gray-900',
                                'ml-auto',
                            ]"
                            >{{
                                day.date.split("-").pop().replace(/^0/, "")
                            }}</time
                        >
                    </button>
                </div>
                <div class="flex w-full flex-auto">
                    <div class="grid flex-auto grid-cols-1 grid-rows-1" ref="containerOffset">
                        <!-- Horizontal lines -->
                        <div class="mt-2">
                        <!-- Show complete details of event-->
                        <div  v-if="countEvent!=0" class="px-2 py-2 sm:px-6 ">
                            <ol class="divide-y divide-gray-300 overflow-hidden rounded-lg bg-white text-sm shadow ring-1 ring-black ring-opacity-5">
                            <li v-for="(event, index) in events" :key="event.id" class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
                                <div class="flex-auto">
                                <!-- <p class="font-semibold text-base text-gray-900"></p> -->
                                <p class="font-semibold text-base text-gray-900">{{ event.name }}</p>
                                <p class="font-normal text-gray-900">{{ event.description }}</p>
                                <time :datetime="event.datetime" class="mt-2 flex items-center text-gray-700">
                                    <ClockIcon class="mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                                    {{ event.time }} | Start: {{ dateToWords(event.enddatetime) }} End: {{ dateToWords(event.enddatetime) }}
                                </time>
                                </div>
                                <!-- <a :href="event.href" class="ml-6 flex-none self-center rounded-md bg-white px-3 py-2 font-semibold text-gray-900 opacity-0 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400 focus:opacity-100 group-hover:opacity-100"
                                >Edit<span class="sr-only">, {{ event.name }}</span></a> -->
                            </li>
                            </ol>
                        </div>
                    </div>



                    </div>
                </div>
            </div>
            <div
                class="hidden w-1/2 max-w-md flex-none border-l border-gray-100 px-8 py-10 md:block"
            >
                <div class="flex items-center text-center text-gray-900">
                    <button
                        @click="handlePreviousMonth"
                        type="button"
                        class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                    >
                        <span class="sr-only">Previous month</span>
                        <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                    <div class="flex-auto text-sm font-semibold">
                        {{ currentMonth }} {{ currentYear }}
                    </div>
                    <button
                        @click="handleNextMonth"
                        type="button"
                        class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                    >
                        <span class="sr-only">Next month</span>
                        <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                </div>
                <div class="mt-6 grid grid-cols-7 text-center text-xs leading-6 text-gray-500" >
                    <div>S</div>
                    <div>M</div>
                    <div>T</div>
                    <div>W</div>
                    <div>T</div>
                    <div>F</div>
                    <div>S</div>
                </div>
                <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200" >

                    <button
                        v-for="day in months"
                        :key="day.date"
                        type="button"
                        :class="[
                            day.isCurrentMonth ? 'bg-white' : 'bg-gray-50',
                            (day.isSelected || day.isToday) && 'font-semibold',
                            day.isSelected && 'text-white',
                            !day.isSelected && day.isToday && 'text-indigo-600',
                            !day.isSelected &&
                                day.isCurrentMonth &&
                                !day.isToday &&
                                'text-gray-900',
                            !day.isSelected &&
                                !day.isCurrentMonth &&
                                !day.isToday &&
                                'text-gray-500',
                            'flex h-14 flex-col px-3 py-2 hover:bg-gray-100 focus:z-10',
                        ]"
                    >
                        <div  @click.prevent="setSelectedDate(day.date)" class="w-full h-full">
                            <time :datetime="day.date" :class="[ day.isSelected && 'flex h-6 w-6 items-center justify-center rounded-full bg-red-500 w-full h-full', day.isSelected && day.isToday && 'bg-indigo-600', day.isSelected && !day.isToday && 'bg-gray-900', 'ml-auto', ]" >
                            {{ day.date.split("-").pop().replace(/^0/, "") }}
                            </time>
                            <span v-if="day.events.length > 3" class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                                <!-- <span v-for="event in day.events.slice(0, 2)" :key="event.id"  class="mx-0.5 h-1.5 w-1.5 rounded-full bg-gray-400" /> -->
                                <!-- <span v-if="day.events.length > 2" class="mx-0.5 mb-1 h-1.5 w-1.5 text-xs">+</span> -->
                                <span class="mx-0.5 h-1 w-full text-xs bg-gray-400"></span>
                            </span>
                            <span v-else class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                                <span v-for="event in day.events" :key="event.id"  class="mx-0.5 h-1.5 w-1.5 rounded-full bg-gray-400" />
                            </span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import {
    ChevronDownIcon,
    ChevronLeftIcon,
    ClockIcon,
    ChevronRightIcon,
    EllipsisHorizontalIcon,
} from "@heroicons/vue/20/solid";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";

const container = ref(null);
const containerNav = ref(null);
const containerOffset = ref(null);

onMounted(() => {
    // Set the container scroll position based on the current time.
    const currentMinute = new Date().getHours() * 60;
    container.value.scrollTop =
        ((container.value.scrollHeight -
            containerNav.value.offsetHeight -
            containerOffset.value.offsetHeight) *
            currentMinute) /
        1440;
});
</script>

<script>
export default {
    data() {
        return {
            events: [],
            eventsInMonth: [],
            months: [],
            days: [],
            weeks: [],
            month: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ],
            monthindays: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ],
            currentMonth: "",
            currentYear: "",
            currentMonthinDigit: 0,
            MonthAndYear: "",
            selectedDay: null,
            MonthDayandYear: "",
            currentMonthinDays: "",
            dayOfMonth: "",
            dayOfWeek: "",
            currentMonthDaysinDigit: "",
            currentMonthinDays: "",
            currentYearinDays: "",
            currentDay: "",
            weekdays: [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ],
            dateToday:'',
            countEvent:0,
        };
    },
    methods: {
        calendarViewLayout(layout) {
            this.emitter.emit("calendarviewlayout", layout);
        },

        dateToWords(date) {
            const d = new Date(date);
            return d.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            });
        },
        setSelectedDate(date) {

            this.events.length=0;
            this.dateToday= date;
            this.events.length = 0 ;
            const d = new Date(date);
            this.currentDay = this.weekdays[d.getDay()];
            this.getData();
        },

        async fetchAndGenerateMonth() {
            await this.getMonthsData();
            this.getCalendarinMonth(this.currentYear, this.currentMonthinDigit);
        },

        getCurrentMonthDayandYear() {
            const days = new Date();
            const monthindays = this.monthindays;
            this.dayOfMonth = days.getDate();
            this.dayOfWeek = days.getDay();
            this.currentDay = this.weekdays[this.dayOfWeek];
            this.currentMonthDaysinDigit = days.getMonth() + 1;
            this.currentMonthinDays = monthindays[days.getMonth()];
            this.currentYearinDays = days.getFullYear();
            this.MonthDayandYear = `${this.currentYearinDays}-${this.currentMonthDaysinDigit}-${this.currentDay}`;
            this.dateToday= days.getFullYear() + '/' + (days.getMonth()+1) + '/' + days.getDate();
        },
        getCurrentMonthandYear() {
            const d = new Date();
            const month = this.month;
            // this.currentMonth = month[d.getMonth()];
            this.currentYear = d.getFullYear();
            this.currentMonthinDigit = d.getMonth() + 1;
            this.MonthAndYear = `${this.currentYear}-${this.currentMonthinDigit}`;
        },

        getCurrentWeeksInMonth() {
            const d = new Date();
            const month = this.month;
            this.currentweek = d.getDate();
            this.currentWeekDay = d.getDay();
            this.startOfCurrentWeek = this.currentweek - this.currentWeekDay;
            this.currentMonth = month[d.getMonth()];
            this.startOfWeekDate = new Date(
                d.setDate(this.startOfCurrentWeek)
            ).getDate();
            this.endOfWeekDate = new Date(
                d.setDate(this.startOfCurrentWeek + 6)
            ).getDate();
            // this.currentMonth = month[d.getMonth()];
            this.currentYear = d.getFullYear();
            this.currentMonthinDigit = d.getMonth() ;
            this.MonthAndYear = `${this.currentYear}-${this.currentMonthinDigit}`;

            console.log(this.startOfWeekDate);
            console.log(this.endOfWeekDate);
        },
        async getMonthsData() {
          try {
            this.emitter.emit('loadingdata', true);
            const response = await axios.get(route('holidays.getlist'), {
              params: { presentMonth: this.dateToday },
            });
            const holidays = response.data;
            this.eventsInMonth = holidays.data.map((val) => ({
              id: val.id,
              name: val.name,
              description: val.description,
              time: val.temptime,
              datetime: val.from_datetime.split(" ")[0],
              enddatetime: val.to_datetime.split(" ")[0],
              href: '#',
            }));
            console.log('Holidays:', this.eventsInMonth);
          } catch (error) {
            console.error('Error fetching data:', error);
          } finally {
            this.emitter.emit('loadingdata', false);
          }
      },

        getData() {
            var arr = [];
            this.emitter.emit("loadingdata", true);
            axios.get(route('holidays.getTodayEvent'), {
            params:{
                newDate: this.dateToday
            }
           }).then((response) => {
                this.holidays = response.data;
                console.log(response.data);
                response.data.data.forEach((val) => {
                    arr.push({
                        id: val.id,
                        description:val.description,
                        name: val.name,
                        time: val.temptime,
                        datetime: val.from_datetime,
                        enddatetime: val.to_datetime,
                        href: "#",
                    });
                });

                this.events = arr;
                this.countEvent=arr.length

                console.log(arr);
                console.log(this.countEvent);
            });
        },

        // getDayInMonth(year, month) {
        //     const lastDayOfMonth = new Date(year, month, 0).getDate();
        //     const firstDayOfMonth = new Date(year, month - 1, 1).getDay();

        //     this.days = [];
        //     console.log();
        //     const today = new Date().toISOString().slice(0, 10);
        //     for (let i = 0; i < firstDayOfMonth; i++) {
        //         this.days.push({
        //             date: "",
        //             events: [],
        //             isCurrentMonth: true,
        //             isToday: false,
        //             isSelected: false,
        //         });
        //     }

        //     console.log(this.days);
        //     for (let day = 1; day <= lastDayOfMonth; day++) {
        //         const currentDate = `${year}-${month.toString().padStart(2, "0")}-${day.toString().padStart(2, "0")}`;

        //         var arr = [];
        //         this.eventsInMonth.forEach((val) => {
        //             if (currentDate === val.datetime.split(" ")[0]) {
        //                 arr.push(val);
        //             }
        //         });
        //         var isToday = today === currentDate;

        //         this.days.push({
        //             date: currentDate,
        //             eventsInMonth: arr,
        //             isCurrentMonth: true,
        //             isToday: isToday,
        //             isSelected: isToday,
        //         });
        //     }
        //     this.selectedDay = this.days.find((day) => day.isSelected);

        //     //end axios
        // },

        getCalendarinMonth(year, month) {
            const lastDayOfMonth = new Date(year, month, 0).getDate();
            const firstDayOfMonth = new Date(year, month - 1, 1).getDay();
            this.months = [];
            console.log();
            const today = new Date().toISOString().slice(0, 10);
            for (let i = 0; i < firstDayOfMonth; i++) {
                this.months.push({
                    date: "",
                    events: [],
                    isCurrentMonth: false,
                    isToday: false,
                    isSelected: false,
                });
            }
            console.log(this.months);
            for (let day = 1; day <= lastDayOfMonth; day++) {
                const currentDate = `${year}-${month
                    .toString()
                    .padStart(2, "0")}-${day.toString().padStart(2, "0")}`;

                var arr = [];
                this.eventsInMonth.forEach((val) => {
                    if (currentDate === val.datetime.split(" ")[0]) {
                        arr.push(val);
                    }
                });
                var isToday = today === currentDate;

                this.months.push({
                    date: currentDate,
                    events: arr,
                    isCurrentMonth: true,
                    isToday: isToday,
                    isSelected: isToday,
                });
            }
            this.selectedDay = this.months.find((day) => day.isSelected);
        },

        handlePreviousMonth() {

            this.eventsInMonth.length=0;
            this.currentMonthinDigit--;
            if (this.currentMonthinDigit < 1) {
                this.currentYear--;
                this.currentMonthinDigit = 12;
            }
            this.MonthAndYear = `${this.currentYear}-${this.currentMonthinDigit}`;
            this.months = [];
            this.currentMonth = this.month[this.currentMonthinDigit - 1];
            // this.getCalendarinMonth(this.currentYear, this.currentMonthinDigit);
            this.dateToday= `${this.currentYear}-${this.currentMonthinDigit}-1`;
            console.log(this.dateToday);
            console.log('d2d');
            this.fetchAndGenerateMonth();
        },

        handleNextMonth() {

            this.eventsInMonth.length=0;
            //this.currentMonth++
            this.currentMonthinDigit++;
            if (this.currentMonthinDigit > 12) {
                this.currentYear++;
                this.currentMonthinDigit = 1;
            }
            this.MonthAndYear = `${this.currentYear}-${this.currentMonthinDigit}`;
            this.months = [];
            this.currentMonth = this.month[this.currentMonthinDigit - 1];
            this.dateToday= `${this.currentYear}-${this.currentMonthinDigit}-1`;
            // this.getCalendarinMonth(this.currentYear, this.currentMonthinDigit);
            console.log(this.dateToday);
            console.log('d2d');
            this.fetchAndGenerateMonth();
        },

        getPreviousDay(){
            this.events.length=0;
            this.dayOfMonth--;
            this.currentDay--;

            if (this.dayOfMonth === 0){
                if(this.currentMonthDaysinDigit === 1){
                    this.currentYearinDays--;
                    this.currentMonthDaysinDigit = 12;
                }else {
                    this.currentMonthDaysinDigit--;
                }
                const daysInPreviousMonth = new Date(this.currentYearinDays, this.currentMonthDaysinDigit, 0).getDate();
                this.dayOfMonth = daysInPreviousMonth;
            }
            const previousDate = new Date(this.currentYearinDays, this.currentMonthDaysinDigit - 1, this.dayOfMonth);
            this.currentYearinDays = previousDate.getFullYear();
            this.currentMonthDaysinDigit = previousDate.getMonth() + 1;
            this.currentDay = this.weekdays[previousDate.getDay()];
            this.days = [];
            this.MonthYearAndDay = `${this.currentYearinDays}-${this.currentMonthDaysinDigit}-${this.dayOfMonth}`;
            this.currentMonthinDays = this.monthindays[this.currentMonthDaysinDigit - 1];
            // this.getDayInMonth(this.dayOfMonth, this.currentDay);
            this.dateToday= previousDate.getFullYear() + '/' + (previousDate.getMonth()+1) + '/' + previousDate.getDate();
            this.getData();
        },

        getNextDay() {
            this.events.length=0;
            const daysInCurrentMonth = new Date(
                this.currentYearinDays,
                this.currentMonthDaysinDigit,
                0
            ).getDate();

            this.dayOfMonth++;
            this.currentDay++;
            this.days = [];

            if (this.dayOfMonth > daysInCurrentMonth) {
                this.dayOfMonth = 1;
                if (this.currentMonthDaysinDigit === 31) {
                    this.currentYearinDays++;
                    this.currentMonthDaysinDigit = 1;
                } else {
                    this.currentMonthDaysinDigit++;
                }
            }
            const nextDate = new Date(
                this.currentYearinDays,
                this.currentMonthDaysinDigit - 1,
                this.dayOfMonth
            );
            this.currentYearinDays = nextDate.getFullYear();
            this.currentMonthDaysinDigit = nextDate.getMonth() + 1;
            this.currentDay = this.weekdays[nextDate.getDay()];
            this.days = [];
            this.MonthYearAndDay = `${this.currentYearinDays}-${this.currentMonthDaysinDigit}-${this.dayOfMonth}`;
            this.currentMonthinDays =
                this.monthindays[this.currentMonthDaysinDigit - 1];
            // this.getDayInMonth(this.dayOfMonth, this.currentDay);
            this.dateToday= nextDate.getFullYear() + '/' + (nextDate.getMonth()+1) + '/' + nextDate.getDate();
            this.getData();

        },

        getToday(){
            this.events.length=0;
            this.getCurrentMonthDayandYear();
            // this.getDayInMonth(this.currentYearinDays,this.currentMonthDaysinDigit);
        this.getData();

        }
    },

    created() {
        this.getData();
        //days
        this.getCurrentWeeksInMonth();
        this.getCurrentMonthDayandYear();
        // this.getDayInMonth(this.currentYearinDays,this.currentMonthDaysinDigit);
        //monthly
        this.getCurrentMonthandYear();
        // this.getCalendarinMonth(this.currentYear, this.currentMonthinDigit);
        this.fetchAndGenerateMonth();
            // this.fetchAndGenerateMonth();
        //weekly
        // this.getCalendarinWeeks(this.currentWeekDay, this.startOfCurrentWeek);
    },
};
</script>
