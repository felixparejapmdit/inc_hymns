src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"


document.addEventListener("DOMContentLoaded", function () {
    let sound;
    let isPlaying = false;
    let isSeeking = false;
    const progressBar = document.getElementById('progressBar');
    const playPauseButton = document.getElementById('playPauseButton');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const shuffleButton = document.getElementById('shuffleButton');
    const repeatButton = document.getElementById('repeatButton');
    const volumeSlider = document.getElementById('volumeSlider');
    const progressContainer = document.getElementById('progressContainer');
    const currentTimeDisplay = document.getElementById('currentTime');
    const totalTimeDisplay = document.getElementById('totalTime');
    const tabButtons = document.querySelectorAll('.tab-button-mp3');

    let shuffle = false;
    let repeat = false;

    if (playPauseButton) playPauseButton.addEventListener('click', togglePlayPause);
    if (prevButton) prevButton.addEventListener('click', prevTrack);
    if (nextButton) nextButton.addEventListener('click', nextTrack);
    if (shuffleButton) shuffleButton.addEventListener('click', toggleShuffle);
    if (repeatButton) repeatButton.addEventListener('click', toggleRepeat);
    if (volumeSlider) volumeSlider.addEventListener('input', changeVolume);
    if (progressContainer) {
        progressContainer.addEventListener('click', seekTrack);
        progressContainer.addEventListener('mousedown', () => {
            isSeeking = true;
        });
        progressContainer.addEventListener('mouseup', () => {
            isSeeking = false;
            updateProgressBar();
        });
    }

    if (typeof fileInput !== 'undefined' && fileInput) {
        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const objectURL = URL.createObjectURL(file);
                loadTrack(objectURL);
            }
        });
    }

    tabButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const path = button.getAttribute("data-path");
            console.log(`Loading track from path: ${path}`);  // Debugging message
            loadTrack(path);
        });
    });

    function loadTrack(src) {
        if (sound) {
            sound.unload();
        }
        sound = new Howl({
            src: [src],
            html5: true,
            onplay: () => {
                requestAnimationFrame(updateProgressBar);
                playPauseButton.textContent = '⏸️';
                isPlaying = true;
            },
            onload: () => {
                totalTimeDisplay.textContent = formatTime(sound.duration());
            },
            onend: () => {
                if (repeat) {
                    sound.play();
                } else {
                    nextTrack();
                }
            }
        });
        sound.play();
    }

    function togglePlayPause() {
        if (isPlaying) {
            sound.pause();
            playPauseButton.textContent = '▶️';
        } else {
            sound.play();
            playPauseButton.textContent = '⏸️';
        }
        isPlaying = !isPlaying;
    }

    function prevTrack() {
        sound.seek(0);
    }

    function nextTrack() {
        sound.seek(sound.duration());
    }

    function toggleShuffle() {
        shuffle = !shuffle;
        shuffleButton.style.color = shuffle ? '#4caf50' : 'white';
    }

    function toggleRepeat() {
        repeat = !repeat;
        repeatButton.style.color = repeat ? '#4caf50' : 'white';
    }

    function changeVolume() {
        sound.volume(volumeSlider.value);
    }

    function updateProgressBar() {
        if (!isSeeking) {
            const seek = sound.seek() || 0;
            const progressPercent = (seek / sound.duration()) * 100;
            progressBar.style.width = `${progressPercent}%`;
            currentTimeDisplay.textContent = formatTime(seek);
        }

        if (sound.playing()) {
            requestAnimationFrame(updateProgressBar);
        }
    }

    function seekTrack(event) {
        const width = progressContainer.offsetWidth;
        const clickX = event.offsetX;
        const duration = sound.duration();
        const seek = (clickX / width) * duration;
        sound.seek(seek);
        isSeeking = false;
        updateProgressBar(); // Immediately update progress bar after seeking
    }

    progressContainer.addEventListener('mousedown', () => {
        isSeeking = true;
    });

    progressContainer.addEventListener('mouseup', () => {
        isSeeking = false;
        updateProgressBar();
    });

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
    }
});