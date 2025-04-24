let video = document.getElementById('camera');
let cameraContainer = document.getElementById('cameraContainer');
let useFrontCamera = true;
let stream = null;

// Fungsi memulai kamera
function startCamera() {
    const constraints = {
        video: {
            facingMode: useFrontCamera ? "user" : "environment"
        }
    };

    cameraContainer.style.display = 'block';

    navigator.mediaDevices.getUserMedia(constraints)
        .then(function (mediaStream) {
            stream = mediaStream;
            video.srcObject = stream;
            video.play();

            if (useFrontCamera) {
                video.classList.add('mirror');
            } else {
                video.classList.remove('mirror');
            }
        })
        .catch(function (err) {
            console.error("Error accessing camera:", err);
            alert("Kamera tidak dapat diakses.");
        });
}

function stopCamera() {
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
    }
    video.srcObject = null;
    cameraContainer.style.display = 'none';
}

function flipCamera() {
    useFrontCamera = !useFrontCamera;
    stopCamera();
    startCamera();
}

function toggleMirror() {
    video.classList.toggle('mirror');
}

// Fungsi ambil snapshot dan tambahkan ke galeri
function takeSnapshot() {
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const imageDataURL = canvas.toDataURL('image/png');

    const gallery = document.getElementById('gallery');

    const galleryItem = document.createElement('div');
    galleryItem.className = 'gallery-item border rounded p-2 mb-3';

    const img = document.createElement('img');
    img.src = imageDataURL;
    img.alt = 'Snapshot';
    img.className = 'img-thumbnail';
    img.style.width = '150px';

    const textarea = document.createElement('textarea');
    textarea.placeholder = 'Keterangan...';
    textarea.className = 'form-control mt-2';
    textarea.rows = 2;

    const select = document.createElement('select');
    select.className = 'form-select mt-2';
    select.innerHTML = `
        <option value="" disabled selected>Pilih jenis</option>
        <option value="Buku">Buku</option>
        <option value="Film">Film</option>
        <option value="Game">Game</option>
        <option value="Musik">Musik</option>
    `;

    // Simpan data sebagai atribut (bisa diambil saat submit)
    galleryItem.setAttribute('data-image', imageDataURL);

    galleryItem.appendChild(img);
    galleryItem.appendChild(textarea);
    galleryItem.appendChild(select);
    gallery.appendChild(galleryItem);
}

// Fungsi kirim semua foto dengan detail
function submitAllPhotos() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const photosData = [];

    galleryItems.forEach(item => {
        const image = item.getAttribute('data-image');
        const description = item.querySelector('textarea').value;
        const category = item.querySelector('select').value;

        if (!description || !category) {
            alert("Harap lengkapi semua deskripsi dan kategori sebelum mengirim.");
            return;
        }

        photosData.push({
            image,
            description,
            category
        });
    });

    // Tampilkan data di console (atau kirim ke server di sini)
    console.log('Foto yang akan dikirim:', photosData);
    alert('Semua foto berhasil disiapkan untuk dikirim.');

    // Di sini kamu bisa pakai AJAX untuk kirim ke server
}
function takeSnapshot() {
    const canvas = document.createElement('canvas');
    const video = document.getElementById('camera');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const imageDataURL = canvas.toDataURL('image/png');

    // Tambahkan gambar ke galeri
    const gallery = document.getElementById('gallery');
    const galleryItem = document.createElement('div');
    galleryItem.className = 'gallery-item';

    const img = document.createElement('img');
    img.src = imageDataURL;
    img.alt = 'Snapshot';

    const textarea = document.createElement('textarea');
    textarea.placeholder = 'Tambahkan keterangan...';
    textarea.rows = 2;

    const select = document.createElement('select');
    select.className = 'form-select mt-2';
    select.innerHTML = `
        <option value="" disabled selected>Pilih genre</option>
        <option value="Buku">Buku</option>
        <option value="Film">Film</option>
        <option value="Game">Game</option>
        <option value="Musik">Musik</option>
    `;

    galleryItem.appendChild(img);
    galleryItem.appendChild(textarea);
    galleryItem.appendChild(select);
    gallery.appendChild(galleryItem);
}

function submitDetails() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const photosData = [];

    galleryItems.forEach(item => {
        const image = item.querySelector('img').src;
        const description = item.querySelector('textarea').value;
        const category = item.querySelector('select').value;

        if (!description || !category) {
            alert('Harap lengkapi deskripsi dan genre untuk semua gambar.');
            return;
        }

        photosData.push({
            image,
            description,
            category
        });
    });

    console.log('Data yang akan dikirim:', photosData);
    alert('Semua data berhasil disiapkan untuk dikirim.');
    // Tambahkan logika pengiriman data ke server di sini
}