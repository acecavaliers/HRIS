<template>
    <div>
      <header class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
        <h1 class="text-base font-semibold leading-6 text-gray-900">
          <time :datetime="currentYear">{{ currentYear }}</time>

        </h1>
        <div class="flex items-center">
          <div class="relative flex items-center rounded-md bg-white shadow-sm md:items-stretch">
            <button @click="PreviousYear" type="button" class="flex h-9 w-12 items-center justify-center rounded-l-md border-y border-l border-gray-300 pr-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pr-0 md:hover:bg-gray-50">
              <span class="sr-only">Previous year</span>
              <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
            </button>
            <button  @click="getCurrentYear" type="button" class="hidden border-y border-gray-300 px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus:relative md:block">Today</button>
            <span class="relative -mx-px h-5 w-px bg-gray-300 md:hidden" />
            <button @click="NextYear" type="button" class="flex h-9 w-12 items-center justify-center rounded-r-md border-y border-r border-gray-300 pl-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pl-0 md:hover:bg-gray-50">
              <span class="sr-only">Next year</span>
              <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
            </button>
          </div>
          <div class="hidden md:ml-4 md:flex md:items-center">
            <Menu as="div" class="relative">
              <MenuButton type="button" class="flex items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                Year view
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
      <div class="bg-white">
        <div class="mx-auto grid max-w-3xl grid-cols-1 gap-x-8 gap-y-16 px-4 py-16 sm:grid-cols-2 sm:px-6 xl:max-w-none xl:grid-cols-3 xl:px-8 2xl:grid-cols-4">
          <section v-for="month in months" :key="month.name" class="text-center">
            <h2 class="text-sm font-semibold text-gray-900">{{ month.name }}</h2>
            <div class="mt-6 grid grid-cols-7 text-xs leading-6 text-gray-500">
              <div>S</div>
              <div>M</div>
              <div>T</div>
              <div>W</div>
              <div>T</div>
              <div>F</div>
              <div>S</div>
            </div>
            <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">
                <button v-for="(day, dayIdx) in month.days" :key="day.date" type="button" :class="[day.isCurrentMonth ? 'bg-white text-gray-900' : 'bg-gray-50 text-gray-400', dayIdx === 0 && 'rounded-tl-lg', dayIdx === 6 && 'rounded-tr-lg', dayIdx === month.days.length - 12 && 'rounded-bl-lg', dayIdx === month.days.length - 1 && 'rounded-br-lg', 'py-1.5 hover:bg-gray-100 focus:z-10']">
                    <span v-if="day.events.length > 0" @click="openModal(day.date)"  class="-mx-0.5 mt-auto flex flex-wrap w-full h-full">
                    <time :datetime="day.date" :class="[day.isToday && 'bg-indigo-600 font-semibold text-white', 'mx-auto flex h-7 w-7 items-center justify-center rounded-full']">
                        {{ day.date.split('-').pop().replace(/^0/, '') }}
                    </time>
                        <span  class="mx-2 h-0.5 w-full  bg-purple-400" />
                    </span>
                    <span v-else>
                        <time :datetime="day.date" :class="[day.isToday && 'bg-indigo-600 font-semibold text-white', 'mx-auto flex h-7 w-7 items-center justify-center rounded-full']">
                            {{ day.date.split('-').pop().replace(/^0/, '') }}
                        </time>
                    </span>
                </button>
            </div>
          </section>
        </div>
      </div>
    </div>
    <!-- SHOW SIDE BAR-->
    <div v-if="isModalVisible" ref="EventsModal">
        <div class="fixed inset-0 z-50 overflow-hidden" @click="handleOverlayClick">
            <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
                <div  class="w-screen max-w-md">
                    <div class="h-full flex flex-col py-2 bg-white shadow-xl">
                        <div class="flex items-center justify-between px-6">
                            <h2 class="text-xl font-semibold text-black">Event Details</h2>
                            <button @click="closeModal" class="text-gray-500 hover:text-gray-700">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="mt-2 h-full overflow-auto">
                            <div class="grid grid-cols-1">
                                <div v-if="todayEvents.length > 0" class="py-5 sm:px-6">
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
  import { ChevronDownIcon, ChevronLeftIcon, ChevronRightIcon, ClockIcon, EllipsisHorizontalIcon } from '@heroicons/vue/20/solid'
  import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { faCommentsDollar } from '@fortawesome/free-solid-svg-icons';
