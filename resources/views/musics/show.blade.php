<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery before Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/musicplayer.css') }}">
<link rel="stylesheet" href="{{ asset('css/musicdetails.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>

<!-- Verify if the script path is correct and file exists -->
<script>
    console.log("Loading musicplayer.js from: {{ asset('js/musicplayer.js') }}");
</script>
<script src="{{ asset('js/musicplayer.js') }}"></script>

<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center my-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Music Details') }}
            </h2>
            <div>
            
                <!-- <a href="{{ route('musics.index') }}" class="btn btn-secondary">Back</a> -->
                <a href="{{ session()->has('url.intended') ? session('url.intended') : route('musics.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                
<!-- Show Music Details Button -->
<button id="showMusicDetailsBtn" class="show-details-btn">
    <i class="fas fa-info"></i>
</button>

<!-- Display Music Details -->
<div id="musicDetails" class="music-details hidden">
    <!-- Title -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Title:</p>
        <p><i>{{ $music->title }}</i></p>
    </div>

    <!-- Song Number -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Hymn Number:</p>
        <p>{{ $music->song_number }}</p>
    </div>

    <!-- Categories -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Category:</p>
        <ul class="list-disc list-inside" id="categoriesList">
            @foreach ($music->categories->take(3) as $category)
                <li>{{ $category->name }}</li>
            @endforeach
            @foreach ($music->categories->skip(3) as $category)
                <li class="hidden">{{ $category->name }}</li>
            @endforeach
        </ul>
        @if ($music->categories->count() > 3)
            <button onclick="toggleList('categoriesList', this)">See More</button>
        @endif
    </div>

    <!-- Instrumentation -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Instrumentation:</p>
        <ul class="list-disc list-inside" id="instrumentationList">
            @foreach ($music->instrumentations->take(3) as $instrumentation)
                <li>{{ $instrumentation->name }}</li>
            @endforeach
            @foreach ($music->instrumentations->skip(3) as $instrumentation)
                <li class="hidden">{{ $instrumentation->name }}</li>
            @endforeach
        </ul>
        @if ($music->instrumentations->count() > 3)
            <button onclick="toggleList('instrumentationList', this)">See More</button>
        @endif
    </div>

    <!-- Ensemble Type -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Ensemble Type:</p>
        <ul class="list-disc list-inside" id="ensembleTypeList">
            @foreach ($music->ensembleTypes->take(3) as $ensembleType)
                <li>{{ $ensembleType->name }}</li>
            @endforeach
            @foreach ($music->ensembleTypes->skip(3) as $ensembleType)
                <li class="hidden">{{ $ensembleType->name }}</li>
            @endforeach
        </ul>
        @if ($music->ensembleTypes->count() > 3)
            <button onclick="toggleList('ensembleTypeList', this)">See More</button>
        @endif
    </div>

    @if (\App\Helpers\AccessRightsHelper::checkPermission('music_details.view_credits') == 'inline')
    
   <!-- Lyricists -->
<div class="mb-4">
    <p class="font-semibold text-lg">Lyricist:</p>
    <ul class="list-disc list-inside" id="lyricistsList">
        @if ($music->lyricists->count() > 0)
            @foreach ($music->lyricists->take(3) as $lyricist)
                <li data-creator-id="{{ $lyricist->id }}" data-music-id="{{ $music->id }}">{{ $lyricist->name }}</li>
            @endforeach
            @foreach ($music->lyricists->skip(3) as $lyricist)
                <li class="hidden" data-creator-id="{{ $lyricist->id }}" data-music-id="{{ $music->id }}">{{ $lyricist->name }}</li>
            @endforeach
        @else
            <li>N/A</li>
        @endif
    </ul>
    @if ($music->lyricists->count() > 3)
        <button onclick="toggleList('lyricistsList', this)">See More</button>
    @endif
</div>

