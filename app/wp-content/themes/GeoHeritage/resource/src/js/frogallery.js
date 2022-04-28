/**
 * Frogallery
 */
document.addEventListener("DOMContentLoaded", function () {
    class Frogallery {

        buttonClose;
        domElement;
        domElementLinks;
        frogallery;
        frogalleryImages = [];

        constructor(domElementSelector) {
            this.domElement = document.querySelector(domElementSelector);

            this.init();
        }

        attachFrogallery() {
            document.body.appendChild(this.frogallery);
        }

        buildFrogallery() {
            // create frogalleryBox element
            const frogalleryBox = document.createElement('div');
            frogalleryBox.classList.add('frogalleryBox');

            // append button close
            frogalleryBox.appendChild(this.buttonClose);

            // create and append inner
            const frogalleryBoxInner = document.createElement('div');
            frogalleryBoxInner.classList.add('frogalleryBox__inner');

            frogalleryBox.appendChild(frogalleryBoxInner);

            // append images
            this.frogalleryImages.forEach(item => {
                frogalleryBoxInner.appendChild(item);
            });

            // set generated gallery as class property
            this.frogallery = frogalleryBox;
        }

        handleDOMElement() {
            this.domElementLinks.forEach((item, index) => {
                item.dataset.src = item.href;
                item.dataset.target = `frogalleryItem${index}`;
                item.removeAttribute('href');
            });
        }

        init() {
            if (!this.validateMarkup()) {
                return false;
            }

            this.setProperties();
            this.handleDOMElement();
            this.buildFrogallery();
            this.attachFrogallery();
            this.initEventOpen();
            this.initEventClose();
        }

        initEventClose() {
            const onGalleryClose = () => {
                this.frogalleryImages.forEach(item => {
                    item.classList.remove('frogalleryBox__image_current');
                });

                setTimeout(() => {
                    this.frogallery.classList.remove('frogalleryBox_visible');
                }, 500);
            }

            // close on button click
            this.buttonClose.addEventListener('pointerdown', event => {
                onGalleryClose();
            });

            // close on inner outside area click
            this.frogallery.addEventListener('pointerdown', event => {
                if (!event.target.classList.contains('frogalleryBox')) {
                    return;
                }
                onGalleryClose();
            });
        }

        initEventOpen() {
            this.domElementLinks.forEach((item, index) => {
                item.addEventListener('pointerdown', event => {
                    event.preventDefault();

                    const target = item.dataset.target;

                    this.frogallery.classList.add('frogalleryBox_visible');

                    this.frogalleryImages.forEach(item => {
                        item.classList.remove('frogalleryBox__image_current');

                        if (item.classList.contains(target)) {
                            item.classList.add('frogalleryBox__image_current');
                        }
                    });
                })
            });
        }

        setProperties() {
            this.domElementLinks = this.domElement.querySelectorAll(':scope > a');

            // create frogallery images from domElement a-tag href-attribute value
            this.domElementLinks.forEach((item, index) => {
                const image = document.createElement('img');
                image.setAttribute('src', item.href);
                image.classList.add(`frogalleryBox__image`);
                image.classList.add(`frogalleryItem${index}`);

                this.frogalleryImages.push(image);
            });

            // create button close
            this.buttonClose = document.createElement('button');
            this.buttonClose.classList.add('frogalleryBox__buttonClose');
            this.buttonClose.innerHTML = `<svg class="frogalleryBox__buttonCloseIcon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19 19L1.00005 1" stroke="#52D858" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M19.0001 1L1 19.0001" stroke="#52D858" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>`;
        }

        validateMarkup() {
            if (!(this.domElement instanceof Object)) {
                return false;
            }
            return true;
        }
    }

    const frogallery = new Frogallery('.frogallery');
});