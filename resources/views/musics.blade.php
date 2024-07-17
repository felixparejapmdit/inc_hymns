<!-- resources/views/musics.blade.php -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery before Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    body {
  background: linear-gradient(to bottom, #5eb8d3, #4975b4);
}

</style>
<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center my-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('INC Hymn List') }} 
            @if($churchHymn)
                - <span style="color: #1b8fc4;">{{ $churchHymn->name === 'EM' ? 'Evangelical Mission' : $churchHymn->name }}</span>
            @endif
        </h2>
        <div>

        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
        <button id="addMusicButton" class="btn btn-primary mb-0" style="display: {{ \App\Helpers\AccessRightsHelper::checkPermission('musics.create') }}">
            <i class="fas fa-plus"></i>
            <span> Music</span>
        </button>
        

       
        </div>
    </div>
    
    </x-slot>

    <div class="py-12">
      
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

       <!-- Add context menu container -->
       <div id="contextMenu" class="hidden bg-white shadow-md p-4 rounded">
            <h3 class="text-lg font-medium mb-2">Playlists</h3>
            <ul id="playlistOptions" class="list-unstyled mb-2">
                <!-- Playlist options will be populated here -->
            </ul>
            <button id="createPlaylistButton" class="btn btn-primary">Create New Playlist</button>
        </div>

    <script>
        // Add event listener to the addMusicButton
        document.getElementById('addMusicButton').addEventListener('click', function() {
            // Redirect to the music.create route (adjust the URL as needed)
            window.location.href = '{{ route("musics.create") }}';
        });
    </script>
    
    <!-- Dark overlay -->
    <div id="overlay" class="fixed top-0 left-0 w-screen h-screen bg-black bg-opacity-50 z-50 hidden"></div>

        <!-- Search Input and Tabs -->
        <form action="{{ route('musics.index') }}" method="GET" class="mt-4 mb-4" >
            <div class="flex items-center justify-between mb-4">
                <form id="searchForm" method="GET" action="{{ route('musics.index') }}" class="mt-4 mb-4">
                    <input type="hidden" name="church_hymn_id" value="{{ request()->input('church_hymn_id') }}">
                    <input type="hidden" name="language_id" value="{{ request()->input('language_id') }}">
                    <input type="text" id="searchInput" name="query" class="form-control rounded-md" value="{{ request('query') }}" placeholder="Search hymns..." onkeypress="handleEnterKey(event)">
                     <!-- <input type="text" id="searchInput" name="query" class="form-control rounded-md" value="{{ request('query') }}" placeholder="Search hymns..."> -->
        
