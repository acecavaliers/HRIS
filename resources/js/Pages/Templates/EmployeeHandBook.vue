<template>
    <MasterLayout>
      <h6 class="text-2xl font-bold mb-7">EMPLOYEES HANDBOOK</h6>
      <div class="flex grid-cols-2 gap-4">
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 ml-6 text-gray-900 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input
            id="searchbar"
            type="text"
            name="search"
            placeholder="Content Search"
            class="block shadow-xl  min-w-[300px] p-4 pl-10 ml-6 text-sm text-black border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
            @keyup="searchContent"
        />
    </div>
    <div class=" ml- text-gray-500 subpixel-antialiased font-Abhaya_Libre text-base">

       <span>
        The Following policies have been created
         as guidelines to define the company
         culture employees are expected to uphold.
       </span>
    </div>
</div>

      <div class="w-full h-[800px] grid-cols-3 p-4">

        <div class="flex flex-row gap-4 p-2 h-full">
          <div class="container shadow-xl shadow-gray-700/50 w-1/3 max-h-screen bg-white border p-4 rounded-md overflow-hidden border-gray-600">
            <div class="mb-3">Click to select Policies</div>
            <div class="border border-gray-600 p-4 gap-3 bg-gray-200 h-[610px] overflow-y-auto">
              <ul id="List">
                <div class="grid grid-cols-1" v-for="event in events" :key="event.id">
                  <button class="Words btn-employee mb-2" @click="showFile(event.file_path)">{{ event.title }}</button>
                </div>
              </ul>
            </div>
          </div>

          <div class="w-full border border-gray-700 max-h-screen mt-6 bg-white text-gray-600 p-4 overflow-y-auto rounded-md shadow-gray-700" >
            <vue-pdf-app :pdf="pdfSrc" :config="config3" width="100%" height="500" frameborder="0"/>
          </div>
        </div>
      </div>
        <!-- Drawer -->
            <transition name="slide" mode="out-in">
            <div v-if="drawerOpen" class="absolute  mt-80 inset-y-0 right-0 w-64  h-screen bg-white shadow z-50">
                <div class="p-4">
              <div class=" flex grid-cols-2 gap-12">
                <h1 class="text-l font-semibold">Toolbar Configuration</h1>
                <button @click="toggleDrawer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                </svg>
                </button>
              </div>

                <!-- First Toolbar Drawer -->
            <br>
            <p class="border border-t-4">Right Toolbar</p>
            <br>
            <div class="grid grid-rows-2">
            <label>
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerRight.presentationMode">
             presentationMode
            </label>
            <label>
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerRight.openFile">
            openfile
            </label>
            <label>
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerRight.print">
                print
            </label>
            <label>
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerRight.viewBookmark">
                viewbookmark
            </label>

            <label>
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerRight.download">
             download
            </label>

           <div>
            <br>
            <p class="border border-t-4">Left Toolbar</p>
            <br>
           </div>

            <label >
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerLeft.next">
             next
            </label>
            <label>
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerLeft.previous">
             previous
            </label>
            <label>
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerLeft.pageNumber">
             pagenumber
            </label>
            <label>
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerLeft.findbar">
             findbar
            </label>

            <div>
            <br>
            <p class="border border-t-4">Left Toolbar</p>
            <br>
           </div>

            <label>
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerMiddle.zoomIn">
             zoom in
            </label>
            <label>
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerMiddle.zoomOut">
             zoom out
            </label>
            <label>
            <input type="checkbox" v-model="config3.toolbar.toolbarViewerMiddle.scaleSelectContainer">
             scale select container
            </label>
        <div>
        <br>
        <button @click="secondDrawer" class="block border border-black mx-auto bg-transparent text-black font-bold py-2 px-4 rounded">
        Secondary Toolbar
        </button>
        </div>
            </div>
            </div>
            </div>
               <!-- Main content Toolbar -->
            <button v-else @click="toggleDrawer" class="absolute mt-96 inset-y-0 right-0  w-7 bg-white shadow z-50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
            </svg>
            </button>
            </transition>
            <transition name="slide" mode="out-in">
                <div v-if="secondDrawerOpen" class="absolute  mt-80 inset-y-0 right-0 w-64  h-screen bg-white shadow z-50">
                <div class="p-4">
              <div class=" flex grid-cols-2 gap-12">
                <h1 class="text-l font-semibold">Second Toolbar Configuration</h1>
                <button @click="secondDrawer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                </svg>
                </button>
            </div>
                <!-- Secondary Toolbar -->

               <div class="grid grid-rows-2">
                <br>
                <p class="border border-t-4">Secondary Toolbar Left</p>
                <br>
                <label>
                    <input type="checkbox" v-model="config3.sidebar.viewThumbnail">
                    view thumbnail
                </label>
                <label>
                    <input type="checkbox" v-model="config3.sidebar.viewOutline">
                    view outline
                </label>
                <label>
                    <input type="checkbox" v-model="config3.sidebar.viewAttachments">
                    view attachments
                </label>

                <br>
                <p class="border border-t-4">Secondary Toolbar Right</p>
                <br>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.secondaryPresentationMode">
                   Secondary Presentation
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.secondaryOpenFile">
                  Secondary Openfile
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.secondaryPrint">
                    Secondary Print
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.secondaryDownload">
                    Secondary Download
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.secondaryViewBookmark">
                    Secondary ViewBookmark
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.firstPage">
                    Secondary Firstpage
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.lastPage">
                    Secondary Lastpage
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.pageRotateCw">
                    pagerotatecw
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.pageRotateCcw">
                    pagerotateccw
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.cursorSelectTool">
                    cursor select tool
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.cursorHandTool">
                    cursor handtool
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.scrollVertical">
                    scroll vertical
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.scrollHorizontal">
                    scroll horizontal
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.scrollWrapped">
                    scroll wrapped
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.spreadNone">
                    spread none
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.spreadOdd">
                    spread odd
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.spreadEven">
                    spread even
                </label>
                <label>
                    <input type="checkbox" v-model="config3.secondaryToolbar.documentProperties">
                    document properties
                </label>
               </div>
            </div>
            </div>
            </transition>

    </MasterLayout>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'
  import MasterLayout from '@/Layouts/MasterLayout.vue'
  import VuePdfApp from "vue3-pdf-app";
  import "vue3-pdf-app/dist/icons/main.css";

