<template>
    <div class="lg:flex lg:h-full lg:flex-col">
      <header class="flex items-center justify-between border-b border-gray-200 px-6 py-4 lg:flex-none">
        <h1 class="text-base font-semibold leading-6 text-gray-900">
            <time :datetime="monthHeader">{{ monthHeader }}</time>

        </h1>
        <div class="flex items-center">
          <div class="relative flex items-center rounded-md bg-white shadow-sm md:items-stretch">
            <button  @click="previousMonth" type="button" class="flex h-9 w-12 items-center justify-center rounded-l-md border-y border-l border-gray-300 pr-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pr-0 md:hover:bg-gray-50">
              <span class="sr-only">Previous month</span>
              <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
            </button>
            <button  @click="todayMonth" type="button" class="hidden border-y border-gray-300 px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus:relative md:block">Today</button>
            <span class="relative -mx-px h-5 w-px bg-gray-300 md:hidden" />
            <button @click="nextMonth" type="button" class="flex h-9 w-12 items-center justify-center rounded-r-md border-y border-r border-gray-300 pl-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pl-0 md:hover:bg-gray-50">
              <span class="sr-only">Next month</span>
              <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
            </button>
          </div>
          <div class="hidden md:ml-4 md:flex md:items-center">
            <Menu as="div" class="relative">
              <MenuButton type="button" class="flex items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                Month view
                <ChevronDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
              </MenuButton>

              <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                <MenuItems class="absolute right-0 z-10 mt-3 w-36 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                  <div class="py-1">
                    <MenuItem v-slot="{ active }">
                      <a @click="calendarViewLayout('day')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Day view</a>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <a @click="calendarViewLayout('week')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Week view</a>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <a @click="calendarViewLayout('month')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Month view</a>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <a @click="calendarViewLayout('year')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Year view</a>
                    </MenuItem>
                  </div>
                </MenuItems>
              </transition>
            </Menu>
            <div class="ml-6 h-6 w-px bg-gray-300" />
            <button type="button" class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Add event</button>
          </div>
          <Menu as="div" class="relative ml-6 md:hidden">
            <MenuButton class="-mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500">
              <span class="sr-only">Open menu</span>
              <EllipsisHorizontalIcon class="h-5 w-5" aria-hidden="true" />
            </MenuButton>

            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
              <MenuItems class="absolute right-0 z-10 mt-3 w-36 origin-top-right divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Create event</a>
                  </MenuItem>
                </div>
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Go to today</a>
                  </MenuItem>
                </div>
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                    <a @click="calendarViewLayout('day')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Day view</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a @click="calendarViewLayout('week')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Week view</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a @click="calendarViewLayout('month')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Month view</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a @click="calendarViewLayout('year')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Year view</a>
                  </MenuItem>
                </div>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </header>
      <div class="shadow ring-1 ring-black ring-opacity-5 lg:flex lg:flex-auto lg:flex-col">
        <div class="grid grid-cols-7 gap-px border-b border-gray-300 bg-gray-200 text-center text-xs font-semibold leading-6 text-gray-700 lg:flex-none">
          <div class="bg-white py-2">S<span class="sr-only sm:not-sr-only">un</span></div>
          <div class="bg-white py-2">M<span class="sr-only sm:not-sr-only">on</span></div>
          <div class="bg-white py-2">T<span class="sr-only sm:not-sr-only">ue</span></div>
          <div class="bg-white py-2">W<span class="sr-only sm:not-sr-only">ed</span></div>
          <div class="bg-white py-2">T<span class="sr-only sm:not-sr-only">hu</span></div>
          <div class="bg-white py-2">F<span class="sr-only sm:not-sr-only">ri</span></div>
          <div class="bg-white py-2">S<span class="sr-only sm:not-sr-only">at</span></div>
        </div>
        <div class="flex bg-gray-200 text-xs leading-6 text-gray-700 lg:flex-auto">
          <div class="hidden w-full lg:grid lg:grid-cols-7 lg:grid-rows-5 lg:gap-px ">
            <div v-for="day in days" :key="day.date" :class="[day.isCurrentMonth ? 'bg-white min-h-32 max-h-32' : 'bg-gray-50 text-gray-500 min-h-32 max-h-32', 'relative px-3 py-2']">
                <time :datetime="day.date" :class="day.isToday ? 'flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white' : undefined">{{ day.date }}</time>
                <ol v-if="day.events.length > 0" class="mt-2">
                  <li v-for="event in day.events.slice(0, 2)" :key="event.id">
                    <div
                      class="event bg-purple-400 text-white rounded p-1 text-sm mb-1"
                    >
                      <span>
                        <a href="" v-if="day.fullDate >= event.datetime.substring(0,10)   && day.fullDate <= event.enddatetime.substring(0,10)" @click.prevent="selectEvent(event)" class="group flex">
                          <p  class="flex-auto truncate font-medium text-white group-hover:text-gray-900">
                            {{ event.name }}
                          </p>
                          <time :datetime="event.datetime" class="ml-3 hidden flex-none text-gray-100 group-hover:text-gray-900 xl:block">{{ event.time }}</time>
                        </a>
                      </span>
                    </div>
                  </li>
                  <li v-if="day.events.length > 2" class="text-gray-500 hover:text-indigo-600">
                    <a href="" @click.prevent="setSelectedDate(day.fullDate)">+ {{ day.events.length - 2 }} more</a>
                  </li>

                </ol>
            </div>
          </div>
          <div class="isolate grid w-full grid-cols-7 grid-rows-6 gap-px lg:hidden">
            <button v-for="day in days" :key="day.date" type="button" @click.prevent="setSelectedDate(day.fullDate)" :class="[day.isCurrentMonth ? 'bg-white' : 'bg-gray-50', (day.isSelected || day.isToday) && 'font-semibold', day.isSelected && 'text-white', !day.isSelected && day.isToday && 'text-indigo-600', !day.isSelected && day.isCurrentMonth && !day.isToday && 'text-gray-900', !day.isSelected && !day.isCurrentMonth && !day.isToday && 'text-gray-500', 'flex h-14 flex-col px-3 py-2 hover:bg-gray-100 focus:z-10']">
              <time :datetime="day.date" :class="[day.isSelected && 'flex h-6 w-6 items-center justify-center rounded-full', day.isSelected && day.isToday && 'bg-indigo-600', day.isSelected && !day.isToday && 'bg-gray-900', 'ml-auto']">{{ day.date }}</time>
              <span v-if="day.events.length > 0" class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                <span v-for="event in day.events" :key="event.id"  class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400" />
              </span>
            </button>
          </div>
        </div>
      </div>
      <!-- transfer to section-->

    </div>

    <section ref="targetDiv" class="mt-4">

      <!-- <h2 class="px-2 mb-5 text-base font-semibold leading-6 text-gray-900">Upcoming events</h2><hr> -->
       <!-- Show complete details of event-->
      <div v-if="selectedEvent.length > 0" class="px-4 py-5 sm:px-6 ">
          <ol class="divide-y divide-gray-300 overflow-hidden rounded-lg bg-white text-sm shadow ring-1 ring-black ring-opacity-5">
            <li v-for="event in selectedEvent" :key="event.id" class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
              <div class="flex-auto">
                <p class="font-semibold text-gray-900">{{ dateToWords(event.datetime )}} - {{ dateToWords(event.enddatetime) }}</p>
                <p class="font-semibold text-base text-gray-900">{{ event.name }}</p>
                <p class="font-normal text-gray-900">{{ event.description }}</p>
                <time :datetime="event.datetime" class="mt-2 flex items-center text-gray-700">
                  <ClockIcon class="mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                  {{ event.time }}
                </time>
              </div>
              <!-- <a :href="event.href" class="ml-6 flex-none self-center rounded-md bg-white px-3 py-2 font-semibold text-gray-900 opacity-0 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400 focus:opacity-100 group-hover:opacity-100"
                >Edit<span class="sr-only">, {{ event.name }}</span></a> -->
            </li>
          </ol>
        </div>
        <!-- Show all events on this day-->
        <div v-if="todayEvents.length > 0" class="px-4 py-5 sm:px-6 ">
          <ol class="divide-y divide-gray-300 overflow-hidden rounded-lg bg-white text-sm shadow ring-1 ring-black ring-opacity-5">
            <li v-for="event in todayEvents" :key="event.id" class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
              <div class="flex-auto">
                <p class="font-semibold text-gray-900">{{ dateToWords(event.datetime) }} - {{ dateToWords(event.enddatetime) }}</p>
                <p class="font-semibold text-base text-gray-900">{{ event.name }}</p>
                <p class="font-normal text-gray-900">{{ event.description }}</p>
                <time :datetime="event.datetime" class="mt-2 flex items-center text-gray-700">
                  <ClockIcon class="mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                  {{ event.time }}
                </time>
              </div>
              <!-- <a :href="event.href" class="ml-6 flex-none self-center rounded-md bg-white px-3 py-2 font-semibold text-gray-900 opacity-0 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400 focus:opacity-100 group-hover:opacity-100"
                >Edit<span class="sr-only">, {{ event.name }}</span></a> -->
            </li>
          </ol>
        </div>
        <!-- Show todays events -->
        <div v-if="selectedDay?.events.length > 0" class="px-2 py-2 sm:px-6 ">
            <ol class="divide-y divide-gray-300 overflow-hidden rounded-lg bg-white text-sm shadow ring-1 ring-black ring-opacity-5">
                <p class="font-semibold text-base text-gray-900 px-4  py-2 divide-y divide-gray-300 " >Today's event</p>
                <li v-for="event in selectedDay.events" :key="event.id" class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
                    <div class="flex-auto">
                        <p class="font-semibold text-gray-900">{{ dateToWords(event.datetime) }} - {{ dateToWords(event.enddatetime) }}</p>
                        <p class="font-semibold text-base text-gray-900">{{ event.name }}</p>
                        <p class="font-normal text-gray-900">{{ event.description }}</p>
                    <time :datetime="event.datetime" class="mt-2 flex items-center text-gray-700">
                        <ClockIcon class="mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                        {{ event.time }}
                    </time>
                    </div>
                    <!-- <a :href="event.href" class="ml-6 flex-none self-center rounded-md bg-white px-3 py-2 font-semibold text-gray-900 opacity-0 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400 focus:opacity-100 group-hover:opacity-100"
                    >Edit<span class="sr-only">, {{ event.name }}</span></a> -->
                </li>
            </ol>
        </div>
    </section>


  <!--  Hoover Effect-->
    <div
        v-if="isModalVisible"
        @mouseleave="closeModal"
        :style="modalStyle"
        class="hover-modal  max-w-96 min-h-32 rounded-md"
      >
        <p class="text-sm text-gray-900">This is a hover modal that closes when you move the mouse away.</p>
      </div>

  </template>

  <script setup>
  import {
    ChevronDownIcon,
    ChevronLeftIcon,
    ChevronRightIcon,
    ClockIcon,
    EllipsisHorizontalIcon,
  } from '@heroicons/vue/20/solid'
  import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
  import axios from 'axios';
  import { setDevtoolsHook } from 'vue';
  </script>

  <script>
  export default {
    data() {
      return {
        currentYearMonth:'',
        monthHeader:'',
        currentDate: new Date(),
        days: [],
        events: [],
        setDate: '',
        todayEvents: [],
        selectedDay: null,
        selectedEvent: [],
        isModalVisible: false,
        mouseX: 0,
        mouseY: 0,
      };
    },

    created() {
        this.currentYearMonth= this.currentDate.getFullYear() + '-' + String(this.currentDate.getMonth() + 1).padStart(2, '0') ;
        this.fetchAndGenerateMonth();

      this.generateMonth();
    },
    computed: {
      // Compute the style for the modal to position it near the hover point
      modalStyle() {
        return {
          position: 'absolute',
          top: `${this.mouseY + 20}px`, // A little below the mouse
          left: `${this.mouseX}px`,
          backgroundColor: 'white',
          border: '1px solid gray',
          padding: '10px',
          zIndex: 100,
        };
      },
    },
    methods: {
      dateToWords(date) {
        const d = new Date(date);
        return d.toLocaleDateString('en-US', {
          year: 'numeric',
          month: 'long',
          day: 'numeric',
        });
      },
      // Open the modal when mouse hovers
      // openModal(event) {
      //   this.isModalVisible = true; // Show the modal
      //   this.mouseX = event.clientX; // Capture the x-coordinate
      //   this.mouseY = event.clientY; // Capture the y-coordinate

      // },

      // // Close the modal when mouse leaves
      // closeModal() {
      //   this.isModalVisible = false; // Hide the modal
      // },
      selectEvent(event) {
        this.todayEvents.length = 0 ;
        this.selectedEvent.length = 0 ;
        this.selectedEvent.push(event);
        const targetElement = this.$refs.targetDiv;

        if (targetElement) {
          // Scroll smoothly to the target div
          targetElement.scrollIntoView({
            behavior: "smooth", // Smooth scrolling
            // block: "start", // Align to the start of the target div
          });
        }
      },
      async fetchAndGenerateMonth() {
        await this.getData();
        this.generateMonth();
      },

      calendarViewLayout(layout){
            this.emitter.emit('calendarviewlayout', layout)
          },
      async getData() {
          try {
            this.emitter.emit('loadingdata', true);
            const response = await axios.get(route('holidays.getlist'), {
              params: { presentMonth: this.currentYearMonth },
            });
            const holidays = response.data;
            console.log(response.data);
            console.log('CNT');
            this.events = holidays.data.map((val) => ({
              id: val.id,
              name: val.name,
              description: val.description,
              time: val.temptime,
              datetime: val.from_datetime.split(" ")[0],
              enddatetime: val.to_datetime.split(" ")[0],
              href: '#',
            }));
            console.log('Holidays:', this.events);
          } catch (error) {
            console.error('Error fetching data:', error);
          } finally {
            this.emitter.emit('loadingdata', false);
          }
      },
      setSelectedDate(date) {
        const targetElement = this.$refs.targetDiv;

        if (targetElement) {
          // Scroll smoothly to the target div
          targetElement.scrollIntoView({
            behavior: "smooth", // Smooth scrolling
            // block: "start", // Align to the start of the target div
          });
        }
        this.todayEvents.length = 0 ;
        this.selectedEvent.length = null;
        this.setDate = date; // Set the selected date when clicked
        this.getDataToday();

      },
      getDataToday() {

        var arr = [];
        this.emitter.emit("loadingdata", true);
        axios.get(route('holidays.getTodayEvent'), {
        params:{
            newDate: this.setDate
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

            this.todayEvents = arr;

            console.log(arr);
        });
      },

      generateMonth() {
        const date = new Date(this.currentDate);
        this.currentYearMonth= date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') ;
        date.setDate(1);
        const today = new Date().toISOString().slice(0, 10);
        const mantYear = this.currentYearMonth;
        const firstDayOfWeek = date.getDay();
        const lastDayInMonth = new Date(
          date.getFullYear(),
          date.getMonth() + 1,
          0
        ).getDate();

        this.days.length=0;

        for (let i = 0; i < firstDayOfWeek; i++) {
          this.days.push({
            date: '',
            events: [],
            isCurrentMonth: false,
            isToday: false,
            isSelected: false,
            fullDate:'',
          });
  }

        for (let day = 1; day <= lastDayInMonth; day++) {
          const full_date = mantYear + '-' + String(day).padStart(2, '0');


          var arr =[];
            this.events.forEach((val)=>{
                if(full_date === val.datetime)
                {
                  arr.push(val);
                }
            })

          var isToday = today === full_date;

          this.days.push({
            date: day,
            events: arr,
            isCurrentMonth: true,
            isToday: isToday,
            isSelected: isToday,
            fullDate: full_date,
          });


        }
        this.selectedDay = this.days.find((day) => day.isSelected);

        const monthYearFormatter = new Intl.DateTimeFormat('en', {
          year: 'numeric',
          month: 'long',
        });
        this.monthHeader = monthYearFormatter.format(this.currentDate);

      },
      previousMonth() {
        this.todayEvents.length = 0 ;
        this.currentDate.setMonth(this.currentDate.getMonth() - 1);
        const date = new Date(this.currentDate);
        this.currentYearMonth= date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') ;
        this.fetchAndGenerateMonth();


      },
      nextMonth() {
        this.todayEvents.length = 0 ;
        this.currentDate.setMonth(this.currentDate.getMonth() + 1);
        const date = new Date(this.currentDate);
        this.currentYearMonth= date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') ;
        this.fetchAndGenerateMonth();
      },

      todayMonth() {
        this.todayEvents.length = 0 ;
        this.currentDate = new Date();
        const date = new Date(this.currentDate);
        this.currentYearMonth= date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') ;
        this.fetchAndGenerateMonth();
      },
    },
  };
  </script>