<!-- Language Dropdown -->
<select name="language_id" id="languageDropdown" class="rounded-md" style="height:38px;margin-left:2px;margin-right:2px;" onkeypress="handleDropdownEnterKey(event, 'searchForm')">
    <option value="All" {{ request('language_id') == 'All' ? 'selected' : '' }}>All languages</option>
    @foreach($languages as $language)
        @if($loop->first && !request('language_id'))
            <option value="{{ $language->id }}" {{ $language->name == 'Tagalog' ? 'selected' : '' }}>{{ $language->name }}</option>
        @else
            <option value="{{ $language->id }}" {{ request('language_id') == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
        @endif
    @endforeach
</select> 
            <!-- Category Dropdown -->
            <select name="category_ids[]" id="categoryDropdown" class="rounded-md" style="height:38px;margin-left:2px;margin-right:2px;" onkeypress="handleDropdownEnterKey(event, 'searchForm')">
                <option value="All" {{ in_array('All', request('category_ids', [])) ? 'selected' : '' }}>All categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, request('category_ids', [])) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
                    
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary ml-1" id="searchButton">Search</button>
                    </div>
                </form>

                <!-- Tabs -->
                <div class="flex" style="display:none;">
                    <button id="tabAll" class="tab-button bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-l focus:outline-none">All</button>
                    <button id="tabSongs" class="tab-button bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 focus:outline-none">Hymns</button>
                    <button id="tabPlaylist" class="tab-button bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-r focus:outline-none">Playlist</button>
                </div>
            </div>
            <script>
                // Function to handle keypress event for input field
                function handleEnterKey(event) {
                    if (event.keyCode === 13) {
                        event.preventDefault();
                        document.getElementById("searchForm").submit();
                    }
                }

                // Function to handle keypress event for dropdowns
                function handleDropdownEnterKey(event, formId) {
                    if (event.keyCode === 13) {
                        event.preventDefault();
                        document.getElementById(formId).submit();
                    }
                }

                // Function to trigger form submit when language dropdown changes
                function triggerFormSubmit(event) {
                    document.getElementById("searchForm").submit();
                }

                // Function to handle AJAX search on input change
                document.getElementById('searchInput').addEventListener('input', function() {
                    const searchTerm = this.value;
                    const url = new URL(window.location.href);
                    url.searchParams.set('query', searchTerm);
                    url.searchParams.delete('page'); // Remove the page parameter
                    url.searchParams.set('focus', 'true'); // Add a focus parameter

                    // Redirect to the updated URL
                    window.location.href = url.href;
                });

                // On page load, check if the focus parameter is set
                document.addEventListener('DOMContentLoaded', function() {
                    const url = new URL(window.location.href);
                    if (url.searchParams.get('focus') === 'true') {
                        const searchInput = document.getElementById('searchInput');
                        searchInput.focus();
                        searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length); // Move cursor to the end of the input
                        url.searchParams.delete('focus'); // Remove the focus parameter
                        window.history.replaceState({}, '', url.href); // Update the URL without reloading
                    }
                });

                document.getElementById('languageDropdown').addEventListener('change', function() {
                    const languageId = this.value;

                    // Update the URL with the new language ID
                    const url = new URL(window.location.href);
                    url.searchParams.set('language_id', languageId);

                    // Redirect to the updated URL
                    window.location.href = url.href; 
                });

    //             document.addEventListener('DOMContentLoaded', function() {
    //     const searchInput = document.getElementById('searchInput');

    //     function fetchMusics(url) {
    //         fetch(url)
    //             .then(response => response.json())
    //             .then(data => {
    //                 document.getElementById('musicList').innerHTML = data.html;
    //                 document.querySelector('.pagination').innerHTML = data.pagination;
    //             });
    //     }

    //     searchInput.addEventListener('input', function() {
    //         const searchTerm = this.value;
    //         const url = new URL(window.location.href);
    //         url.searchParams.set('query', searchTerm);
    //         fetchMusics(url);
    //     });

    //     document.addEventListener('click', function(event) {
    //         if (event.target.closest('.pagination a')) {
    //             event.preventDefault();
    //             const url = event.target.closest('.pagination a').href;
    //             fetchMusics(url);
    //         }
    //     });
    // });

            </script>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');

        function fetchMusics(url) {
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const musicList = doc.getElementById('musicList');
                    document.getElementById('musicList').innerHTML = musicList.innerHTML;
                    const pagination = doc.querySelector('.pagination');
                    document.querySelector('.pagination').innerHTML = pagination.innerHTML;
                });
        }

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('query', searchTerm);
            fetchMusics(url);
        });

        document.addEventListener('click', function(event) {
            if (event.target.closest('.pagination a')) {
                event.preventDefault();
                const url = event.target.closest('.pagination a').href;
                fetchMusics(url);
            }
        });
    });
