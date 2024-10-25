
    const slides = [
        "/assets/image/main/01pyixtjzfd0eibvn3d99o3832.jpg",
        "/assets/image/main/banner-2.jpeg",
        "/assets/image/main/OIP (1).jpg",
        "/assets/image/main/frasco-de-spray-de-perfume-no-banner-do-ceu-nublado_33099-2220.avif",
    ];
    
    let current = 0;

    const img = document.getElementById('slide-image'); 

   function startSlide() {
    img.setAttribute('src', slides[current]); 
    autoSlide(); 
}
    function nextSlide() {
        current++;
        if (current >= slides.length) {
            current = 0; // Quay lại đầu
        }
        img.setAttribute('src', slides[current]);
    }

    function prevSlide() {
        current--;
        if (current < 0) {
            current = slides.length - 1; 
        }
        img.setAttribute('src', slides[current]);
    }

   let auto;
function autoSlide() {
    auto = setInterval(nextSlide, 2000); 
}


    window.onload = startSlide; // Bắt đầu slideshow khi trang được tải

// chuyển flash
document.addEventListener("DOMContentLoaded", function() {
    const flashBox = document.querySelector(".flash_box");

    // Hàm cuộn phải
    function scrollRight() {
        flashBox.scrollBy({
            left: 200, // Điều chỉnh khoảng cách cuộn
            behavior: 'smooth'
        });
    }

    // Hàm cuộn trái
    function scrollLeft() {
        flashBox.scrollBy({
            left: -200, // Điều chỉnh khoảng cách cuộn
            behavior: 'smooth'
        });
    }

    // Event Listener cho nút chuyển trái/phải
    document.querySelector(".btn-left").addEventListener("click", scrollLeft);
    document.querySelector(".btn-right").addEventListener("click", scrollRight);

    // Kéo ngang để cuộn
    let isDown = false;
    let startX;
    let scrollLeftPosition;

    flashBox.addEventListener("mousedown", (e) => {
        isDown = true;
        startX = e.pageX - flashBox.offsetLeft;
        scrollLeftPosition = flashBox.scrollLeft;
    });

    flashBox.addEventListener("mouseleave", () => {
        isDown = false;
    });

    flashBox.addEventListener("mouseup", () => {
        isDown = false;
    });

    flashBox.addEventListener("mousemove", (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - flashBox.offsetLeft;
        const walk = (x - startX) * 2; // Tốc độ cuộn
        flashBox.scrollLeft = scrollLeftPosition - walk;
    });
});
