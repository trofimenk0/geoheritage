/**
 * Fogallery
 */
document.addEventListener("DOMContentLoaded", function () {
    class Fogallery {

        domGalleryLinks = '';
        galleryImageSrc = [];
        fogalleryGenerated = '';

        constructor(domGallery) {
            this.domGallery = document.querySelector(domGallery);

            if (!this.validateMarkup()) {
                return;
            }

            this.setProperties();
            this.handleGalleryLinks();
            this.generateFogallery();
            this.attachFogallery();
            this.initOpening();
            this.initClosing();
        }

        attachFogallery() {
            document.body.appendChild(this.fogalleryGenerated);
        }

        generateFogallery() {
            // create fogalleryBox element
            const fogalleryBox = document.createElement('div');
            fogalleryBox.classList.add('fogalleryBox');

            fogalleryBox.appendChild(this.buttonClose);

            const fogalleryBoxInner = document.createElement('div');
            fogalleryBoxInner.classList.add('fogalleryBox__inner');

            fogalleryBox.appendChild(fogalleryBoxInner);

            // set all full size images for fogalleryBox
            this.galleryImageSrc.forEach((item, index) => {
                const image = document.createElement('img');
                image.setAttribute('src', item);
                image.classList.add(`fogalleryBox__image`);
                image.classList.add(`fogalleryItem${index}`);

                fogalleryBoxInner.appendChild(image);
            });

            // set generated gallery as class property
            this.fogalleryGenerated = fogalleryBox;
        }

        handleGalleryLinks() {
            this.domGalleryLinks.forEach((item, index) => {
                item.dataset.src = item.href;
                item.dataset.target = `fogalleryItem${index}`;
                item.removeAttribute('href');
            });
        }

        initClosing() {
            const fogalleryImages = this.fogalleryGenerated.querySelectorAll('.fogalleryBox__image');

            const onGalleryClose = () => {
                fogalleryImages.forEach(item => {
                    item.classList.remove('fogalleryBox__image_current');
                });

                setTimeout(() => {
                    this.fogalleryGenerated.classList.remove('fogalleryBox_visible');
                }, 500);
            }

            this.fogalleryGenerated.addEventListener('pointerdown', event => {
                if (!event.target.classList.contains('fogalleryBox')) {
                    return;
                }

                onGalleryClose();
            });

            this.buttonClose.addEventListener('pointerdown', event => {
                onGalleryClose();
            });
        }

        initOpening() {
            this.domGalleryLinks.forEach((item, index) => {
                item.addEventListener('pointerdown', event => {
                    event.preventDefault();

                    const target = item.dataset.target;
                    const fogalleryImages = this.fogalleryGenerated.querySelectorAll('.fogalleryBox__image');

                    this.fogalleryGenerated.classList.add('fogalleryBox_visible');

                    fogalleryImages.forEach(item => {
                        item.classList.remove('fogalleryBox__image_current');

                        if (item.classList.contains(target)) {
                            item.classList.add('fogalleryBox__image_current');
                        }
                    });
                })
            });
        }

        setProperties() {
            this.domGalleryLinks = this.domGallery.querySelectorAll(':scope > a');

            this.domGalleryLinks.forEach(item => {
                this.galleryImageSrc.push(item.href);
            });

            // add buttonClose to generated gallery
            this.buttonClose = document.createElement('button');
            this.buttonClose.classList.add('fogalleryBox__buttonClose');
            this.buttonClose.innerHTML = `<svg class="fogalleryBox__buttonCloseIcon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19 19L1.00005 1" stroke="#52D858" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M19.0001 1L1 19.0001" stroke="#52D858" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>`;
        }

        validateMarkup() {
            if (!(this.domGallery instanceof Object)) {
                return false;
            }
            return true;
        }

    }

    const fogallery = new Fogallery('.fogallery');
});