</script> -->

        </form>

        <style>
            #context-menu {
                display: none;
                position: fixed;
                top: 50%;
                left: -100%; /* Start off-screen */
                transform: translateY(-50%);
                background-color: #f9f9f9;
                padding: 8px 16px;
                border: 1px solid #ccc;
                z-index: 9999; /* Ensure menu appears above other content */
                width: 80%;
                max-width: 1200px;
                max-height: 80vh; /* Set maximum height to 80% of viewport height */
                overflow-y: auto; /* Enable vertical scrollbar if content overflows */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: left 0.3s ease-in-out; /* Smooth transition */
            }

            #context-menu.visible {
                left: 50%;
                transform: translate(-50%, -50%);
            }

            #categoriesSection {
                max-height: 70vh; /* Set maximum height to 70% of viewport height */
                overflow-y: auto; /* Enable vertical scrollbar if content overflows */
            }
        </style>

        <!-- Categories Section -->
        <div id="context-menu" class="mb-4 mx-auto"    style="position: fixed;">
            <div id="categoriesSection">
                <h2 class="text-lg font-semibold mb-2">Categories</h2>
                <div id="topCategories" class="flex flex-wrap -mx-2">
                    @foreach($topCategories as $index => $category)
                        <div class="w-1/2 md:w-1/5 px-2 mb-4">
                            <button id="categoryButton{{ $index }}" style="background-color:#5eb8d3; height:150px; width:150px; border: 2px solid #00215E; border-radius: 0.5rem;" class="category-box bg-teal-400 hover:bg-teal-500 p-2 rounded text-center w-full" data-category-id="{{ $category->id }}" onclick="selectCategory({{ $index }})">
                                <span class="flex items-center justify-center h-full text-white">{{ $category->name }} ({{ $category->musics_count }})</span>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button id="hideCategories" class="mt-4 text-blue-500 hidden">Hide</button>
                <div id="allCategories" class="hidden mt-4 flex flex-wrap -mx-2">
                    @foreach($categories as $index => $category)
                        @if($index >= 10) <!-- Start displaying from the 11th category -->
                            <div class="w-1/2 md:w-1/5 px-2 mb-4">
                                <button id="categoryButton{{ $index }}" style="background-color:#5eb8d3; height:150px;width:150px; border: 2px solid #00215E; border-radius: 0.5rem;" class="category-box border border-teal-400 hover:border-teal-500 bg-teal-400 hover:bg-teal-500 p-2 rounded text-center w-full" data-category-id="{{ $category->id }}" onclick="selectCategory({{ $index }})">
                                    <span class="flex items-center justify-center h-full text-white">{{ $category->name }} ({{ $category->musics_count }})</span>
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>
                <button id="viewAllCategories" class="mt-4 text-blue-500">View All</button>
            </div>
        </div>

<script>
    let selectedCategoryId = null;

    function selectCategory(index) {
        if (selectedCategoryId !== null) {
            document.getElementById('categoryButton' + selectedCategoryId).style.backgroundColor = '#5eb8d3';
        }
        selectedCategoryId = index;
        document.getElementById('categoryButton' + index).style.backgroundColor = '#4975b4';

        // Hide the context menu
        const contextMenu = document.getElementById('context-menu');
        contextMenu.classList.remove('visible');
        setTimeout(() => {
            contextMenu.style.display = 'none';
        }, 300);
        categoriesSection.classList.add('hidden');

        // Reset the button icon
        const showCategoriesBtn = document.getElementById('showCategoriesModal');
        showCategoriesBtn.innerHTML = '<i class="fas fa-info"></i>';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const viewAllCategoriesBtn = document.getElementById('viewAllCategories');
        const hideCategoriesBtn = document.getElementById('hideCategories');
        const allCategoriesDiv = document.getElementById('allCategories');
        const showCategoriesBtn = document.getElementById('showCategoriesModal');
        const contextMenu = document.getElementById('context-menu');
        const categoriesSection = document.getElementById('categoriesSection');

        viewAllCategoriesBtn.addEventListener('click', function() {
            allCategoriesDiv.classList.remove('hidden');
            viewAllCategoriesBtn.classList.add('hidden');
            hideCategoriesBtn.classList.remove('hidden');
        });

        showCategoriesBtn.addEventListener('click', function() {
            if (contextMenu.classList.contains('visible')) {
                contextMenu.classList.remove('visible');
                setTimeout(() => {
                    contextMenu.style.display = 'none';
                }, 300); // Allow time for the slide-out transition
                categoriesSection.classList.add('hidden');
            } else {
                contextMenu.style.display = 'block';
                setTimeout(() => {
                    contextMenu.classList.add('visible');
                }, 0); // Allow time for the display to take effect
                categoriesSection.classList.remove('hidden');
            }
            showCategoriesBtn.innerHTML = contextMenu.classList.contains('visible') ? '<i class="fas fa-info"></i>' : '<i class="fas fa-info"></i>'; // Toggle icon between close and menu
        });

        hideCategoriesBtn.addEventListener('click', function() {
            allCategoriesDiv.classList.add('hidden');
            hideCategoriesBtn.classList.add('hidden');
            viewAllCategoriesBtn.classList.remove('hidden');
        });

        const categoryBoxes = document.querySelectorAll('.category-box');

        categoryBoxes.forEach(box => {
            box.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-category-id');
                fetchMusicsByCategory(categoryId);
            });
        });

        function fetchMusicsByCategory(categoryId) {
            const url = new URL(window.location.href);
            url.searchParams.set('category_ids[]', categoryId);

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const musicList = doc.getElementById('musicList');
                    document.getElementById('musicList').innerHTML = musicList.innerHTML;
                    document.querySelector('.pagination').innerHTML = doc.querySelector('.pagination').innerHTML;
                });
        }

    });
