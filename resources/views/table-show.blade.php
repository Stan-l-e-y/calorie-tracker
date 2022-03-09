<x-app-layout >
    <x-slot name="table">
        <style type="text/css">
            /* .tg  {border-collapse:collapse;border-spacing:0;} */
            .tg td{border-color:black;border-style:solid;border-width:1px;
              overflow:hidden;padding:10px 5px;word-break:normal;}
            .tg th{border-color:black;border-style:solid;border-width:1px;overflow:hidden;padding:10px 5px;word-break:normal;}
            .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
            .tg .tg-0lax{text-align:left;vertical-align:top}
            </style>

            
            <h1 
            class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"
            >
            Month
            @if (isset($_GET['page']))
              {{ $_GET['page'] }}
            @else
            {{ '1' }}
            @endif
            </h1>  
            @php
              if(isset($_GET['page'])){
                $pageNum = $_GET['page'];
              } else{
                $pageNum = 1;
              }
              $secondNum = $pageNum - 1;
              $week = $pageNum + (3 * $secondNum);
            @endphp

            <div class="flex" id="app" >
              <table class="tg border-collapse relative border rounded-xl ">
              <thead class="">
                <tr>
                  <th class="tg-0lax"></th>
                  <th class="px-6 py-3  font-bold tracking-wider ">Day 1 </th>
                  <th class=" px-6 py-3 font-bold   tracking-wider">Day 2</th>
                  <th class=" px-6 py-3  font-bold   tracking-wider">Day 3</th>
                  <th class="t px-6 py-3  font-bold   tracking-wider">Day 4</th>
                  <th class=" px-6 py-3 font-bold   tracking-wider">Day 5</th>
                  <th class=" px-6 py-3  font-bold   tracking-wider">Day 6</th>
                  <th class=" px-6 py-3  font-bold   tracking-wider">Day 7</th>
                  <th class=" ">Weekly Info</th>
                </tr>
              </thead>
              <tbody >
                <tr class="">
                  <td class="font-bold">Week {{ $week }}</td>
                  @for ($x = 0; $x <= 6; $x++)
                  {{--  If entry is made, whether null/default or user created... Display grey+ icon or user data --}}
                  @if (!empty($days[$x]))
                  <td class="">
                    <div class=" cursor-pointer hover:text-blue-500">
                      <div class="mb-2">
                        @if ( !empty($weight[$x]) && !empty($calories[$x]))
                          <day-view :weight="{{ $weight[$x] }}" :calories="{{ $calories[$x] }}" time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                          </day-view>  
                        @elseif (!empty($weight[$x]))
                        <day-view :weight="{{ $weight[$x] }}"  time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                        </day-view>  
                        @elseif (!empty($calories[$x]))
                        <day-view :calories="{{ $calories[$x] }}" time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                        </day-view>  
                        @else
                        <div class=" flex justify-center ">
                          <day-view :grey="true"  time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                          </day-view>
                        </div> 
                        @endif
                  
                      </div>
                    </div>
                  </td>
                  {{--  If previous is not empty and todays entry is ... display green+ icon --}}
                  @elseif(!empty($days[$x -1 ])  && empty($todaysEntry[0]))
                  <td class="">
                    <div class=" flex justify-center " >

                      <app  :user_id="{{ auth()->id() }}" @reload="" class="cursor-pointer"></app>
                    </div>
                  </td>
                  @elseif($x == 0 && empty($days[$x]) && empty($todaysEntry[0]))
                  <td class="">
                    <div class=" flex justify-center " >
                      
                      <app :user_id="{{ auth()->id() }}" @reload="" class="cursor-pointer"></app>
                    </div>
                  </td>
                  @else
                  <td class="">
                    <div class=" flex justify-center "></div>
                  </td>
                  @endif
                  @endfor
                  {{-- Weekly info --}}
                  <td class="">
                    <div class="flex flex-col py-2 cursor-pointer hover:text-blue-500">
                      <div class="mb-2">
                        @if(!empty($avgWeight[$week - 1]))
                        Avg W : {{ ceil($avgWeight[$week - 1]->avg()) }}
                        @endif
                      </div>
                      <div>
                        @if (!empty($avgCal[0]))
                        Avg C : {{ ceil($avgCal[0]->avg()) }}
                        @endif
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="font-bold">Week {{ $week + 1}}</td>
                  @for ($x = 7; $x <= 13; $x++)
                  @if (!empty($days[$x]))
                  <td class=" ">

                    <div class="cursor-pointer hover:text-blue-500">
                      <div class="mb-2">

                        @if ( !empty($weight[$x]) && !empty($calories[$x]))
                          <day-view :weight="{{ $weight[$x] }}" :calories="{{ $calories[$x] }}" time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                          </day-view>  
                        @elseif (!empty($weight[$x]))
                        <day-view :weight="{{ $weight[$x] }}"  time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                        </day-view>  
                        @elseif (!empty($calories[$x]))
                        <day-view :calories="{{ $calories[$x] }}" time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                        </day-view>  
                        @else
                        <div class=" flex justify-center ">
                          <day-view :grey="true"  time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                          </day-view>
                        </div>
                        @endif
                      </div>

                    </div>
                  </td>
                  @elseif(!empty($days[$x -1 ]) && empty($todaysEntry[0]))
                  <td class="">
                    <div class=" flex justify-center " >
                      
                      <app :user_id="{{ auth()->id() }}" class="cursor-pointer"></app>
                    </div>
                  </td>
                  @else
                  <td class="">
                    <div class=" flex justify-center " >

                    </div>
                  </td>
                  @endif
                  @endfor
                  <td class="">
                    <div class="flex flex-col py-2 cursor-pointer hover:text-blue-500">
                      <div class="mb-2">
                        @if(!empty($avgWeight[$week]))
                        Avg W : {{ ceil($avgWeight[$week]->avg()) }}
                        @endif
                      </div>
                      <div>
                        @if (!empty($avgCal[1]))
                        Avg C : {{ ceil($avgCal[1]->avg()) }}
                        @endif
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="font-bold">Week {{ $week + 2}}</td>
                  @for ($x = 14; $x <= 20; $x++)
                  @if (!empty($days[$x]))
                  <td class=" ">
                    <div class="flex flex-col py-2 cursor-pointer hover:text-blue-500">
                      <div class="mb-2">
                        @if ( !empty($weight[$x]) && !empty($calories[$x]))
                          <day-view :weight="{{ $weight[$x] }}" :calories="{{ $calories[$x] }}" time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                          </day-view>  
                        @elseif (!empty($weight[$x]))
                        <day-view :weight="{{ $weight[$x] }}"  time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                        </day-view>  
                        @elseif (!empty($calories[$x]))
                        <day-view :calories="{{ $calories[$x] }}" time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                        </day-view>  
                        @else
                        <div class=" flex justify-center ">
                          <day-view :grey="true"  time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                          </day-view>
                        </div>
                        @endif
                      </div>

                    </div>
                  </td>
                  @elseif(!empty($days[$x -1 ]) && empty($todaysEntry[0]))
                  <td class="">
                    <div class=" flex justify-center " >
                      
                      <app :user_id="{{ auth()->id() }}" class="cursor-pointer"></app>
                    </div>
                  </td>
                  @else
                  <td class="">
                    <div class=" flex justify-center "></div>
                  </td>
                  @endif
                  @endfor
                  <td class="">
                    <div class="flex flex-col py-2 cursor-pointer hover:text-blue-500">
                      <div class="mb-2">
                        @if(!empty($avgWeight[$week + 1]))
                        Avg W : {{ ceil($avgWeight[$week + 1]->avg()) }}
                        @endif
                      </div>
                      <div>
                        @if (!empty($avgCal[2]))
                        Avg C : {{ ceil($avgCal[2]->avg()) }}
                        @endif
                      </div>
                    </div>
                  </td>
                </tr>
                <tr class="">
                  <td class="font-bold">Week {{ $week + 3}}</td>
                  @for ($x = 21; $x <= 27; $x++)
                  @if (!empty($days[$x]))
                  <td class=" ">
                    <div class="flex flex-col py-2 cursor-pointer hover:text-blue-500">
                      <div class="mb-2">
                        @if ( !empty($weight[$x]) && !empty($calories[$x]))
                          <day-view :weight="{{ $weight[$x] }}" :calories="{{ $calories[$x] }}" time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                          </day-view>  
                        @elseif (!empty($weight[$x]))
                        <day-view :weight="{{ $weight[$x] }}"  time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                        </day-view>  
                        @elseif (!empty($calories[$x]))
                        <day-view :calories="{{ $calories[$x] }}" time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                        </day-view>  
                        @else
                        <div class=" flex justify-center ">
                          <day-view :grey="true"  time="{{ $createdTime[$x] }}" :id="{{ $id[$x] }}" >
                          </day-view>
                        </div>
                        @endif
                      </div>

                    </div>
                  </td>
                  @elseif(!empty($days[$x -1 ]) && empty($todaysEntry[0]))
                  <td class="">
                    <div class=" flex justify-center " >
                      
                      <app :user_id="{{ auth()->id() }}" class="cursor-pointer"></app>
                    </div>
                  </td>
                  @else
                  <td class="">
                    <div class=" flex justify-center "></div>
                  </td>
                  @endif
                  @endfor
                  <td class="">
                    <div class="flex flex-col py-2 cursor-pointer hover:text-blue-500">
                      <div class="mb-2">
                        @if(!empty($avgWeight[$week + 2]))
                        Avg W : {{ ceil($avgWeight[$week + 2]->avg()) }}
                        @endif
                      </div>
                      <div>
                        @if (!empty($avgCal[3]))
                        Avg C : {{ ceil($avgCal[3]->avg()) }}
                        @endif
                      </div>
                    </div>
                  </td>

                </tr>
      
              

              </tbody>
              </table>
              {{-- Difference between weeks based off of weekly average  --}}
              <div class=" flex relative left-5 ">
                <div class="absolute top-20">
                  @php
                    if ($pageNum != 1  && !empty($avgWeight[$week - 2]) && !empty($avgWeight[$week - 1])){
                      echo $avgWeight[$week - 1]->avg() - $avgWeight[$week - 2]->avg();
                    }                
                  @endphp   
                </div>
                <div class="absolute top-44">
                  @if (!empty($avgWeight[$week - 1]) && !empty($avgWeight[$week]))
                  {{  $avgWeight[$week]->avg() - $avgWeight[$week - 1]->avg() }}
                  @endif
                </div>
                <div class="absolute top-70">
                  @if (!empty($avgWeight[$week]) && !empty($avgWeight[$week + 1]))
                  {{ $avgWeight[$week + 1]->avg() - $avgWeight[$week]->avg() }}
                  @endif
                </div>
                <div class="absolute top-90">
                  @if (!empty($avgWeight[$week + 1]) && !empty($avgWeight[$week + 2]))
                  {{ number_format((float)$avgWeight[$week + 2]->avg() - $avgWeight[$week + 1]->avg(), 2, '.', '') }}
                  @endif
                </div>
              </div>
            </div>
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">{{ $links->links() }}</div>
            
    </x-slot>

</x-app-layout>