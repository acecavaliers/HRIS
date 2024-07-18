<template>
  <div class="flex h-full flex-col">
    <header class="flex flex-none items-center justify-between border-b border-gray-200 px-6 py-4">
      <h1 class="text-base font-semibold leading-6 text-gray-900">
        <!-- <p>{{ currentIndex }} Current Data: {{ currentFullDate.toLocaleString() }} </p> -->
        <!-- <time :datetime="currentMonth"> {{ currentMonth}} </time> -->
        <time :datetime="currentMonth">{{dateToWords(weekStart).substring(0,6)}} - {{dateToWords(weekEnd).substring(0,6)}} </time>

      </h1>
      <div class="flex items-center">
        <div class="relative flex items-center rounded-md bg-white shadow-sm md:items-stretch">
          <button @click="previousWeek" type="button" class="flex h-9 w-12 items-center justify-center rounded-l-md border-y border-l border-gray-300 pr-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pr-0 md:hover:bg-gray-50">
            <span class="sr-only">Previous week</span>
            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
          </button>
          <button @click="todayWeek" type="button" class="hidden border-y border-gray-300 px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus:relative md:block">Today</button>
          <span class="relative -mx-px h-5 w-px bg-gray-300 md:hidden" />
          <button @click="nextWeek" type="button" class="flex h-9 w-12 items-center justify-center rounded-r-md border-y border-r border-gray-300 pl-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pl-0 md:hover:bg-gray-50">
            <span class="sr-only">Next week</span>
            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
          </button>
        </div>

        <div class="hidden md:ml-4 md:flex md:items-center">
          <Menu as="div" class="relative">
            <MenuButton type="button" class="flex items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
              Week view
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
    <div ref="container" class="isolate flex flex-auto flex-col overflow-auto bg-white" >
      <div style="width: 165%" class="flex max-w-full flex-none flex-col sm:max-w-none md:max-w-full" ref="containerNav">
      <div ref="containerOffset">
          <table class="w-full border">
          <thead>
              <tr>
                  <th v-for="(day, index ) in weekDates" :key="day.date" class="border h-24 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                      <div class="text-center xl:block lg:block md:block sm:block hidden">
                          <div v-if="index == 0 "class="text-sm text-gray-600">Sunday</div>
                          <div v-if="index == 1 "class="text-sm text-gray-600">Monday</div>
                          <div v-if="index == 2 "class="text-sm text-gray-600">Tuesday</div>
                          <div v-if="index == 3 "class="text-sm text-gray-600">Wednesday</div>
                          <div v-if="index == 4 "class="text-sm text-gray-600">Thursday</div>
                          <div v-if="index == 5 "class="text-sm text-gray-600">Friday</div>
                          <div v-if="index == 6 "class="text-sm text-gray-600">Saturday</div>
                          <button type="button" @click.prevent="setSelectedDate(day.weekDays)" :class="day.isToday ? 'text-blue-500 font-black' : undefined" class="text-4xl font-bold w-full">{{ day.weekDays.split('-').pop().replace(/^0/, '') }}</button>
                          <div class="text-xs">{{dateToWords(day.weekDays).substring(0,3)}}</div>
                      </div>

                      <div class="text-center xl:hidden lg:hidden md:hidden sm:hidden block">
                          <div v-if="index == 0 "class="text-sm text-gray-600">Sun</div>
                          <div v-if="index == 1 "class="text-sm text-gray-600">Mon</div>
                          <div v-if="index == 2 "class="text-sm text-gray-600">Tue</div>
                          <div v-if="index == 3 "class="text-sm text-gray-600">Wed</div>
                          <div v-if="index == 4 "class="text-sm text-gray-600">Thu</div>
                          <div v-if="index == 5 "class="text-sm text-gray-600">Fri</div>
                          <div v-if="index == 6 "class="text-sm text-gray-600">Sat</div>
                          <button type="button" @click.prevent="setSelectedDate(day.weekDays)" :class="day.isToday ? 'text-blue-500 font-black' : undefined" class="text-2xl font-bold w-full">{{ day.weekDays.split('-').pop().replace(/^0/, '') }}</button>
                          <div class="text-xs">{{dateToWords(day.weekDays).substring(0,3)}}</div>
                      </div>
                  </th>
              </tr>
          </thead>

          <tbody>
              <tr>
                  <td v-for="day in weekDates" :key="day.date" class=" align-top">
                      <ul>
                          <li  v-for="(event, index) in events" :key="event.id">
                              <div v-if=" day.weekDays  >=event.datetime.substring(0,10)   &&  day.weekDays  <= event.enddatetime.substring(0,10) " class="xl:block lg:block md:block sm:block hidden">
                                  <div @click.prevent="selectEvent(event, day.weekDays)"
                                   class="event bg-purple-400 text-white text-left rounded p-1 text-xs mb-0.5 max-w-50">
                                      <div class="m-2">
                                          <a :href="event.href" class="group flex">
                                              <p  class="flex-auto ">
                                              {{ event.name }}
                                              </p>
                                              <time :datetime="event.datetime" class="ml-3 hidden flex-none text-gray-300 xl:block  text-xs">{{ event.time }}</time>
                                          </a>
                                      </div>
                                  </div>
                              </div>


                              <div v-if=" day.weekDays  >=event.datetime.substring(0,10)   &&  day.weekDays  <= event.enddatetime.substring(0,10) " class="xl:hidden lg:hidden md:hidden sm:hidden block">
                                  <div @click.prevent="selectEvent(event, day.weekDays)"
                                   class="event bg-blue-400 text-black text-left rounded text-xs mb-0.5 max-w-12">
                                      <div>
                                          <p>
                                              {{ event.name }}
                                          </p>
                                      </div>
                                  </div>
                              </div>
                          </li>
                      </ul>
                  </td>
              </tr>
          </tbody>
          </table>
      </div>
      </div>
  </div>

  <section ref="targetDiv" class="mt-2">
   <!-- Show complete details of event-->
   <div v-if="selectedEvent.length != 0" class="px-2 py-2 sm:px-6 ">
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
          </li>
        </ol>
      </div>

  <div v-if="eventsToday.length > 0" class="px-2 py-2 sm:px-6 ">
    <ol class="divide-y divide-gray-300 overflow-hidden rounded-lg bg-white text-sm shadow ring-1 ring-black ring-opacity-5">

      <p class="font-semibold text-base text-gray-900 px-4  py-2 divide-y divide-gray-300 " >Today's event</p>
      <li v-for="event in eventsToday" :key="event.id"  class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
        <div class="flex-auto">
          <p class="font-semibold text-gray-900">{{ dateToWords(event.datetime )}} - {{ dateToWords(event.enddatetime) }}</p>
          <p class="font-semibold text-base text-gray-900">{{ event.name }}</p>
          <p class="font-normal text-gray-900">{{ event.description }}</p>
          <time :datetime="event.datetime" class="mt-2 flex items-center text-gray-700">
            <ClockIcon class="mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
            {{ event.time }}
          </time>
        </div>
      </li>
    </ol>
  </div>
