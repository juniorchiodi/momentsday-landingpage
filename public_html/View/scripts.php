<script>
    const video = document.getElementById('Video');
    const btn = document.getElementById('soundBtn');
    btn.addEventListener('click', () => {
        if (video.muted === false) {
            video.muted = true;
            btn.textContent = "🔊 Ativar Som";
        } else {
            video.muted = false;
            video.play();
            btn.textContent = "🔇 Desativar Som";
        }
    });
</script>

<script>
    const scrollTopBtn = document.getElementById("scrollTopBtn");

    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            scrollTopBtn.classList.add("show");
        } else {
            scrollTopBtn.classList.remove("show");
        }
    });

    function scrollToTop() {
        const currentPosition = window.pageYOffset;
        const targetPosition = 0;
        const distance = targetPosition - currentPosition;
        const duration = 1000;
        let start = null;

        function animation(currentTime) {
            if (start === null) start = currentTime;
            const timeElapsed = currentTime - start;
            const progress = Math.min(timeElapsed / duration, 1);
            
            const easeInOutCubic = progress => {
                return progress < 0.5
                    ? 4 * progress * progress * progress
                    : 1 - Math.pow(-2 * progress + 2, 3) / 2;
            };

            window.scrollTo(0, currentPosition + distance * easeInOutCubic(progress));

            if (timeElapsed < duration) {
                requestAnimationFrame(animation);
            }
        }

        requestAnimationFrame(animation);
    }

    scrollTopBtn.addEventListener("click", scrollToTop);
</script>

<script>
    function toggleGallery() {
      const gallery = document.querySelector('.gallery');
      const button = document.querySelector('.gallery-button');
      const passoAPasso = document.querySelector('h1.passo-a-passo-title');
      
      gallery.classList.toggle('expanded');
      button.classList.toggle('expanded');
      
      if (gallery.classList.contains('expanded')) {
        button.innerHTML = 'Ver menos fotos <i class="fas fa-chevron-up"></i>';
      } else {
        button.innerHTML = 'Ver mais fotos <i class="fas fa-chevron-down"></i>';
      }
    }
</script>