<!-- Composer -->
<div class="mb-4">
    <p class="font-semibold text-lg">Composer:</p>
    <ul class="list-disc list-inside" id="composerList">
        @if ($music->composers->count() > 0)
            @foreach ($music->composers->take(3) as $composer)
                <li data-creator-id="{{ $composer->id }}" data-music-id="{{ $music->id }}">{{ $composer->name }}</li>
            @endforeach
            @foreach ($music->composers->skip(3) as $composer)
                <li class="hidden" data-creator-id="{{ $composer->id }}" data-music-id="{{ $music->id }}">{{ $composer->name }}</li>
            @endforeach
        @else
            <li>N/A</li>
        @endif
    </ul>
    @if ($music->composers->count() > 3)
        <button onclick="toggleList('composerList', this)">See More</button>
    @endif
</div>

<!-- Arranger -->
<div class="mb-4">
    <p class="font-semibold text-lg">Arranger:</p>
    <ul class="list-disc list-inside" id="arrangerList">
        @if ($music->arrangers->count() > 0)
            @foreach ($music->arrangers->take(3) as $arranger)
                <li data-creator-id="{{ $arranger->id }}" data-music-id="{{ $music->id }}">{{ $arranger->name }}</li>
            @endforeach
            @foreach ($music->arrangers->skip(3) as $arranger)
                <li class="hidden" data-creator-id="{{ $arranger->id }}" data-music-id="{{ $music->id }}">{{ $arranger->name }}</li>
            @endforeach
        @else
            <li>N/A</li>
        @endif
    </ul>
    @if ($music->arrangers->count() > 3)
        <button onclick="toggleList('arrangerList', this)">See More</button>
    @endif
</div>

@endif


   <!-- Language Selection -->
   <div class="mb-4">
        <p class="font-semibold text-lg">Language:</p>
        <select id="languageSelector" class="form-control">
            @foreach($music->languages as $lang)
                <option value="{{ $lang->id }}" {{ $language->id == $lang->id ? 'selected' : '' }}>{{ $lang->name }}</option>
            @endforeach
        </select>
    </div>

<script>
    document.getElementById('languageSelector').addEventListener('change', function() {
        var languageId = this.value;
        var url = new URL(window.location.href);
        url.searchParams.set('language_id', languageId);
        window.location.href = url.toString();
    });
</script>

    <!-- Verses Used -->
    <div class="mb-4">
        <p class="font-semibold text-lg">Verses Used:</p>
        <p>{{ $music->verses_used }}</p>
    </div>
</div>



<style>
body {
  background: linear-gradient(to bottom, #5eb8d3, #4975b4);
}
.hidden {
    display: none;
}
li[data-creator-id]:hover {
  font-weight: bold;
  color:#5eb8d3;
}
#creatorDetails {
    position: absolute;
    z-index: 1000;
    background: linear-gradient(to bottom, #5eb8d3, #4975b4);
    border: 1px solid #ccc;
    padding: 10px;
    color:white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
#creatorDetails img {
  max-width: 100%;
  height: auto;
  display: block;
  margin: 0 auto;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

  </style>


<script>

// Get all list items with data-creator-id attribute
const creatorListItems = document.querySelectorAll('[data-creator-id]');

// Add event listener to each list item
creatorListItems.forEach((item) => {
  item.addEventListener('mouseover', (event) => {
    const creatorId = event.target.getAttribute('data-creator-id');
    displayCreatorDetails(creatorId, event.clientX, event.clientY);
  });

  item.addEventListener('mouseout', () => {
    const creatorDetails = document.getElementById('creatorDetails');
    creatorDetails.classList.add('hidden');
  });
});

function displayCreatorDetails(creatorId, mouseX, mouseY) {
  fetch(`/creators/${creatorId}`)
  .then(response => response.json())
  .then(data => {
      const creatorDetails = document.getElementById('creatorDetails');
      const birthdayDisplay = data.birthday? (data.birthday === '0000-00-00 00:00:00'? 'N/A' : new Date(data.birthday).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })) : 'N/A';
      const musicBackgroundDisplay = data.music_background? data.music_background : 'N/A';
      const nameDisplay = data.name? data.name : 'N/A';
      const localDisplay = data.local? data.local : 'N/A';
      const districtDisplay = data.district? data.district : 'N/A';
      const dutyDisplay = data.duty? data.duty : 'N/A';


      let imageSource = '/images/blank_image.png';
      
     
      if (data.image) {
        imageSource = `/storage/${data.image}`;
      }
     // alert(imageSource);
      creatorDetails.innerHTML = `
        <h1><b>${nameDisplay}</b></h1>
         <img src="${imageSource}" alt="${nameDisplay}" style="width:200px; height:200px;">
        <p>Local: ${localDisplay}</p>
        <p>District: ${districtDisplay}</p>
        <p>Duty: ${dutyDisplay}</p>
        <p>Birthday: ${birthdayDisplay}</p>
        <p>Music Background: ${musicBackgroundDisplay}</p>
      `;
      creatorDetails.style.left = `${mouseX}px`;
      creatorDetails.style.top = `${mouseY}px`;
      creatorDetails.classList.remove('hidden');
    });
}

