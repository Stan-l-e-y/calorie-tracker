<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
    </x-slot> --}}

      <h1 class=" mt-5 text-3xl text-center font-bold text-blue-500">Frequently Asked Questions</h1>
      <div x-data="{
        faqs: [
            {
                id: 1,
                question: 'What is this site?',
                answer: 'This is Fitness Tracker! The purpose for this site is for you, the user, to track your daily weight and caloric intake with the built in Table. The Table allows you to make one entry per day, simply enter your weight and caloric intake for the day (optional) and the table will store the information for as long as you need it. You are only allowed to make an entry for the current day; therefore, you will not be able to cheat and enter future data. If you made a mistake in the past or need to check when you made a specific entry, hover over the selected entry and click on it to view/edit your information. To get started, navigate to the Table tab in the navigation bar above ',
                isOpen: false,
                color600: 'bg-blue-600',
                color300: 'bg-blue-300'
            },
            {
                id: 2,
                question: 'What if I miss a day?',
                answer: 'No need to worry! If you have not made an entry by 11:50PM (23:50) your local time, the site will automatically make a blank entry for you. Whenever you visit the site again you will see this blank entry distinguished by a grey plus icon. Simply click on it and enter the missing data',
                isOpen: false,
                color600: 'bg-pink-600',
                color300: 'bg-pink-300'
            },
            {
                id: 3,
                question: 'Will I get any feedback from the data?',
                answer: 'Yes! After you have entered at least one full week of data, the site will take the weight averages of each week and subtract them to show you how much you have lost/gained for that week. The results will be displayed to the right of the table ',
                isOpen: false,
                color600: 'bg-green-600',
                color300: 'bg-green-300'
            }
        ]
    }"
       
      class="w-10/12 md:w-7/12 lg:6/12 mx-auto relative py-20">
        <template x-for="faq in faqs" :key="faq.id">
            <div   class="border-l-2 mt-10">
              <!-- Card  -->
              <div @click="faq.isOpen = !faq.isOpen"  class="transform transition cursor-pointer hover:-translate-y-2 ml-10 relative flex items-center px-6 py-4  text-white rounded mb-10 flex-col md:flex-row space-y-4 md:space-y-0" :class="faq.color600">
                <!-- Dot Follwing the Left Vertical Line -->
                <div class="w-5 h-5 absolute -left-10 transform -translate-x-2/4 rounded-full z-10 mt-2 md:mt-0" :class="faq.color600"></div>
                <!-- Line that connecting the box with the vertical line -->
                <div class="w-10 h-1 absolute -left-10 z-0" :class="faq.color300"></div>
                <!-- Content that showing in the box -->
                <div class="flex-auto">
                  <h1 x-text="faq.question" class="text-xl font-bold"></h1>
                  <h3 class="mt-5" x-show="faq.isOpen" x-text="faq.answer" ></h3>
                </div>
              </div>
            </div>
        </template>
    </div>
    
</x-app-layout>
