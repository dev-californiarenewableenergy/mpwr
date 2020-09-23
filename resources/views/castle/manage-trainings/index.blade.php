<x-app.auth :title="__('Training')">
  <div>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div class="px-4 py-5 sm:px-6">
        <div class="md:flex justify-between">
          <div class="md:flex justify-start">
            <h3 class="text-lg text-gray-900">Manage Trainings</h3>
          </div>
          <div class="flex md:justify-end sm:justify-start">
            <div class="pt-2 relative md:mx-auto sm:mx-0 text-gray-600">
              @if(user()->isMaster())
                <div class="inline-flex" x-data="{ 'showSectionModal': false }" @keydown.escape="showSectionModal = false" x-cloak>
                  <x-button @click="showSectionModal = true">
                    Add Section
                  </x-button>
                  <div x-show="showSectionModal" wire:loading.remove class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center z-20">
                    <div x-show="showSectionModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity">
                      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <div x-show="showSectionModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                      <div class="absolute top-0 right-0 pt-4 pr-4">
                        <button type="button" x-on:click="showSectionModal = false; setTimeout(() => open = true, 1000)" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150" aria-label="Close">
                          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                          </svg>
                        </button>
                      </div>
                      <div class="px-4 py-5 sm:p-6">
                        <div class="flex justify-between">
                          <div class="flex justify-start">
                            <div class="flex-grid items-center">
                              <h3>Add a new section to {{$actualSection->title}}</h3>
                              <x-form class="mt-8 inline-flex" :route="route('castle.manage-trainings.storeSection', $actualSection->id)">
                                <x-input label="Title" name="title" type="text"></x-input>
                                <div class="mt-6">
                                  <span class="block w-full rounded-md shadow-sm">
                                    <x-button class="w-full flex ml-4" type="submit" color="green">
                                        {{ __('Save') }}
                                    </x-button>
                                  </span>
                                </div>
                              </x-form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @if(!$content)
                  <div class="inline-flex" x-data="{ 'showContentModal': false }" @keydown.escape="showContentModal = false" x-cloak>
                    <x-button @click="showContentModal = true">
                      Add Content
                    </x-button>
                    <div x-show="showContentModal" wire:loading.remove class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center z-20">
                      <div x-show="showContentModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                      </div>
                      <div x-show="showContentModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                        <div class="absolute top-0 right-0 pt-4 pr-4">
                          <button type="button" x-on:click="showContentModal = false; setTimeout(() => open = true, 1000)" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150" aria-label="Close">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                          </button>
                        </div>
                        <div class="sm:p-6">
                          <div class="flex justify-between">
                            <div class="flex justify-start">
                              <div class="inline-grid items-center">
                                <h3>Add a new content to {{$actualSection->title}}</h3>
                                <x-form :route="route('castle.manage-trainings.storeContent', $actualSection->id)">
                                  <div class="grid grid-cols-2 mt-8 gap-2">
                                    <x-input class="col-span-1" label="Title" name="content_title"></x-input>
                                    <x-input class="col-span-1" label="Video Url" name="video_url"></x-input>
                                    <x-text-area class="col-span-2" label="Description" name="description"></x-text-area>
                                  </div>
                                  <div class="mt-6">
                                    <span class="block w-full rounded-md shadow-sm">
                                      <x-button class="w-full flex" type="submit" color="green">
                                          {{ __('Save') }}
                                      </x-button>
                                    </span>
                                  </div>
                                </x-form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
                @if($content)
                  <div class="inline-flex" x-data="{ 'showContentModal':false }" x-on:keydown.escape="alert($event.target.value)"  @keydown.escape="showContentModal = false" x-cloak>
                    <x-button @click="showContentModal = true">
                      Edit Content
                    </x-button>
                    
                    <div x-show="showContentModal" wire:loading.remove class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center z-20">
                      <div x-show="showContentModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                      </div>
                      <div x-show="showContentModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                        <div class="absolute top-0 right-0 pt-4 pr-4">
                          <button type="button" x-on:click="showContentModal = false; setTimeout(() => open = true, 1000)" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150" aria-label="Close">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                          </button>
                        </div>
                        <div class="sm:p-6">
                          <div class="flex justify-between">
                            <div class="flex justify-start">
                              <div class="inline-grid items-center">
                                <h3>Edit the content to {{$actualSection->title}}</h3>
                                <x-form :route="route('castle.manage-trainings.updateContent', $content->id)">
                                  <div class="grid grid-cols-2 mt-8 gap-2">
                                    <x-input class="col-span-1" label="Title" name="content_title" value="{{$content->title}}"></x-input>
                                    <x-input class="col-span-1" label="Video Url" name="video_url" value="{{$content->video_url}}"></x-input>
                                    <x-text-area class="col-span-2" label="Description" name="description" value="{{$content->description}}"></x-text-area>
                                  </div>
                                  <div class="mt-6">
                                    <span class="block w-full rounded-md shadow-sm">
                                      <x-button class="w-full flex" type="submit" color="green">
                                          {{ __('Save') }}
                                      </x-button>
                                    </span>
                                  </div>
                                </x-form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              @endif
            </div>
          </div>
        </div>
        <div class="text-gray-600 mt-6 md:mt-3 inline-flex items-center">
          @foreach($path as $pathSection)
            <a href="/castle/manage-trainings/list/{{$pathSection->id}}" class="underline align-baseline">{{$pathSection->title}}</a> / 
          @endforeach
          @if(user()->isMaster())
            <div class="inline-flex" x-data="{ 'editSectionModal': false }" @keydown.escape="editSectionModal = false" x-cloak>
              <button class="ml-4 p-3 rounded-full hover:bg-gray-200" @click="editSectionModal = true">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M18.363 8.464l1.433 1.431-12.67 12.669-7.125 1.436 1.439-7.127 12.665-12.668 1.431 1.431-12.255 12.224-.726 3.584 3.584-.723 12.224-12.257zm-.056-8.464l-2.815 2.817 5.691 5.692 2.817-2.821-5.693-5.688zm-12.318 18.718l11.313-11.316-.705-.707-11.313 11.314.705.709z"/></svg>
              </button>
              <div x-show="editSectionModal" wire:loading.remove class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center z-20">
                <div x-show="editSectionModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity">
                  <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div x-show="editSectionModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                  <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button type="button" x-on:click="editSectionModal = false; setTimeout(() => open = true, 1000)" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150" aria-label="Close">
                      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                  <div class="px-4 py-5 sm:p-6">
                    <div class="flex justify-between">
                      <div class="flex justify-start">
                        <div class="flex-grid items-center">
                          <h3>Edit the section {{$actualSection->title}}</h3>
                          <x-form class="mt-8 inline-flex" :route="route('castle.manage-trainings.updateSection', $actualSection->id)" put>
                            <x-input label="Title" name="title" type="text" value="{{$actualSection->title}}"></x-input>
                            <div class="mt-6">
                              <span class="block w-full rounded-md shadow-sm">
                                <x-button class="w-full flex ml-4" type="submit" color="green">
                                    {{ __('Save') }}
                                </x-button>
                              </span>
                            </div>
                          </x-form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
        <div class="mt-15">
          <div class="mt-2 p-4 text-lg">
            @if($videoId)
              <div class="w-full text-center embed-container">
                <iframe class="lg:float-right self-center ml-4" src="https://www.youtube.com/embed/{{$videoId}}" frameborder='0' height="290" width="500" allowfullscreen></iframe>
              </div>
            @endif
            
            @if($content && $content->title)
              <div class="mt-3 text-xl font-semibold">
                {{$content->title}}
              </div>
              {!!$content->description!!}
            @endif
                </div>
          <div class="md:grid-cols-2 sm:grid-cols-1 md:row-gap-4 sm:row-gap-0 col-gap-4 inline-grid w-full mt-4">
            @foreach($sections as $section)
              <div class="col-span-1 ">
                <div class="grid grid-cols-10">
                  <div class="inline-flex hover:bg-gray-50 text-center md:border-2 border-t-2 md:border-r-0 md:rounded-l-lg " x-data="{ 'confirmDeleteModal': false }" @keydown.escape="confirmDeleteModal = false" x-cloak>
                    <button class="w-full text-center h-full py-2 px-2"  @click="confirmDeleteModal = true">
                    <div class="text-center">
                      <svg class="inline-flex" fill="red" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M9 19c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5-17v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712zm-3 4v16h-14v-16h-2v18h18v-18h-2z"/></svg>
                    </div>
                    </button>
                    <div x-show="confirmDeleteModal" wire:loading.remove class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center z-20">
                      <div x-show="confirmDeleteModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                      </div>
                      <div x-show="confirmDeleteModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                        <div class="absolute top-0 right-0 pt-4 pr-4">
                          <button type="button" x-on:click="confirmDeleteModal = false; setTimeout(() => open = true, 1000)" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150" aria-label="Close">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                          </button>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                          <h3 class="text-left">Do you want to delete {{$section->title}} section?</h3>
                          <p class="text-left mt-4 text-base text-gray-700">If you delete this section all content into {{$section->title}} will be pass to {{$actualSection->title}}</p>
                          <div class="mr-4 mb-4 inline-flex space-x-4 float-right mt-8">
                            <x-button class="w-full flex ml-4" @click="confirmDeleteModal = false">
                              {{ __('No') }}
                            </x-button>
                            <x-form :route="route('castle.manage-trainings.deleteSection', $section->id)"  delete
                                                            x-data="{deleting: false}">                            
                              <x-button class="w-full flex ml-4" type="submit" color="green">
                                {{ __('Yes') }}
                              </x-button>
                            </x-form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-9 hover:bg-gray-50">
                    <a href="{{route('castle.manage-trainings.index', $section->id)}}">
                      <div class="grid grid-cols-10 row-gap-4 col-gap-4 border-gray-200 md:border-2 border-t-2 p-4 md:rounded-r-lg ">
                        <div class="col-span-9 inline-flex">
                          <p class="self-center">{{$section->title}}</p>
                        </div>
                        <div class="col-span-1 self-center">
                          <x-svg.chevron-right class="w-7 text-gray-500"/>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app.auth>