</script>

<div class="overflow-hidden shadow-sm sm:rounded-lg" style="background: linear-gradient(to bottom, #5eb8d3, #4975b4);">
                <div class="p-6" >

                 <style>

                .container {
                    display: flex;
                    justify-content: center;
                }

                /* Ensure table fills its container */
                table {
                    width: 100%;
                }

                /* Set minimum width to prevent shrinking */
                .min-w-full {
                    min-width: 100%;
                }

                /* Allow horizontal scrolling on overflow */
                .overflow-x-auto {
                    overflow-x: auto;
                }

                /* Style for active tab */
                .tab-button.active {
                    background-color: #3182ce;
                    color: white;
                }
                    /* Hover effect for table rows */
                tbody tr:hover {
                    background-color: #f3f4f6; /* Light gray background on hover */
                }
            </style>
            <script>
                // Add event listener for search input
                document.getElementById('searchInput').addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const musicRows = document.querySelectorAll('#musicList tr');
                    let noMusicFound = true;

                    musicRows.forEach(row => {
                        const title = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                        const category = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                        const language = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                        const isVisible = title.includes(searchTerm) || category.includes(searchTerm) || language.includes(searchTerm);

                        row.style.display = isVisible ? '' : 'none';

                        if (isVisible) {
                            noMusicFound = false;
                        }
                    });

                    // Show/hide no music found message
                    const noMusicFoundMessage = document.getElementById('noMusicFoundMessage');
                    noMusicFoundMessage.style.display = noMusicFound ? 'block' : 'none';
                });
            </script>
            
        <div class="container text-center">
            {{ $musics->appends(['query' => request()->query('query')])->links('pagination::bootstrap-4') }}
        </div>         
    <!-- Music Table -->
    <div class="overflow-x-auto margin:10px;" >
    <table class="min-w-full mt-3 mb-3">
        <thead >
            <tr style="display:none1;">
                <th style="width: 18% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-center text-s font-large text-white uppercase tracking-wider" onclick="sortTable(2)">
                    Hymn # <i id="hymnSortIcon" class="fas fa-sort"></i>
                </th>
                <th style="width: 35% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-white uppercase tracking-wider" onclick="sortTable(1)">
                    Title <i id="titleSortIcon" class="fas fa-sort"></i>
                </th>
            
                <th style="width: 25% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-white uppercase tracking-wider">Category</th>
                <th style="width: 15% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-white uppercase tracking-wider">Language</th>
                @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.action') == 'inline')
                    <th scope="col" class="px-4 py-2 bg-gray-50 text-center text-s font-large text-white uppercase tracking-wider">Action</th>
                @endif
            </tr>
        </thead>
    <tbody id="musicList" class="bg-white divide-y divide-gray-200">
        @foreach($musics as $index => $music)
        <tr class="hoverable">
            <td style="width: 18% !important; white-space: normal;" class="px-4 py-3 whitespace-nowrap text-center">
                {{ $music->song_number }}
            </td>
            
            <!-- <td style="width: 35% !important; white-space: normal;" class="px-4 py-3 whitespace-nowrap">
                <a href="{{ route('musics.show', $music->id) }}" class="flex items-center">
                    <i class="fas fa-music" style="margin-right: 12px; margin-left: 4px;color:#50727B;"></i>
                    {{ $music->title }}
                </a>
            </td> -->

            <td style="width: 35% !important; white-space: normal;" class="px-4 py-3 whitespace-nowrap">
                <a href="{{ route('musics.show', ['id' => $music->id, 'languageId' => $music->language_id, 'playlist_id' => $music->playlist_id ?? $playlistId]) }}" class="flex items-center">
                    <i class="fas fa-music" style="margin-right: 12px; margin-left: 4px;color:#50727B;"></i>
                    {{ $music->title }}
                </a>
            </td>

            <td style="width: 25% !important; white-space: normal;" class="px-4 py-3 whitespace-normal">
                @foreach($music->categories as $category)
                    {{ $loop->first ? '' : ', ' }}{{ $category->name }}
                @endforeach
            </td>
            <td style="width: 15% !important; white-space: normal;" class="px-4 py-3 whitespace-nowrap">
                {{ $music->language->name }}
            </td>
            @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.action') == 'inline')
                <td class="px-4 py-3 whitespace-nowrap text-center">
                    <div class="flex justify-center items-center space-x-4">
                        @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.edit') == 'inline')
                            <a href="{{ route('musics.edit', $music->id) }}" class="btn btn-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif

                        @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.delete') == 'inline')
                            <form id="deleteForm{{$music->id}}" method="POST" action="{{ route('musics.destroy', $music->id) }}" style="display: inline;margin-top:16px;margin-left:3px;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{$music->id}})" class="btn btn-secondary">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endif
                        <!-- Add playlist icon -->
                        @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.playlist') == 'inline')
                            <button id="playlistButton{{ $music->id }}" class="btn btn-secondary playlist-button ml-1" data-music-id="{{ $music->id }}">
                                <i class="fa-solid fa-sliders-h"></i>
                            </button>
                            <div id="contextMenu{{ $music->id }}" class="context-menu hidden">
                                <button style="color:black;" class="add-new-playlist" data-music-id="{{ $music->id }}">Add to New Playlist</button>
                                <ul></ul>
                            </div>
                        @endif
                    </div>
                </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
          