function toggleList(listId, button) {
    const list = document.getElementById(listId);
    const items = list.querySelectorAll('li.hidden');

    if (list.classList.contains('expanded')) {
        list.classList.remove('expanded');
        items.forEach(item => {
            item.style.display = 'none';
        });
        button.innerText = 'See More';
    } else {
        list.classList.add('expanded');
        items.forEach(item => {
            item.style.display = 'list-item';
        });
        button.innerText = 'See Less';
    }
}

document.getElementById('showMusicDetailsBtn').addEventListener('click', function() {
    const musicDetails = document.getElementById('musicDetails');
    const creatorDetails = document.getElementById('creatorDetails');
    musicDetails.classList.toggle('hidden');
    creatorDetails.classList.add('hidden'); // Add this line
   

    const icon = this.querySelector('i');
    if (musicDetails.classList.contains('hidden')) {
        icon.classList.remove('fa-arrow-left');
        icon.classList.add('fa-arrow-right');
    } else {
        icon.classList.remove('fa-arrow-right');
        icon.classList.add('fa-arrow-left');
    }
});


</script>
<div id="creatorDetails" class="hidden">
    <!-- Creator details will be populated here -->
</div>
<div class="music-container">

    <div class="music-player-details">

  <script>
    // Get the audio element
const audioElement = document.getElementById('musicPlayer');

// Add an event listener to the contextmenu event
audioElement.addEventListener('contextmenu', (event) => {
  // Prevent the default context menu from appearing
  event.preventDefault();

  // Create a custom context menu
  const contextMenu = document.createElement('menu');
  contextMenu.id = 'customContextMenu';

  // Add menu items (e.g., play, pause, etc.)
  // You can add or remove items as per your requirements
  const playMenuItem = document.createElement('menuitem');
  playMenuItem.label = 'Play';
  contextMenu.appendChild(playMenuItem);

  const pauseMenuItem = document.createElement('menuitem');
  pauseMenuItem.label = 'Pause';
  contextMenu.appendChild(pauseMenuItem);

  // Show the custom context menu
  contextMenu.style.top = `${event.clientY}px`;
  contextMenu.style.left = `${event.clientX}px`;
  document.body.appendChild(contextMenu);

  // Remove the custom context menu when it's no longer needed
  document.addEventListener('click', () => {
    document.body.removeChild(contextMenu);
  });
});

