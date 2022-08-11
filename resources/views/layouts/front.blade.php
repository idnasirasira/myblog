<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-reenie text-2xl antialiased scroll-smooth">
        <div id="copyInformationBlock" class="fixed hidden bg-gray-100 w-screen h-screen flex-col items-center justify-center">
            <h3 class="text-5xl font-bold tracking-wider text-gray-600">Please, don't copy anything from my website. Respect, ok?</h3>
            <a href="#" onclick="hideInformationBlock(event)" class="font-bold underline text-5xl text-sky-600 hover:text-gray-600 transition-colors duration-500">OK</a>
        </div>

        @if (Route::has('login'))
                <div class="fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a class="text-sky-600 text-lg hover:text-gray-600" href="{{route('post.create')}}">Create a new post</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sky-600 text-lg hover:text-gray-600">Log in</a>
                    @endauth
                    {{-- <a href="#" onclick="toggleFont(this)" class="text-sky-600 text-lg hover:text-gray-600">I hate the font...</a> --}}
                </div>
            @endif
        <div
          id="scene"
          class="fixed w-screen h-screen flex items-center justify-center bg-white"
        ></div>
        <main class="flex items-center justify-center">
          <div class="md:w-6/12 sm:w-8/12 w-full h-scree py-5 px-3 flex flex-col">

            {{ $slot }}
          </div>
        </main>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r71/three.min.js"></script>
        <script>
            var camera, scene, renderer, geometry, material, mesh, renderW, renderH;

            init();
            animate();

            function init() {
                clock = new THREE.Clock();

                renderW = document.getElementById("scene").offsetWidth;
                renderH = document.getElementById("scene").offsetHeight;
                renderer = new THREE.WebGLRenderer();
                renderer.setSize(renderW, renderH);
                renderer.setClearColor(0xe9e4dc, 1);
                scene = new THREE.Scene();

                camera = new THREE.PerspectiveCamera(75, renderW / renderH, 1, 10000);
                camera.position.z = 1300;
                scene.add(camera);

                geometry = new THREE.CubeGeometry(200, 200, 200);
                material = new THREE.MeshLambertMaterial({
                    color: 0xaa6666,
                    wireframe: false,
                });
                mesh = new THREE.Mesh(geometry, material);
                cubeSineDriver = 0;

                textGeo = new THREE.PlaneGeometry(300, 300);
                THREE.ImageUtils.crossOrigin = ""; //Need this to pull in crossdomain images from AWS

                light = new THREE.DirectionalLight(0xffffff, 1);
                light.position.set(-1, 0, 1);
                scene.add(light);

                smokeTexture = THREE.ImageUtils.loadTexture(
                    "https://s3-us-west-2.amazonaws.com/s.cdpn.io/95637/Smoke-Element.png"
                );
                smokeMaterial = new THREE.MeshLambertMaterial({
                    color: 0x6ecbea,
                    opacity: 1,
                    map: smokeTexture,
                    transparent: true,
                });
                smokeGeo = new THREE.PlaneGeometry(300, 300);
                smokeParticles = [];

                for (p = 0; p < 20; p++) {
                    var particle = new THREE.Mesh(smokeGeo, smokeMaterial);
                    particle.position.set(
                        Math.random() * 200 - 100,
                        Math.random() * 200 - 100,
                        Math.random() * 1000 - 100
                    );
                    particle.rotation.z = Math.random() * 360;
                    scene.add(particle);
                    smokeParticles.push(particle);
                }

                document.getElementById("scene").appendChild(renderer.domElement);
            }

            function animate() {
                // note: three.js includes requestAnimationFrame shim
                delta = clock.getDelta();
                requestAnimationFrame(animate);
                evolveSmoke();
                render();
            }

            function evolveSmoke() {
                var sp = smokeParticles.length;
                while (sp--) {
                    smokeParticles[sp].rotation.z += delta * 0.2;
                }
            }

            function render() {
                mesh.rotation.x += 0.005;
                mesh.rotation.y += 0.01;
                cubeSineDriver += 0.01;
                mesh.position.z = 100 + Math.sin(cubeSineDriver) * 500;
                renderer.render(scene, camera);
            }

            window.onresize = function () {
                renderW = document.getElementById("scene").offsetWidth;
                renderH = document.getElementById("scene").offsetHeight;
                renderer.setSize(renderW, renderH);
                camera.aspect = renderW / renderH;
                camera.updateProjectionMatrix();
            };

            setTimeout(() => {
                const x = document.querySelector("#scene");
                x.style.opacity = "0";
                x.style.visibility = "hidden";
            }, 200);

        </script>

        <script>
            function toggleFont(e){
                document.body.classList.remove('font-reenie');
                e.remove();
            }

            function copyDisable(event) {
                event.preventDefault();
                document.querySelector('#copyInformationBlock').classList.remove('hidden');
                document.querySelector('#copyInformationBlock').classList.add('flex');
                return false;
            }

            function hideInformationBlock(event){
                event.preventDefault();
                document.querySelector('#copyInformationBlock').classList.add('hidden');
                document.querySelector('#copyInformationBlock').classList.remove('flex');
                return false;
            }
        </script>

        <script>
            var noScreenshot=true;
            var autoBlur=true;

            var cssNode2 = document.createElement('style');
            cssNode2.type = 'text/css';
            cssNode2.media = 'screen';
            cssNode2.innerHTML ='div{-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;}';
            document.head.appendChild(cssNode2);
            document.body.style.cssText="-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;";


            function toBlur()
            {
                if (autoBlur)
                document.body.style.cssText="-webkit-filter: blur(5px);-moz-filter: blur(5px);-ms-filter: blur(5px);-o-filter: blur(5px);filter: blur(5px);"
            }

            function toClear()
            {
                document.body.style.cssText="-webkit-filter: blur(0px);-moz-filter: blur(0px);-ms-filter: blur(0px);-o-filter: blur(0px);filter: blur(0px);"
            }

            document.onclick = function(event){
                toClear();
            }

            document.onmouseleave = function(event){
                toBlur();
            }

            document.onblur = function(event){
                toBlur();
            }

            document.addEventListener('keyup', (e) => {
                if (e.key == 'PrintScreen') {
                    if (noScreenshot)
                    {
                    navigator.clipboard.writeText('');

                }
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.ctrlKey && e.key == 'p') {
                    if (noPrint)
                        {
                        e.cancelBubble = true;
                        e.preventDefault();
                        e.stopImmediatePropagation();
                    }
                }
            });
        </script>

        @stack('scripts')
    </body>
</html>