<script>
    const tableContainer = document.querySelector('.overflow-x-auto');

    tableContainer.addEventListener('mousewheel', (e) => {
    if (!tableContainer.contains(e.target)) {
        e.preventDefault();
    }
    });
</script>

<style>
    .context-menu {
      position: fixed;
      z-index: 1000;
      background: #fff;
      border: 1px solid #ccc;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      border-radius: 4px; /* added border radius for a smoother look */
      padding: 8px; /* added padding for better spacing */
    }

    .context-menu ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .context-menu ul li {
      padding: 8px 12px;
      border-bottom: 1px solid #f0f0f0; /* added border bottom for separation */
    }

    .context-menu ul li:last-child {
      border-bottom: none; /* remove border bottom for the last item */
    }

    .context-menu ul li button {
      width: 100%;
      text-align: left;
      background: none;
      border: none;
      cursor: pointer;
      color: #333; /* changed color to a darker gray for better contrast */
      transition: background 0.2s ease; /* added transition for hover effect */
    }

    .context-menu ul li button:hover {
      background: #f0f0f0; /* added hover effect */
    }

    .context-menu ul li button:focus {
      outline: none; /* remove outline on focus */
      box-shadow: 0 0 0 2px #ccc; /* added box shadow on focus */
    }

    .playlist-button {
      margin-right: 10px; /* added margin right for better spacing */
    }

    .add-new-playlist {
      margin-bottom: 10px; /* added margin bottom for better spacing */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.playlist-button').forEach(button => {
            button.addEventListener('click', function (event) {
                const button = event.currentTarget;
                const musicId = button.dataset.musicId;
                const contextMenu = document.getElementById('contextMenu' + musicId);

                // Hide any other open context menus
                document.querySelectorAll('.context-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });

                // Show the clicked context menu
                contextMenu.classList.remove('hidden');
                contextMenu.style.top = event.clientY + 'px';
                contextMenu.style.left = event.clientX + 'px';

                fetch('/playlists')
                    .then(response => response.json())
                    .then(data => {
                        const existingPlaylists = data.playlists;

                        let playlistOptions = '';
                        existingPlaylists.forEach(playlist => {
                            playlistOptions += `<li><button class="add-to-playlist" data-music-id="${musicId}" data-playlist-id="${playlist.id}">${playlist.name}</button></li>`;
                        });
                        const playlistList = contextMenu.querySelector('ul');
                        playlistList.innerHTML = playlistOptions;
                    })
                    .catch(error => {
                        console.error('Error fetching playlists:', error);
                    });

                event.preventDefault();
            });
        });

        document.querySelectorAll('.add-new-playlist').forEach(button => {
        button.addEventListener('click', function (event) {
            const musicId = event.target.dataset.musicId;
            // Show a prompt to enter the new playlist name
            const playlistName = prompt('Enter new playlist name:');
         
            if (playlistName) {
                // Send request to create new playlist and add music to it
                fetch('/playlists', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        name: playlistName,
                        music_id: musicId
                    })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        alert('Music added to new playlist');
                    } else {
                        alert('Failed to add music to playlist');
                    }
                });
            }
            document.querySelectorAll('.context-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
            event.preventDefault();
        });
    });


        // Handle add to existing playlist button
        // document.addEventListener('click', function (event) {
        //     if (event.target.classList.contains('add-to-playlist')) {
        //         const musicId = event.target.dataset.musicId;
        //         const playlistId = event.target.dataset.playlistId;

        //         fetch(`/playlists/${playlistId}/add`, {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //             },
        //             body: JSON.stringify({ music_id: musicId })
        //         }).then(response => response.json()).then(data => {
        //             if (data.success) {
        //                 alert('Music added to playlist');
        //             } else {
        //                 alert('Failed to add music to playlist');
        //             }
        //         });

        //         document.querySelectorAll('.context-menu').forEach(menu => {
        //             menu.classList.add('hidden');
        //         });
        //         event.preventDefault();
        //     }
        // });


       document.addEventListener('click', function (event) {
    if (event.target.classList.contains('add-to-playlist')) {
        const musicId = event.target.dataset.musicId;
        const playlistId = event.target.dataset.playlistId;

        // Check if musicId and playlistId exist in the music_playlist table
        fetch(`/playlists/${playlistId}/validate/${musicId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json()).then(data => {
            if (data.exists) {
                alert('Hymn already added to playlist.');
            } else {
                // Proceed to add music to playlist
                fetch(`/playlists/${playlistId}/add`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ music_id: musicId })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        alert('Music added to playlist');
                    } else {
                        alert('Failed to add music to playlist');
                    }
                });
            }
        });

        document.querySelectorAll('.context-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
        event.preventDefault();
    }
});

        // Hide context menu on outside click
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.playlist-button')) {
                document.querySelectorAll('.context-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });
    });
</script>

<style>
    .hoverable:hover {
    background-color: #007bff; /* or any other color you prefer */
}

tbody tr:hover {
    background-color: #007bff; /* or any other color you prefer */   
    color: #ffffff; /* or any other color you prefer */
    font-weight:bold;
    font-size:17px;
}
</style>
<script>
    function confirmDelete(musicId) {
        if (confirm("Are you sure you want to delete this music entry?")) {
            document.getElementById('deleteForm' + musicId).submit();
        }
    }
</script>
                <script>
                var titleSortDirection = 1;
                var hymnSortDirection = 1;

                function sortTable(colIndex) {
                    var table, rows, switching, i, x, y, shouldSwitch;
                    table = document.querySelector('.min-w-full');
                    switching = true;
                    while (switching) {
                        switching = false;
                        rows = table.rows;
                        for (i = 1; i < (rows.length - 1); i++) {
                            shouldSwitch = false;
                            x = rows[i].getElementsByTagName("TD")[colIndex];
                            y = rows[i + 1].getElementsByTagName("TD")[colIndex];
                            var xValue = x.textContent || x.innerText;
                            var yValue = y.textContent || y.innerText;
                            if (colIndex === 1) {
                                if (titleSortDirection === 1) {
                                    if (xValue.toLowerCase() > yValue.toLowerCase()) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                } else {
                                    if (xValue.toLowerCase() < yValue.toLowerCase()) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                }
                            } else if (colIndex === 2) {
                                if (hymnSortDirection === 1) {
                                    if (parseInt(xValue) > parseInt(yValue)) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                } else {
                                    if (parseInt(xValue) < parseInt(yValue)) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                }
                            }
                        }
                        if (shouldSwitch) {
                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                        }
                    }
                    toggleSortIcon(colIndex);
                }

                function toggleSortIcon(colIndex) {
                    var iconId = colIndex === 1 ? 'titleSortIcon' : 'hymnSortIcon';
                    var icon = document.getElementById(iconId);
                    if (icon.classList.contains('fa-sort')) {
                        icon.classList.remove('fa-sort');
                        icon.classList.add('fa-sort-up');
                        if (colIndex === 1) {
                            titleSortDirection = 1;
                        } else if (colIndex === 2) {
                            hymnSortDirection = 1;
                        }
                    } else if (icon.classList.contains('fa-sort-up')) {
                        icon.classList.remove('fa-sort-up');
                        icon.classList.add('fa-sort-down');
                        if (colIndex === 1) {
                            titleSortDirection = -1;
                        } else if (colIndex === 2) {
                            hymnSortDirection = -1;
                        }
                    } else if (icon.classList.contains('fa-sort-down')) {
                        icon.classList.remove('fa-sort-down');
                        icon.classList.add('fa-sort-up');
                        if (colIndex === 1) {
                            titleSortDirection = 1;
                        } else if (colIndex === 2) {
                            hymnSortDirection = 1;
                        }
                    }
                }
                </script>

                    <!-- Add this script to ensure FontAwesome icons are loaded -->
                    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

                    </div>
                    <!-- <div class="pagination flex justify-center items-center" style="padding:0px;margin-top:10px;">
                       
                    </div> -->
         <div class="container text-center">
    {{ $musics->appends(['query' => request()->query('query')])->links('pagination::bootstrap-4') }}
</div>
                    <!-- Message when no music is found -->
                    <p id="noMusicFoundMessage" class="text-center text-gray-500 mt-4" style="display: none;">No music found</p>
                </div>
            </div>
           
            <script>
                // JavaScript for tab switching
                const tabButtons = document.querySelectorAll('.tab-button');
                const musicRows = document.querySelectorAll('#musicList tr');
                const searchInput = document.getElementById('searchInput');
                const searchOverlay = document.getElementById('searchOverlay');

                // Add event listener for search input focus
                searchInput.addEventListener('focus', () => {
                    searchOverlay.classList.remove('hidden');
                });

                // Add event listener for search input blur
                searchInput.addEventListener('blur', () => {
                    searchOverlay.classList.add('hidden');
                });

                tabButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        // Set active class on clicked tab button
                        tabButtons.forEach(btn => btn.classList.remove('active'));
                        button.classList.add('active');

                        // Show/hide rows based on selected tab
                        const tabName = button.id.slice(3).toLowerCase(); // Extract tab name (e.g., 'All', 'Songs', 'Playlist')
                        musicRows.forEach(row => {
                            const category = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                            const isSongRow = tabName === 'songs' && category !== 'playlist';
                            const isPlaylistRow = tabName === 'playlist' && category === 'playlist';
                            const isVisible = tabName === 'all' || isSongRow || isPlaylistRow;

                            row.style.display = isVisible ? '' : 'none';
                        });

                        // Show/hide no music found message
                        const noMusicFoundMessage = document.getElementById('noMusicFoundMessage');
                        const visibleRows = document.querySelectorAll('#musicList tr[style=""]');
                        noMusicFoundMessage.style.display = visibleRows.length > 0 ? 'none' : 'block';
                    });
                });
            </script>

</div>
            </div>
</x-app-layout>