</script>
           

            <div class="music-player" >
                <!-- Tab buttons -->
                <div class="flex tab-buttons">
                    <button class="tab-button-mp3 active" data-path="{{ asset('storage/' . $music->vocals_mp3_path) }}">Vocals</button>
                    <button class="tab-button-mp3" data-path="{{ asset('storage/' . $music->organ_mp3_path) }}">Organ</button>
                    <button class="tab-button-mp3" data-path="{{ asset('storage/' . $music->preludes_mp3_path) }}">Preludes</button>
                    <button class="tab-button ml-2 active" data-path="{{ asset('storage/' . $music->music_score_path) }}">Music Score</button>
                    <button class="tab-button" data-path="{{ asset('storage/' . $music->lyrics_path) }}">Lyrics Only</button>
                </div>

                <div class="flex row mt-1 mb-0">
                    <!-- Audio player -->
                    <audio id="musicPlayer" controls preload="auto" download="">
                        <!-- Include source elements -->
                        <source id="audioSource" src="#" type="audio/mpeg">

                    </audio>
                    <!-- Download button -->
                    @if (\App\Helpers\AccessRightsHelper::checkPermission('music_details.download') == 'inline')
                    <button id="downloadButton" class="btn btn-primary">Download</button>
                    @endif
                    <!-- JavaScript to handle download -->
                    <script>
                        document.getElementById('downloadButton').addEventListener('click', function() {
                            const audioSource = document.getElementById('audioSource');
                            const musicPlayer = document.getElementById('musicPlayer');

                            // Get all tab buttons
                            const tabButtons = document.querySelectorAll('.tab-button-mp3');

                            // Function to get the active tab button
                            function getActiveTabButton() {
                            let activeTabButton = null;
                            tabButtons.forEach((button) => {
                                if (button.classList.contains('active')) {
                                activeTabButton = button;
                                }
                            });
                            return activeTabButton;
                            }

                            // Get the active tab button
                            const activeTabButton = getActiveTabButton();

                            const title = '{{ $music->title }}';
                            const trackType = activeTabButton ? activeTabButton.textContent.trim() : '';

                            const downloadLink = document.createElement('a');
                            downloadLink.href = audioSource.src;
                            downloadLink.download = `${title}_${trackType}`
                            downloadLink.click();
                        });
                    </script>
                    <!-- Tab Lyrics -->
                    <div class="tab-buttons">
                        
                    </div>
                </div>

            </div>

 <!-- JavaScript to handle dropdown and audio playback -->
 <script>
                document.addEventListener('DOMContentLoaded', function() {

                    const musicPlayer = document.getElementById('musicPlayer');

                    // Handle click events for tab buttons
                    const tabButtons = document.querySelectorAll('.tab-button-mp3');
                    tabButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const path = button.getAttribute('data-path');
                            switchTrack(path);
                        });
                    });

                    // Play vocals automatically when page loads
                    const vocalsPath = document.querySelector('.tab-button-mp3.active').getAttribute('data-path');
                    switchTrack(vocalsPath);


                });
                // Get the audio element
                const musicPlayer = document.getElementById('musicPlayer');
                function seekAudio(event) {
                    console.log('Click event detected on progress bar.');
                    console.log('Offset X:', event.offsetX);

                    const clickX = event.offsetX;
                    const width = this.offsetWidth;
                    const audioDuration = musicPlayer.duration;
                    const seekTime = (clickX / width) * audioDuration;

                    console.log('Width:', width);
                    console.log('Audio Duration:', audioDuration);
                    console.log('Seek Time:', seekTime);

                    musicPlayer.currentTime = seekTime;
                }

                // Attach seek event listener to the audio progress bar
                musicPlayer.addEventListener('click', seekAudio);

                let storedCurrentTime = 0; // Store the current time globally
                function switchTrack(path) {
                    const audioSource = document.getElementById('audioSource');
                    const musicPlayer = document.getElementById('musicPlayer');
                    
                    // Set new audio source pathhhhhhh
                    audioSource.src = path;
                    
                    // Load the new audio source
                    musicPlayer.load();
                    
                    // Wait for the new audio source to load and start playing
                    musicPlayer.addEventListener('loadedmetadata', function() {
                        musicPlayer.currentTime = 0; // Reset currentTime to 0
                        musicPlayer.play(); // Start playing the new track
                    });
                }
            </script>


            <!-- Music Score (Right Side) -->
            <div class="music-score">
                <!-- PDF or Lyrics Container -->
                <div class="pdf-container">
                    <!-- Canvas for PDF rendering -->
                    <div id="pdf-container"></div>
                </div>
            </div>

    </div>