</section>


</div>


</template>

<script setup>
import { ref, onMounted } from 'vue'
import { ChevronDownIcon, ChevronLeftIcon, ClockIcon, ChevronRightIcon, EllipsisHorizontalIcon } from '@heroicons/vue/20/solid'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'

const container = ref(null)
const containerNav = ref(null)
const containerOffset = ref(null)


onMounted(() => {
// Set the container scroll position based on the current time.
const currentMinute = new Date().getHours() * 60
container.value.scrollTop =
  ((container.value.scrollHeight - containerNav.value.offsetHeight - containerOffset.value.offsetHeight) *
    currentMinute) /
  1440
})


</script>

<script>
export default {
data() {
  return {
    currentDate: new Date(), // Start from the current date
    weekDates: [],
    events: [],
    weekStart:'',
    weekEnd:'',
    todayIsToday:'',
    currentMonth:'',
    selectedDay: null,
    selectedEvent: [],
    todayEvents: [],


  };
},
computed: {
  eventsToday() {
    return this.events.filter((event) => {
      // Extract only the date part and compare with 'today'
      return event.datetime.substring(0,10) <= this.todayIsToday  && event.enddatetime.substring(0,10) >= this.todayIsToday;
    });
  },

  startDate() {
    return this.weekDates.length > 0 ? this.weekDates[0] : '';
  },
},
created() {
  this.generateWeek();
  this.getData();
},
methods: {
  dateToWords(date) {
    const d = new Date(date);
    return d.toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'short',
      day: '2-digit',
    });
  },
  setSelectedDate(date) {
      if (this.todayIsToday !==  date){
          this.todayEvents.length = 0 ;
          this.selectedEvent.length = null;
          this.setDate = date; // Set the selected date when clicked
          const targetElement = this.$refs.targetDiv;
              if (targetElement) {
              // Smoothly scroll to the referenced element
              targetElement.scrollIntoView({
                  behavior: "smooth", // Smooth scrolling effect
                  // block: "start", // Aligns the start of the target div with the viewport
              });
              }
          this.getDataToday();



      }

  },
  // getDataToday() {

  //     var arr = [];
  //     this.emitter.emit("loadingdata", true);
  //     axios.get(route('holidays.getTodayEvent'), {
  //     params:{
  //         newDate: this.setDate
  //     }
  //     }).then((response) => {
  //         this.holidays = response.data;
  //         console.log(response.data);
  //         response.data.data.forEach((val) => {
  //             arr.push({
  //                 id: val.id,
  //                 description:val.description,
  //                 name: val.name,
  //                 time: val.temptime,
  //                 datetime: val.from_datetime,
  //                 enddatetime: val.to_datetime,
  //                 href: "#",
  //             });
  //         });

  //         this.todayEvents = arr;

  //         console.log(arr);
  //     });
  // },
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
          console.log('dxxxx');
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

  selectEvent(evnt,day) {
      if (this.todayIsToday !==  day){
          this.todayEvents.length = 0 ;
          this.selectedEvent.length = 0 ;
          this.selectedEvent.push(evnt);
          const targetElement = this.$refs.targetDiv;

          if (targetElement) {
              // Scroll smoothly to the target div
              targetElement.scrollIntoView(
                  {
                  behavior: "smooth", // Smooth scrolling
                  // block: "start", // Align to the start of the target div
              }
              );
          }

      }

  },
  calendarViewLayout(layout){
        this.emitter.emit('calendarviewlayout', layout)
      },
  getData()
  {
      var arr= [];
      this.emitter.emit('loadingdata', true);
      axios.get(route('holidays.getWeeklyEvent'), {
          params:{
              startDate:  this.weekStart,
              endDate:  this.weekEnd
          }
         }).then((response)=>{
              this.holidays = response.data
              console.log(response.data)
              response.data.data.forEach((val) => {
                      arr.push({
                          id: val.id,
                          name: val.name,
                          description:val.description,
                          time: val.temptime,
                          datetime: val.from_datetime,
                          enddatetime: val.to_datetime,
                          href: '#' },)
              })

              this.events = arr;
              console.log(arr);
              console.log(this.events);

          });
  },

  generateWeek() {
  this.todayEvents.length = 0 ;


    const startOfWeek = new Date(this.currentDate);
    const dayOfWeek = startOfWeek.getDay();
    const today = new Date();
    this.todayIsToday = today.toISOString().slice(0, 10)


    // Adjust to the start of the week (Sunday)
    startOfWeek.setDate(startOfWeek.getDate() - dayOfWeek);

    // Populate the weekDates array
    this.weekDates = [];
    for (let i = 0; i < 7; i++) {

      const date = new Date(startOfWeek);
      date.setDate(startOfWeek.getDate() + i);


      console.log(date.toISOString().slice(0, 10));
      console.log(today.toISOString().slice(0, 10));
      console.log('sasas');
      var isToday = today.toISOString().slice(0, 10) === date.toISOString().slice(0, 10);

      this.weekDates.push({
        weekDays:this.formatDate(date),
        isToday: isToday,
        isSelected: isToday,
      });

      this.selectedDay = this.weekDates.find((day) => day.isSelected);
      console.log(this.selectedDay);
    console.log('v-v-v-v-v-v-v-v-');

    }
    this.weekStart = this.weekDates[0].weekDays.toLocaleString()
    this.weekEnd = this.weekDates[6].weekDays.toLocaleString()
    const monthYearFormatter = new Intl.DateTimeFormat('en', { year: 'numeric', month: 'long' });
    const dateInwords= new Date (this.weekStart)
    this.currentMonth = monthYearFormatter.format(dateInwords);




  },
  // Format a date as YYYY-MM-DD
  formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  },

  // isToday(date) {
  //   return date === parseInt(this.todayDate.split('-')[2]); // Compare day against today's day
  // },
  previousWeek() {
      this.selectedEvent.length = 0 ;
      this.currentDate.setDate(this.currentDate.getDate() - 7);
      this.generateWeek();
      this.getData();


  },
  nextWeek() {
      this.selectedEvent.length = 0 ;
      this.currentDate.setDate(this.currentDate.getDate() + 7);
      this.generateWeek();
      this.getData();

  },
  todayWeek() {
      this.selectedEvent.length = 0 ;
      this.currentDate = new Date();
      this.generateWeek();
      this.getData();
  }
},

};
</script>
