/**
 * Frogallery
 */
document.addEventListener("DOMContentLoaded", function () {
    class Frogallery {

        buttonClose;
        buttonNext;
        buttonPrev;
        domElement;
        domElementLinks;
        frogallery;
        frogalleryImages = [];
        itemCurrent;
        itemNext;
        itemPrev;

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

            // append navigation
            const frogalleryBoxNav = document.createElement('div');
            frogalleryBoxNav.classList.add('frogalleryBox__nav');
            frogalleryBoxNav.appendChild(this.buttonPrev);
            frogalleryBoxNav.appendChild(this.buttonNext);
            frogalleryBox.appendChild(frogalleryBoxNav);

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

        handleNavigation() {
            this.buttonNext.addEventListener('pointerdown', event => {
                // remove classes
                if (this.itemCurrent instanceof Object) {
                    this.itemCurrent.classList.remove('frogalleryBox__image_current');
                }

                if (this.itemNext instanceof Object) {
                    this.itemNext.classList.remove('frogalleryBox__image_next');
                }

                if (this.itemPrev instanceof Object) {
                    this.itemPrev.classList.remove('frogalleryBox__image_previous');
                }

                // set new elements
                if (this.itemCurrent instanceof Object) {
                    this.itemPrev = this.itemCurrent;
                    this.itemPrev.classList.add('frogalleryBox__image_previous');
                }

                if (this.itemNext instanceof Object) {
                    this.itemCurrent = this.itemNext;
                    this.itemCurrent.classList.add('frogalleryBox__image_current');
                }

                if (this.itemNext.nextSibling instanceof Object) {
                    this.itemNext = this.itemNext.nextSibling;
                    this.itemNext.classList.add('frogalleryBox__image_next');
                } else {
                    this.itemNext = this.frogalleryImages[0];
                    this.itemNext.classList.add('frogalleryBox__image_next');
                }
            });

            this.buttonPrev.addEventListener('pointerdown', event => {
                // remove classes
                if (this.itemCurrent instanceof Object) {
                    this.itemCurrent.classList.remove('frogalleryBox__image_current');
                }

                if (this.itemNext instanceof Object) {
                    this.itemNext.classList.remove('frogalleryBox__image_next');
                }

                if (this.itemPrev instanceof Object) {
                    this.itemPrev.classList.remove('frogalleryBox__image_previous');
                }

                // set new elements
                if (this.itemCurrent instanceof Object) {
                    this.itemNext = this.itemCurrent;
                    this.itemNext.classList.add('frogalleryBox__image_next');
                }

                if (this.itemPrev instanceof Object) {
                    this.itemCurrent = this.itemPrev;
                    this.itemCurrent.classList.add('frogalleryBox__image_current');
                }

                if (this.itemPrev.previousSibling instanceof Object) {
                    this.itemPrev = this.itemPrev.previousSibling;
                    this.itemPrev.classList.add('frogalleryBox__image_previous');
                } else {
                    this.itemPrev = this.frogalleryImages[this.frogalleryImages.length - 1];
                    this.itemPrev.classList.add('frogalleryBox__image_previous');
                }
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
            this.handleNavigation();
        }

        initEventClose() {
            const onGalleryClose = () => {
                this.frogalleryImages.forEach(item => {
                    this.itemCurrent = null;
                    this.itemNext = null;
                    this.itemPrev = null;

                    item.classList.remove('frogalleryBox__image_current', 'frogalleryBox__image_previous', 'frogalleryBox__image_next');
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

                        if (!item.classList.contains(target)) {
                            return;
                        }

                        this.itemCurrent = item;
                        item.classList.add('frogalleryBox__image_current');

                        if (item.nextSibling instanceof Object) {
                            this.itemNext = item.nextSibling;
                            item.nextSibling.classList.add('frogalleryBox__image_next');
                        }

                        if (item.previousSibling instanceof Object) {
                            this.itemPrev = item.previousSibling;
                            item.previousSibling.classList.add('frogalleryBox__image_previous');
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
                image.classList.add(`frogalleryBox__image`, `frogalleryItem${index}`);

                this.frogalleryImages.push(image);
            });

            // create button close
            this.buttonClose = document.createElement('button');
            this.buttonClose.classList.add('frogalleryBox__buttonClose');
            this.buttonClose.innerHTML = `<svg class="frogalleryBox__buttonCloseIcon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19 19L1.00005 1" stroke="#52D858" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M19.0001 1L1 19.0001" stroke="#52D858" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>`;

            // create button nav prev
            this.buttonPrev = document.createElement('button');
            this.buttonPrev.classList.add('frogalleryBox__navButton', 'frogalleryBox__buttonPrev');
            this.buttonPrev.innerHTML = `<svg class="frogalleryBox__navButtonIcon" width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.29289 15.7071C7.68342 16.0976 8.31658 16.0976 8.70711 15.7071C9.09763 15.3166 9.09763 14.6834 8.70711 14.2929L7.29289 15.7071ZM1 8L0.292893 7.29289C-0.0976311 7.68342 -0.0976311 8.31658 0.292893 8.70711L1 8ZM8.70711 1.70711C9.09763 1.31658 9.09763 0.683417 8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L8.70711 1.70711ZM8.70711 14.2929L1.70711 7.29289L0.292893 8.70711L7.29289 15.7071L8.70711 14.2929ZM1.70711 8.70711L8.70711 1.70711L7.29289 0.292893L0.292893 7.29289L1.70711 8.70711Z" fill="#52D858"/>
                                        </svg>`;

            // create button nav next
            this.buttonNext = document.createElement('button');
            this.buttonNext.classList.add('frogalleryBox__navButton', 'frogalleryBox__buttonNext');
            this.buttonNext.innerHTML = `<svg class="frogalleryBox__navButtonIcon" width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.70711 0.292893C1.31658 -0.0976311 0.683417 -0.0976311 0.292893 0.292893C-0.0976311 0.683417 -0.0976311 1.31658 0.292893 1.70711L1.70711 0.292893ZM8 8L8.70711 8.70711C9.09763 8.31658 9.09763 7.68342 8.70711 7.29289L8 8ZM0.292893 14.2929C-0.0976311 14.6834 -0.0976311 15.3166 0.292893 15.7071C0.683417 16.0976 1.31658 16.0976 1.70711 15.7071L0.292893 14.2929ZM0.292893 1.70711L7.29289 8.70711L8.70711 7.29289L1.70711 0.292893L0.292893 1.70711ZM7.29289 7.29289L0.292893 14.2929L1.70711 15.7071L8.70711 8.70711L7.29289 7.29289Z" fill="#52D858"/>
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