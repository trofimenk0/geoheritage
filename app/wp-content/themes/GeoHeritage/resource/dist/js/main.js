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
$(function () {
  /*
   Livesearch
  */
  $('#searchform').on('submit', function (event) {
    event.preventDefault();
  });

  $('.header__searchSubmit').on('focus', function () {
    if (!$('.header__searchForm').hasClass('header__searchForm_active')) {
      $('.header__searchForm').addClass('header__searchForm_active').css('display', 'flex').hide().fadeIn(300);
      return;
    }
  });

  $(document).on('click', function (event) {
    let target = event.target;
    if (
      !$(target).parents().is('.header__search') &&
      $('.header__searchForm').hasClass('header__searchForm_active')
    ) {
      $('.header__searchForm').removeClass('header__searchForm_active').fadeOut(300);
    }
  });

  /**
   * Mobile menu
   */
  $('.header__buttonMenu').on('focus', function () {
    if (!$('.header__primaryMenu').hasClass('header__primaryMenu_active')) {
      $('.header__primaryMenu').addClass('header__primaryMenu_active').css('display', 'flex').hide().fadeIn(300);
      return;
    }
  });

  $(document).on('click', function (event) {
    let target = event.target;
    if (
      !$(target).is('.header__primaryMenu') &&
      !$(target).parents().is('.header__primaryMenu') &&
      !$(target).is('.header__buttonMenu') &&
      !$(target).parents().is('.header__buttonMenu') &&
      $('.header__primaryMenu').hasClass('header__primaryMenu_active')
    ) {
      $('.header__primaryMenu').removeClass('header__primaryMenu_active').fadeOut(300);
    }
  });

  /*
   Header
  */
  window.onscroll = function () {
    if (
      document.body.scrollTop > 100 ||
      document.documentElement.scrollTop > 100
    ) {
      $('.header').addClass('header_scrolling');
      $('.custom-logo-link').addClass('custom-logo-link_small');
    } else {
      $('.header').removeClass('header_scrolling');
      $('.custom-logo-link').removeClass('custom-logo-link_small');
    }
  };

  /*
   Single Monument Gallery
  */


  /**
   * About partners emblems effect
   */
  $(document).on('mousemove', function (event) {
    let xAxis = (window.innerWidth / 2 - event.clientX) / 50;
    let yAxis = (window.innerHeight / 2 - event.clientY) / 50;

    $('.aboutPartners__itemLogo').css('transform', `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`);
  });

  /**
   * About developer photo effect
   */
  $(document).on('mousemove', function (event) {
    let xAxis = (window.innerWidth / 2 - event.clientX) / 100;
    let yAxis = (window.innerHeight / 2 - event.clientY) / 100;

    $('.aboutDeveloper__photo').css('transform', `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`);
  });

});

/**
 * Regions read more
 */
const geoheritageSlideDown = element => element.style.height = `${element.scrollHeight}px`;

function regionReadMoreHandler() {
  let button = document.querySelectorAll('.region__descriptionButton');
  if (button.length <= 0) {
    return;
  }

  button.forEach(item => {
    item.addEventListener('pointerdown', event => {
      geoheritageSlideDown(item.closest('.region__descriptionContent'));
      item.style.display = 'none';
    });
  });
}
regionReadMoreHandler();


























/*
 Preloader
*/
// window.addEventListener('load', (event) => {
//   const preloader = document.getElementById("preloader");
//   preloader.style.opacity = '0';
//   preloader.addEventListener('transitionend', function () {
//     preloader.style.display = 'none'
//   });
// });





// // SMOOTH SCROLL MOUSE WEEL 
// SmoothScroll({
//   // Время скролла 400 = 0.4 секунды
//   animationTime: 800,
//   // Размер шага в пикселях
//   stepSize: 75,

//   // Дополнительные настройки:

//   // Ускорение
//   accelerationDelta: 30,
//   // Максимальное ускорение
//   accelerationMax: 2,

//   // Поддержка клавиатуры
//   keyboardSupport: true,
//   // Шаг скролла стрелками на клавиатуре в пикселях
//   arrowScroll: 50,

