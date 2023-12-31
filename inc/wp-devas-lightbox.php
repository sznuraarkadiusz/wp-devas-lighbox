<?php
/*
Function name: WP DEVAS Lightbox
Github URI: https://github.com/sznuraarkadiusz/wp-devas-lighbox
Description: Simple Wordpress function that allows you to implement a lightbox into the Gutenberg "Gallery" block.
Version: 1.0
Author: DEVAS Arkadiusz Sznura
Author URI: https://github.com/sznuraarkadiusz, https://devas.pl/
*/

function wp_devas_lightbox() {
    ?>
    <style>
        #devas-lightbox-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .devas-lightbox-content {
            position: relative;
            text-align: center;
        }

        #devas-lightbox-image {
            max-width: 80%;
            max-height: 80vh;
            margin: 0 auto;
            display: block;
        }

        .devas-lightbox-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 30px;
            color: #fff;
            cursor: pointer;
        }

        .devas-lightbox-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .devas-lightbox-nav button {
            font-size: 24px;
            color: #fff;
            background: none;
            border: none;
            cursor: pointer;
        }
    </style>

    <div id="devas-lightbox-container">
        <div class="devas-lightbox-content">
            <img id="devas-lightbox-image" src=""">
            <span class="devas-lightbox-close" onclick="closeDEVASLightbox()">&times;</span>
            <div class="devas-lightbox-nav">
                <button onclick="navigateDEVASLightbox(-1, event)">&#10094;</button>
                <button onclick="navigateDEVASLightbox(1, event)">&#10095;</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var images = document.querySelectorAll('.blocks-gallery-item img, .wp-block-gallery img');
            var lightboxContainer = document.getElementById('devas-lightbox-container');
            var lightboxImage = document.getElementById('devas-lightbox-image');
            var currentIndex = 0;

            images.forEach(function(image, index) {
                image.addEventListener('click', function() {
                    currentIndex = index;
                    updateDEVASLightboxImage();
                    lightboxContainer.style.display = 'flex';
                });
            });

            lightboxContainer.addEventListener('click', function() {
                lightboxContainer.style.display = 'none';
            });

            function closeDEVASLightbox() {
                lightboxContainer.style.display = 'none';
            }

            function navigateDEVASLightbox(direction, event) {
                event.stopPropagation();
                currentIndex = (currentIndex + direction + images.length) % images.length;
                updateDEVASLightboxImage();
            }

            function updateDEVASLightboxImage() {
                lightboxImage.src = images[currentIndex].src;
            }

            window.navigateDEVASLightbox = navigateDEVASLightbox;
        });
    </script>
    <?php
}
add_action('wp_footer', 'wp_devas_lightbox');
?>