</div>


<link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
<script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<!-- JavaScript/jQuery to handle tab switching -->
<script>
$(document).ready(function() {
    // Initial rendering based on active tab
    renderContent($('.tab-button.active').data('path'));


        // Handle tab button click
        $('.tab-button-mp3').click(function() {
        // Remove active class from all buttons
        $('.tab-button-mp3').removeClass('active');

        // Add active class to the clicked button
        $(this).addClass('active');
    });



    // Handle tab button click
    $('.tab-button').click(function() {
        // Remove active class from all buttons
        $('.tab-button').removeClass('active');

        // Add active class to the clicked button
        $(this).addClass('active');

        // Get the path from the button's data attribute
        var path = $(this).data('path');

        // Render content based on the clicked button's path
        renderContent(path);
    });

    // Function to render content (PDF or lyrics) based on path
    function renderContent(path) {
        if (path.toLowerCase().endsWith('.pdf')) {
            // Display PDF content
            renderPDF(path);
        } else {
            // Display lyrics content
            renderLyrics(path);
        }
    }

    // Function to render PDF content
    function renderPDF(pdfPath) {
        // Clear the PDF container
        $('#pdf-container').empty();

        // Use PDF.js to render the PDF
        pdfjsLib.getDocument(pdfPath).promise.then(function(pdf) {
            // Loop through each page and render it
            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                pdf.getPage(pageNum).then(function(page) {
                    var viewport = page.getViewport({ scale: 5.0 });
                    
                    // Create a canvas for each page
                    var canvas = document.createElement('canvas');
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    $('#pdf-container').append(canvas);

                    var context = canvas.getContext('2d');

                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };

                    page.render(renderContext);
                });
            }
        });
    }

// Function to render lyrics content
function renderLyrics(lyricsPath) {

    // Clear the PDF container and replace with lyrics content
    $('#pdf-container').html('<p>Loading lyrics...</p>');

    // Fetch the lyrics content from the server and display it
    $.ajax({
        url: lyricsPath,
        success: function(data) {
            $('#pdf-container').html('<pre style="white-space: pre-wrap; word-wrap: break-word; font-size: 18px;">' + data + '</pre>');
        },
        error: function() {
            $('#pdf-container').html('<p>Failed to load lyrics.</p>');
        }
    });
}

});
</script>

<style>
.fixedbutton {
  position: fixed;
  right: 4px;
  top: 50%;
  transform: translateY(-50%);
  display: flex;
  justify-content: center;
  align-items: center;
  width: 20px;
  height: 20px;
  padding: 0;
  border-radius: 50%;
  background-color: #blue-600;
  color: #white;
}


#playlistModal {
  max-width: 90vw;
  max-height: 90vh;
  overflow: hidden; /* Keep this to hide the horizontal scrollbar */
  overflow-y: auto;
  padding: 20px;
  margin: 20px auto;
  width: calc(100% - 80px);
  height: calc(100% - 80px);
  box-sizing: border-box;
  border-radius:10%;
  /* Add these styles to make it stick to the right side */
  right: 4px;
  top: 50%;
  transform: translateY(-50%);
  flex-direction: column;
  align-items: flex-end;
}

#closeModal {
  font-size: 18px;
  padding: 8px;
  border: none;
  background-color: #5eb8d3;
  cursor: pointer;
  right:0;
  top:0;
}