//   // Pulse (less tweakable)
//   // ratio of "tail" to "acceleration"
//   pulseAlgorithm: true,
//   pulseScale: 4,
//   pulseNormalize: 1,

//   // Поддержка тачпада
//   touchpadSupport: true,
// })











//  SMOOTH SCROLL TO ANCHORS 
// const links = document.querySelectorAll('#mainMenu a');

// if (links) {

//   // Add event listener to all links
//   links.forEach(function (elem) {
//     elem.addEventListener('click', smoothScroll)
//   });

//   // Magic function to scroll smooth!
//   function smoothScroll(e) {
//     // Prevent default anchor behaviour
//     e.preventDefault();

//     // Get clicked links href attribute
//     const link = this.getAttribute("href");

//     // Get the targets position
//     const offsetTop = document.querySelector(link).offsetTop;

//     // Finally scroll to target
//     scroll({
//       top: offsetTop,
//       behavior: "smooth"
//     });
//   }

// }





//  MOBILE MENU 
// document.getElementById("btnMobileMenu").addEventListener("click", function () {
//   this.classList.toggle("active");
//   document.getElementById("header").classList.toggle("menuActive");
// });


//  START UKRAINE MAP 
// const map = document.querySelector("#map");

// if(map) {

//   const scene = new THREE.Scene();
//   const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
//   const renderer = new THREE.WebGLRenderer({ antialias: true, canvas: map,});
//   renderer.setSize( window.innerWidth, window.innerHeight );

// }



// BACKUP ===========================================================================================================================

//  START UKRAINE MAP 

// let mapWrapper = document.querySelector("#map");

// if (mapWrapper) {
//   // STATEMENT
//   let scene, camera, renderer, mouseX = 0, mouseY = 0, windowHalfX = window.innerWidth / 2, windowHalfY = window.innerHeight / 2;

//   // let stats;

//   // RAYCASTER
//   const raycaster = new THREE.Raycaster();
//   const mouse = new THREE.Vector2();

//   // SCENE
//   scene = new THREE.Scene();
//   scene.background = new THREE.Color(0xffffff);

//   // stats = new Stats();
//   // document.body.appendChild( stats.dom ); 

//   // CAMERA
//   camera = new THREE.PerspectiveCamera(40, window.innerWidth / window.innerHeight, 1, 1000);
//   camera.position.set(0, 0, 4.6);

//   // RENDERER
//   renderer = new THREE.WebGLRenderer({
//     antialias: true,
//     canvas: mapWrapper,
//   });
//   renderer.setSize(window.innerWidth, window.innerHeight);
//   renderer.setPixelRatio(window.devicePixelRatio);

//   // LIGHT
//   let ambint = new THREE.AmbientLight(0xffffff, 1);
//   scene.add(ambint);

//   let directionalLightMap = new THREE.DirectionalLight(0xfff59d, 0.4);
//   directionalLightMap.position.set(0, 10, 10);
//   scene.add(directionalLightMap);

//   let directionalLightGround = new THREE.DirectionalLight(0xffffff, 1);
//   directionalLightGround.position.set(0, -2, 0);
//   scene.add(directionalLightGround);

//   // const helper = new THREE.DirectionalLightHelper( directionalLightGround, 5 );
//   // scene.add( helper );

//   // SCENE BACKGROUND
//   // {
//   //   const loader = new THREE.TextureLoader();
//   //   const texture = loader.load(
//   //   'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1diVDbu32oEsy2Rk6cDvySUzUScFZtleRmA&usqp=CAU',
//   //   () => {
//   //     const rt = new THREE.WebGLCubeRenderTarget(texture.image.height);
//   //     rt.fromEquirectangularTexture(renderer, texture);
//   //     scene.background = rt.texture;
//   //   });
//   // }

//   // LOADER
//   let loader = new THREE.GLTFLoader();
//   loader.load(
//     // resource URL
//     mapWrapper.dataset.model,

//     // called when the resource is loaded
//     function (gltf) {
//       gltf.scene.rotation.set(1.2, 0, 0);
//       scene.add(gltf.scene);
//     },

//     // called while loading is progressing
//     // function ( xhr ) {},

//     // called when loading has errors
//     // function ( error ) {}
//   );