//   let pdfSrc = ref('')

//  function showFile(event){
//         let url = event;
//         let substringToRemove = 'public/handbooks';
//         let newUrl = url.replace(substringToRemove, '');
//         this.pdfSrc = '/storage/handbooks' + newUrl + '#toolbar=0';
//         console.log(this.pdfSrc)

//         }


  let selectedEventDescription = ref('')
  let events = ref([]) // Define events as a reactive variable

  function searchContent() {
    let input = document.getElementById('searchbar').value.toLowerCase()
    let x = document.getElementsByClassName('Words btn-employee')

    for (let i = 0; i < x.length; i++) {
      if (!x[i].innerHTML.toLowerCase().includes(input)) {
        x[i].style.display = 'none'
      } else {
        x[i].style.display = 'block'
      }
    }
  }

// //   function showContent(event) {
// //     selectedEventDescription.value = event.file_path
// //   }

   onMounted(() => {
   showdata() // Fetch data when the component is mounted
  })

  async function showdata() {
    try {
      const response = await axios.get(route('employeehandbooks.getlist'))
      const arr = response.data.data.map(val => ({ id: val.id, title: val.title, file_path: val.file_path }))
      events.value = arr
      if (arr.length > 0) {
        showContent(arr[0]) // Automatically show the first event
      }
    } catch (error) {
      console.error('Error fetching data:', error)
    }
  }



  </script>

  <script>
  import axios from 'axios'


  export default {
    data() {
      return {
        drawerOpen: false,
        secondDrawerOpen: false,
        holidays: [],
        events: [],
        pdfSrc: '',
        config3: {
            toolbar: false,
            sidebar: {
    viewThumbnail: false,
    viewOutline: false,
    viewAttachments: false,
  },
  secondaryToolbar: {
    secondaryPresentationMode: false,
    secondaryOpenFile: false,
    secondaryPrint: false,
    secondaryDownload: false,
    secondaryViewBookmark: false,
    firstPage: false,
    lastPage: false,
    pageRotateCw: false,
    pageRotateCcw: false,
    cursorSelectTool: false,
    cursorHandTool: false,
    scrollVertical: false,
    scrollHorizontal: false,
    scrollWrapped: false,
    spreadNone: false,
    spreadOdd: false,
    spreadEven: false,
    documentProperties: false,
  },
    toolbar: {
    toolbarViewerRight: {
      presentationMode: false,
      openFile: false,
      print: false,
      download: false,
      viewBookmark: false,
  },
  toolbarViewerLeft:
  {
      findbar: false,
      previous: false,
      next: false,
      pageNumber: false,
    },
    toolbarViewerMiddle: {
      zoomOut: false,
      zoomIn: false,
      scaleSelectContainer: false,
    },
        }
      },

      }
    },

    methods: {
        toggleDrawer() {
      this.drawerOpen = !this.drawerOpen;
    },
        secondDrawer(){
            this.secondDrawerOpen = !this.secondDrawerOpen;
        },


    showFile(event){
        let pdfSrc = ref('')
        let url = event;
        let substringToRemove = 'public/handbooks';
        let newUrl = url.replace(substringToRemove, '');
        this.pdfSrc = '/storage/handbooks' + newUrl;
        console.log(this.pdfSrc)

        },
        mounted() {
        // Set the source of the PDF to the public URL
        this.pdfSrc = '/storage/008-002-relations (1).pdf';

    },

      getData() {
        var arr = []
        this.emitter.emit('loadingdata', true)
        axios.get(route('employeehandbooks.getlist')).then((response) => {
          this.employeehandbooks = response.data
          console.log(response.data.data)
          response.data.data.forEach((val) => {
            arr.push({ id: val.id, title: val.title, file_path: val.file_path })
          })

          this.events = arr
          console.log(arr)
        })
      }


    },

    created() {
      this.getData()
    }
  }
  </script>

<style>
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.3s ease;
}

.slide-enter-from,
.slide-leave-to {
  transform: translateX(100%);
}

.toolbar-container {
  z-index: 49; /* Adjust as needed */
}
</style>
