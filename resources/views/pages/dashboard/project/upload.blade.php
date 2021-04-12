<x-app-layout title="Project">
    <main class="main-card">    
        <h1 class="text-2xl font-bold mb-4 text-gray-600">Prototype</h1>
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-6">
                <label for="university" class="block text-md font-medium text-gray-700">
                    {{ __('Deskripsi') }}
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <textarea type="text" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"></textarea>
                </div>
            </div>
            <div class="col-span-6 sm:col-span-6 mb-4">
                <label for="university" class="block text-md font-medium text-gray-700">
                    {{ __('Unggah Berkas') }}
                </label>
                <article class="card-upload" aria-label="File Upload Modal" 
                         ondrop="dropHandler(event);" 
                         ondragover="dragOverHandler(event);" 
                         ondragleave="dragLeaveHandler(event);" 
                         ondragenter="dragEnterHandler(event);">

                    <div id="overlay" class="card-upload-overlay">
                        <svg class="overlay-icon fill-current w-12 h-12 mb-3 text-green-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path><path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path></svg>
                        <p class="text-lg text-green-700">{{ __('Drop files to upload') }}</p>
                    </div>

                    <section class="card-upload-body">
                        <label for="hidden-input" class="label-upload-body">
                            <div class="label-upload-head">
                                <span class="font-semibold">{{ __('Tarik dan lepas') }}</span>
                                <span>{{ __('file pada garis kotak') }}</span><br>
                                <p class="font-semibold">{{ __('atau') }}</p>
                            </div>
                            <input id="hidden-input" type="file" multiple class="hidden" />
                            <button id="button" class="button-upload-file">
                                {{ __('Unggah File') }}
                            </button>
                        </label>

                        <ul id="gallery" class="gallery-upload-file">
                            <li id="empty" class="list-upload-file">
                                <img class="mx-auto w-32" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" alt="no data" />
                                <span class="text-small text-gray-500">{{ __('Tidak ada file') }}</span>
                            </li>
                        </ul>
                    </section>
                </article>
            </div>
        </div>


        <footer class="flex justify-end">
            <button id="submit" class="rounded-md px-3 py-1 bg-green-700 hover:bg-green-500 text-white focus:shadow-outline focus:outline-none">
                {{ __('Unggah Sekarang') }}
            </button>
        </footer>
    </main>
  
    <!-- using two similar templates for simplicity in js code -->
    <template id="file-template">
        <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
            <article tabindex="0" class="group w-full h-full rounded-md focus:outline-none focus:shadow-outline elative bg-gray-100 cursor-pointer relative shadow-sm">
                <img alt="upload preview" class="img-preview hidden w-full h-full sticky object-cover rounded-md bg-fixed" />

                <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                    <h1 class="flex-1 group-hover:text-green-800"></h1>
                    <div class="flex">
                        <span class="p-1 group-hover:text-green-800">
                            <i>
                                <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                            </i>
                        </span>
                        <p class="group-hover:text-green-800 p-1 size text-xs text-gray-700"></p>
                        <button class="group-hover:text-green-800 delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md text-gray-800">
                            <svg class="pointer-events-none fill-current w-4 h-4 ml-auto4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path class="pointer-events-none" fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                </section>
            </article>
        </li>
    </template>
  
    <template id="image-template">
        <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
            <article tabindex="0" class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                <img alt="upload preview" class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />

                <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                    <h1 class="flex-1"></h1>
                    <div class="flex">
                        <span class="p-1">
                            <i>
                                <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path class="pointer-events-none" fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                            </i>
                        </span>

                        <p class="p-1 size text-xs"></p>
                        <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md">
                            <svg class="pointer-events-none fill-current w-4 h-4 ml-auto4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path class="pointer-events-none" fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                </section>
            </article>
        </li>
    </template>




    @section('scripts')
        <script>
            const   fileTempl   = document.getElementById("file-template"),
                    imageTempl  = document.getElementById("image-template"),
                    empty       = document.getElementById("empty"),
                    gallery     = document.getElementById("gallery"),
                    overlay     = document.getElementById("overlay"),
                    hidden      = document.getElementById("hidden-input"),
                    hasFiles    = ({ dataTransfer: { types = [] } }) => types.indexOf("Files") > -1;

            let     FILES       = {},
                    counter     = 0;



            function addFile(target, file) {
                const isImage = file.type.match("image.*"),
                    objectURL = URL.createObjectURL(file);

                const clone = isImage
                    ? imageTempl.content.cloneNode(true)
                    : fileTempl.content.cloneNode(true);

                clone.querySelector("h1").textContent = file.name;
                clone.querySelector("li").id = objectURL;
                clone.querySelector(".delete").dataset.target = objectURL;
                clone.querySelector(".size").textContent =
                    file.size > 1024 
                    ? file.size > 1048576 
                    ? Math.round(file.size / 1048576) + "mb"
                    : Math.round(file.size / 1024) + "kb"
                    : file.size + "b";

                isImage && Object.assign(clone.querySelector("img"), {
                    src: objectURL,
                    alt: file.name
                });

                empty.classList.add("hidden");
                target.prepend(clone);

                FILES[objectURL] = file;
            }


            document.getElementById("button").onclick = () => hidden.click();
            hidden.onchange = (e) => {
                for (const file of e.target.files) {
                    addFile(gallery, file);
                }
            };

            function dropHandler(ev) {
                ev.preventDefault();
                for (const file of ev.dataTransfer.files) {
                        addFile(gallery, file);
                        overlay.classList.remove("draggedover");
                        counter = 0;
                    }
            }

            function dragEnterHandler(e) {
                e.preventDefault();
                if (!hasFiles(e)) {
                    return;
                }
                ++counter && overlay.classList.add("draggedover");
            }

            function dragLeaveHandler(e) {
                1 > --counter && overlay.classList.remove("draggedover");
            }

            function dragOverHandler(e) {
                if (hasFiles(e)) {
                    e.preventDefault();
                }
            }

            gallery.onclick = ({ target }) => {
                if (target.classList.contains("delete")) {
                    const ou = target.dataset.target;
                    document.getElementById(ou).remove(ou);
                    gallery.children.length === 1 && empty.classList.remove("hidden");
                    delete FILES[ou];
                }
            };

            document.getElementById("submit").onclick = () => {
                alert(`Submitted Files:\n${JSON.stringify(FILES)}`);
                console.log(FILES);
            };
        </script>
    @endsection
</x-app-layout>
