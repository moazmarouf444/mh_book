<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        ::-webkit-scrollbar {
            width: 10px;
            /* height: 10px; */
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #383636;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgb(26, 24, 24);
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        body{
            min-height: calc(3000px + 100vh);
        }
        section.book{
            position: fixed;
            top: 0;
            left: 0;
        }

        .back-link{
            position: fixed;
            top: 10px;
            right: 20px;
            background: #000;
            z-index: 8;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            padding: 10px;
            opacity: .3;
        }

        /*HTML CSSResult Skip Results Iframe*/
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            width: 100%;
            height: 100%;
            background: #333;
        }

        .container {
            position: relative;
            width: 24px;
            height: 24px;
        }

        .chevron {
            position: absolute;
            width: 28px;
            height: 8px;
            opacity: 0;
            transform: scale3d(0.5, 0.5, 0.5);
            animation: move 3s ease-out infinite;
        }

        .chevron:first-child {
            animation: move 3s ease-out 1s infinite;
        }

        .chevron:nth-child(2) {
            animation: move 3s ease-out 2s infinite;
        }

        .chevron:before,
        .chevron:after {
            content: ' ';
            position: absolute;
            top: 0;
            height: 100%;
            width: 51%;
            background: #000;
        }

        .chevron:before {
            left: 0;
            transform: skew(0deg, 30deg);
        }

        .chevron:after {
            right: 0;
            width: 50%;
            transform: skew(0deg, -30deg);
        }

        @keyframes move {
            25% {
                opacity: 1;

            }
            33% {
                opacity: 1;
                transform: translateY(30px);
            }
            67% {
                opacity: 1;
                transform: translateY(40px);
            }
            100% {
                opacity: 0;
                transform: translateY(55px) scale3d(0.5, 0.5, 0.5);
            }
        }

        .text {
            display: block;
            margin-top: 75px;
            margin-left: -30px;
            font-family: "Helvetica Neue", "Helvetica", Arial, sans-serif;
            font-size: 12px;
            color: #000;
            text-transform: uppercase;
            white-space: nowrap;
            opacity: .25;
            animation: pulse 2s linear alternate infinite;
        }

        @keyframes pulse {
            to {
                opacity: 1;
            }
        }

        .scroll-cont{
            opacity: .2;
            position: fixed;
            top: 50px;
            left: 50px;
        }

        .scroll-cont2{
            top: 0;
        }
        .scroll-up{
            transform: rotate(180deg);
        }

        .scroll-cont1{
            left: 45px;
        }


    </style>

</head>
<body style="width: 90vw; overflow-x: hidden">

<section class="book"></section>

{{--<div class="scroll-cont scroll-cont1">--}}
{{--    <div class="container">--}}
{{--        <div class="chevron"></div>--}}
{{--        <div class="chevron"></div>--}}
{{--        <div class="chevron"></div>--}}
{{--        <span class="text">Scroll down</span>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="scroll-cont scroll-cont2">--}}
{{--    <div class="container">--}}
{{--        <div class="scroll-up">--}}
{{--            <div class="chevron"></div>--}}
{{--            <div class="chevron"></div>--}}
{{--            <div class="chevron"></div>--}}
{{--        </div>--}}
{{--        <span class="text">Scroll up</span>--}}
{{--    </div>--}}
{{--</div>--}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r126/three.min.js"></script>
<script >

    window.onload = function (){

        window.scrollY = 1500;

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );

        const renderer = new THREE.WebGLRenderer();
        renderer.setSize( window.innerWidth, window.innerHeight );
        document.querySelector('section.book').appendChild( renderer.domElement );

        renderer.setClearColor( 0xFFFFFF, 1);
        const light = new THREE.AmbientLight( 0x222222 ); // soft white light
        scene.add( light );


        const directionalLight = new THREE.DirectionalLight( 0xffffff, 0.7 );
        directionalLight.position.set(0,0,6);
        scene.add( directionalLight );

        const loader = new THREE.TextureLoader();

        let front = '{{$cover->image}}';
        let back  = '{{$cover->back_img}}';
        let edge  = '{{$cover->edge_img}}';

        const urls = [
            "/book/edge.png", edge,
            "/book/top.png", "/book/bottom.png",
            front, back
        ]

        const materials = urls.map(url => {
            return new THREE.MeshLambertMaterial({
                map: loader.load(url)
            })
        })

        const geometry = new THREE.BoxGeometry(3.5, 5, 0.5);
        const cube = new THREE.Mesh( geometry, materials );
        scene.add( cube );

        camera.position.z = 8;

        let currentTimeline = window.pageYOffset / 3000
        let aimTimeline = window.pageYOffset / 3000

        function animate() {
            requestAnimationFrame( animate );

            currentTimeline += (aimTimeline - currentTimeline) * 0.08

            const rx = currentTimeline * -0.5 + 0.5
            const ry = (currentTimeline * 0.9 + 0.1) * Math.PI * 2

            cube.rotation.set(rx, ry, 0)

            renderer.render( scene, camera );
        }
        animate();

        window.addEventListener("scroll", function () {
            aimTimeline = window.pageYOffset / 1000
        });
    }

</script>

</body>
</html>