</script>



<script>

export default {
    data(){
        return {
            days: [],
            months: [
                { name: 'January' },
                { name: 'February' },
                { name: 'March' },
                { name: 'April' },
                { name: 'May' },
                { name: 'June' },
                { name: 'July' },
                { name: 'August' },
                { name: 'September' },
                { name: 'October' },
                { name: 'November' },
                { name: 'December' }
                ],
            currentMonthinYear: '',
            events: [],
            currentMonthinDigit: 0,
            MonthAndYear: '',
            currentYear:  new Date(),
            isModalVisible: false,
            todayEvents: [],
            setDate: '',
            fullYear:'',
        }
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
        calendarViewLayout(layout){
            this.emitter.emit('calendarviewlayout', layout)
        },

        openModal(date) {

            this.todayEvents.length = 0 ;
            this.setDate = date;
            this.getDataToday();
            this.isModalVisible = true;

        },

        closeModal() {
            this.isModalVisible = false; // Hide the modal
        },
        handleOverlayClick(event) {
            if (event.target === event.currentTarget) {
                this.closeModal();
            }
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

        async fetchAndGenerateMonth() {
            await this.getData();
            this.getYearinYear(this.currentYear);
        },

      async getData() {
            try {
                this.emitter.emit("loadingdata", true);

                // Fetch data from the server using axios
                const response = await axios.get(route('holidays.getlist'), {
                params: {
                    presentMonth: this.fullYear,
                    yr: 'true',
                },
                });

                // Extract and process the data
                const arr = response.data.data.map((val) => ({
                id: val.id,
                description: val.description,
                name: val.name,
                time: val.temptime,
                datetime: val.from_datetime,
                enddatetime: val.to_datetime,
                href: "#",
                }));

                this.holidays = response.data;
                this.events = arr;

                console.log("Data fetched successfully:", arr);
            } catch (error) {
                console.error("Error fetching data:", error);
            } finally {
                this.emitter.emit("loadingdata", false);
            }
        },

        getCurrentYear(){
            const d = new Date()
            const month = this.months
            this.currentYear = d.getFullYear();
            this.currentMonthinYear = month[d.getMonth()]
            this.currentMonthinDigit = d.getMonth()+1;
            this.MonthAndYear = `${this.currentYear}-${this.currentMonthinDigit}`;

            this.fullYear = `${this.currentYear}-01-01`;
            console.log('1st:', this.fullYear);

            this.fetchAndGenerateMonth();

        },

        getYearinYear(year){
            for (let month = 0; month < 12; month++)
                {
                    const validMonth= month + 1;
                    const lastDayOfMonth = new Date(year, month + 1, 0).getDate();
                    const firstDayOfMonth = new Date(year, month, 1).getDay();

                    this.days = [];
                    const today = new Date().toISOString().slice(0, 10);
                    for (let i = 0; i < firstDayOfMonth; i++) {
                            this.days.push({
                                date: '',
                                events: [],
                                isCurrentMonth: false,
                                isToday: false,
                                isSelected: false,
                            });
                            }
                    for (let day = 1; day <= lastDayOfMonth; day++) {
                    const currentDate = `${year}-${String(validMonth).padStart(2, '0')}-${String(day).padStart(2, '0')}`;


                    var arr =[];
                        this.events.forEach((val)=>{
                            // console.log(currentDate);
                            // console.log('DDDDDDDDDD.data');
                            if(currentDate === val.datetime.split(" ")[0])
                            {
                            arr.push(val);
                            }
                        })

                        var isToday = today === currentDate;

                        this.days.push({
                            date: currentDate,
                            events: arr,
                            isCurrentMonth: true,
                            isToday: isToday,
                            isSelected: isToday,
                        });
                    }

                    this.months[month].days = this.days;
                }


                console.log('2nd:', this.months);
        },

        PreviousYear() {
            this.currentYear--;
            this.fullYear = `${this.currentYear}-01-01`;
            console.log('1st:', this.fullYear);
            this.fetchAndGenerateMonth();
        },

        NextYear(){
            this.currentYear++;
            this.fullYear = `${this.currentYear}-01-01`;
            console.log('1st:', this.fullYear);
            this.fetchAndGenerateMonth();
        },


    },

    created() {
        this.getCurrentYear();
        this.fetchAndGenerateMonth();
    },
}


</script>