//   // 3D MODEL MOUSEMOVE
//   function animate() {
//     requestAnimationFrame(animate);
//     renderer.render(scene, camera);
//     // stats.update();
//   }
//   animate();

//   // MOVE CAMERA
//   mapWrapper.addEventListener("mousemove", cameraMouseMove);
//   function cameraMouseMove(event) {

//     mouseX = event.clientX - windowHalfX;
//     mouseY = event.clientY - windowHalfY;

//     camera.position.x += (mouseX / 500 - camera.position.x) * 0.1;
//     camera.position.y += (-(mouseY / 500) - camera.position.y) * 0.1;
//     camera.lookAt(scene.position);

//   }

//   // RESIZE WINDOW -> RESIZE MAP
//   function onWindowResize() {
//     camera.aspect = window.innerWidth / window.innerHeight;
//     camera.updateProjectionMatrix();
//     renderer.setSize(window.innerWidth, window.innerHeight);
//   }
//   window.addEventListener('resize', onWindowResize);

//   // REGION CLICK
//   function regionClick(event) {
//     mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
//     mouse.y = - (event.clientY / window.innerHeight) * 2 + 1;

//     // raycaster
//     raycaster.setFromCamera(mouse, camera);
//     const intersects = raycaster.intersectObjects(scene.children, true);

//     console.log(intersects[0].object.name)
//     if (intersects[0] != undefined) {
//       switch (intersects[0].object.parent.name) {
//         case "CherkassyOblast": window.location.href = '/category/cherkasy/';
//           break;
//         case "ChernigivOblast": window.location.href = '/category/chernihiv/';
//           break;
//         case "ChernivtsiOblast": window.location.href = '/category/chernivtsi/';
//           break;
//         case "CrimeaOblast": window.location.href = '';
//           break;
//         case "DniproOblast": window.location.href = '/category/dnipropetrovsk/';
//           break;
//         case "DonetskOblast": window.location.href = '/category/donetsk/';
//           break;
//         case "IvanoFrankivskOblast": window.location.href = '/category/ivano-frankivsk/';
//           break;
//         case "KharkivOblast": window.location.href = '/category/kharkiv/';
//           break;
//         case "KhersonOblast": window.location.href = '/category/kherson/';
//           break;
//         case "KhmalnitskiyOblast": window.location.href = '/category/khmelnytskyi/';
//           break;
//         case "KyivOblast": window.location.href = '/category/kyiv/';
//           break;
//         case "KirovohradOblast": window.location.href = '/category/kirovohrad/';
//           break;
//         case "LuganskOblast": window.location.href = '/category/luhansk/';
//           break;
//         case "LvivOblast": window.location.href = '/category/lviv/';
//           break;
//         case "MykolaivOblast": window.location.href = '/category/mykolaiv/';
//           break;
//         case "OdessaOblast": window.location.href = '/category/odessa/';
//           break;
//         case "PoltavaOblast": window.location.href = '/category/poltava/';
//           break;
//         case "RivneOblast": window.location.href = '/category/rivne/';
//           break;
//         case "SummyOblast": window.location.href = '/category/sumy/';
//           break;
//         case "TernopilOblast": window.location.href = '/category/ternopil/';
//           break;
//         case "VinnitsiaOblast": window.location.href = '/category/vinnytsia/';
//           break;
//         case "VolynOblast": window.location.href = '/category/volyn/';
//           break;
//         case "ZakarpattyaOblast": window.location.href = '/category/zakarpattia/';
//           break;
//         case "ZaporizhyaOblast": window.location.href = '/category/zaporizhzhia/';
//           break;
//         case "ZhytomyrOblast": window.location.href = '/category/zhytomyr/';
//           break;
//       }
//     }
//   }
//   mapWrapper.addEventListener('click', regionClick, false);

// }
//  END UKRAINE MAP 



//  START PARALLAX 
// let regionsList = document.querySelector("#regions .list");

// let parallaxAreas = [];

// parallaxAreas.push(regionsList);

// parallaxAreas.forEach(function (item, index, array) {
//   if (!!item) {
//     let parallaxInstance = new Parallax(item, {
//       relativeInput: true,
//       hoverOnly: true,
//       pointerEvents: true
//     });
//   }
// });
//  END PARALLAX 
