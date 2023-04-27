<div class="mx-auto max-w-7xl px-6 lg:px-8 ">

        <div class="mx-auto max-w-2xl lg:max-w-none box2">
            <div class="flex  px-4 py-5 sm:p-6 rounded-lg bg-gray-700 shadow mt-0">

                <div class="ml-4 flex-shrink-0 self-center">
                        <a href="{{route('projects')}}">
                            <button>
                                <img class="" src="{{asset('my_images/me.jpg')}}" alt="me">
                            </button>
                        </a>
                    </div>
                <div class="box box1">
                    <div class="">
                        <h4 class="text-sm sm:text-2xl  font-bold">About me</h4>
                        <p class="text-sm sm:text-xl mt-1 text-justify  " style="color:white;">
                            Experienced PHP developer with a passion for Laravel framework and MySQL. Skilled in JavaScript, HTML, CSS, and Bootstrap. Dedicated to utilizing Git for version control and collaborating with others to create successful projects.
                        </p>
                    </div>
                </div>
            </div>
        </div>
</div>


<style>




    /******************************************************************************************/
    .box2 {
        --mask:
            radial-gradient(10px at 0    75%,#0000 98%,#000) 10px 50%/51% 40px repeat-y,
            radial-gradient(10px at 50%  25%,#000 99%,#0000 101%) left/20px 40px repeat-y,
            radial-gradient(10px at 100% 25%,#0000 98%,#000) calc(100% - 10px) 50%/51% 40px repeat-y,
            radial-gradient(10px at 50%  75%,#000 99%,#0000 101%) right/20px 40px repeat-y;
        -webkit-mask: var(--mask);
        mask: var(--mask);
    }


    /*****************************************************************************************/
    .box{
        margin:15px;
        border: solid black;
        border-color: black;
        float:left;
    }

    .box1{
        padding: 20px;
        border-width: 3px 4px 3px 5px;
        border-radius:95% 4% 92% 5%/4% 95% 6% 95%;
        /*transform: rotate(2deg);*/
    }


    /****************************************************************************/
    button {
        width: 100px;
        height: 100px;
        font-size:30px;
        color: #fff;
        background: none;
        border: none;
        border-radius: 50%;
        position: relative;
        z-index: 0;
        transition: .3s;
        cursor: pointer;
    }
    button:before {
        content: "";
        position: absolute;
        inset: -8px;
        padding: 10px;
        border-radius: 50%;
        background: conic-gradient(
            #ff53bb ,
            #0000 30deg 120deg,
            #00f8d3 150deg 180deg,
            #0000 210deg 300deg,
            #ff53bb 330deg
        );
        -webkit-mask:
            linear-gradient(#000 0 0) content-box,
            linear-gradient(#000 0 0);
        -webkit-mask-composite: xor;
        mask-composite: intersect
    }
    button:after {
        content: "";
        position: absolute;
        inset: -100px;
        background:
            radial-gradient(200px at left  400px top 150px,#ff53bb 100%,#0000),
            radial-gradient(200px at right 400px bottom 150px,#00f8d3 100%,#0000);
        filter: blur(120px);
        opacity: .5;
    }

    button:before,
    button:after {
        transition:.5s, 99999s 99999s transform;
    }
    button:hover {
        box-shadow: 0 0 0 1px #666;
    }

    button:hover:before,
    button:hover:after {
        transform: rotate(36000deg);
        transition: .5s,600s linear transform;
    }
    button:before {
        background-color: #222;
        border: 2px solid #333;
    }

    body {
        margin: 0;
        min-height: 100vh;
        display: grid;
        place-content: center;
        grid-auto-flow: column;
        background-color: #111;
    }

    button>img{
        border-radius: 50%;
        left: 2px;
        position: relative;
        /*top: 2px;*/
        width: 95%;
        height: 95%;
        object-fit: cover;
        opacity: 0.9;
    }

    /***********************************************************************/

</style>