#closeModal:hover {
  color: #333; /* dark gray hover color */
}
/* Add media queries to adjust the modal size on different screen sizes */
@media (max-width: 1024px) { /* iPad landscape */
  #playlistModal {
    width: calc(100% - 40px);
    height: calc(100% - 40px);
  }
}

@media (max-width: 768px) { /* iPad portrait */
  #playlistModal {
    width: calc(100% - 20px);
    height: calc(100% - 20px);
  }
}

@media (max-width: 480px) { /* Mobile devices */
  #playlistModal {
    width: calc(100% - 10px);
    height: calc(100% - 10px);
  }
}
/* iPhone 12, 12 Mini, 13, 13 Mini */
@media only screen and (min-device-width: 375px) and (max-device-width: 667px) and (-webkit-min-device-pixel-ratio: 2) {
  #playlistModal {
    width: calc(100% - 20px);
    height: calc(100% - 20px);
  }
}

/* iPhone 12 Pro, 12 Pro Max, 13 Pro, 13 Pro Max */
@media only screen and (min-device-width: 414px) and (max-device-width: 896px) and (-webkit-min-device-pixel-ratio: 3) {
  #playlistModal {
    width: calc(100% - 20px);
    height: calc(100% - 20px);
  }
}
</style>

<!-- Fixed button icon -->
<button id="playlistButton" class="fixedbutton right-4 bg-blue-600 text-white p-4 rounded-full shadow-lg">
    <i class="fas fa-list"></i>
</button>

<div id="playlistModal" class="hidden fixed inset-0 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/2 relative" style="border: 4px solid #ccc;">
        <button id="closeModal" class="absolute top-0 right-0 mt-2 mr-2 px-4 py-2 bg-red-600 text-white rounded">
            <i class="fas fa-times"></i>
        </button>
        <h2 class="text-xl mb-4"><b>Playlists</b></h2>
        <div id="playlistsContent"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const playlistButton = document.getElementById('playlistButton');
    const playlistModal = document.getElementById('playlistModal');
    const closeModal = document.getElementById('closeModal');
    const playlistsContent = document.getElementById('playlistsContent');

    playlistButton.addEventListener('click', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const playlistId = urlParams.get('playlist_id');

        fetch(`/playlists?playlist_id=${playlistId}`)
            .then(response => response.json())
            .then(data => {
                let content = '';
                data.playlists.forEach(playlist => {
                    content += `<div class="mb-4">
                                    <h4 class="text-lg font-bold">${playlist.name}</h4>
                                    <table class="min-w-full mt-3 mb-3 table-auto w-full">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-2 bg-gray-50 text-center text-s font-large text-black uppercase tracking-wider">#</th>
                                                <th class="px-4 py-2 bg-gray-50 text-left text-s font-large text-black uppercase tracking-wider">Title</th>
                                                <th class="px-4 py-2 bg-gray-50 text-center text-s font-large text-black uppercase tracking-wider">Song Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>`;
                    playlist.musics.forEach((music, index) => {
                        content += `<tr>
                                        <td class="text-center border-b border-gray-300 px-4 py-2 whitespace-nowrap">${index + 1}</td>
                                        <td class="text-left border-b border-gray-300 px-4 py-2 whitespace-nowrap">
                                            <a href="/musics/${music.id}?playlist_id=${playlist.id}" class="text-blue-600 hover:underline">${music.title}</a>
                                        </td>
                                        <td class="text-center border-b border-gray-300 px-4 py-2 whitespace-nowrap">${music.song_number ?? '-'}</td>
                                    </tr>`;
                    });
                    content += `        </tbody>
                                    </table>
                                </div>`;
                });
                playlistsContent.innerHTML = content;
                playlistModal.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching playlists:', error);
            });
    });

    closeModal.addEventListener('click', function () {
        playlistModal.classList.add('hidden');
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === playlistModal) {
            playlistModal.classList.add('hidden');
        }
    });
});
</script>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>
