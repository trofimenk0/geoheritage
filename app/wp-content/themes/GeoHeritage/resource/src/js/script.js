$(function () {

    /*
     Livesearch
    */
    $( '.header__searchSubmit' ).on( 'focus', function() {
        if ( ! $( '.header__searchForm' ).hasClass( 'header__searchForm_active' ) ) {
            $( '.header__searchForm' ).addClass( 'header__searchForm_active' ).css( 'display', 'flex' ).hide().fadeIn( 300 );
            return;
        }
    } );

    $( document ).on( 'click', function( event ) {
        let target = event.target;
        if ( ! $( target ).parents().is( '.header__search' ) ) {
            $( '.header__searchForm' ).removeClass( 'header__searchForm_active' ).fadeOut( 300 );
        }
    } );


    /*
     Header
    */  
    window.onscroll = function () {
      if (
        document.body.scrollTop > 100 ||
        document.documentElement.scrollTop > 100
      ) {
        $( '.header' ).addClass( 'header_scrolling' );
        $( '.custom-logo-link' ).addClass( 'custom-logo-link_small' );
      } else {
        $( '.header' ).removeClass( 'header_scrolling' );
        $( '.custom-logo-link' ).removeClass( 'custom-logo-link_small' );
      }
    };

});



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





// LIGHTGALLERY
// const lightGalleryWrapper = document.getElementById("lightgallery");
// lightGallery(lightGalleryWrapper);





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
