<template>
    <div class="container">
        <aside>
            <ul>

                <li class="logo_cont">
                    <h1>
                        <a href="/"> <img class="logo" src="img/x-twitter.svg" alt="">
                        </a>
                    </h1>
                </li>

                <li data-title="Home" class="active">
                    <img src="img/house.svg" alt="">
                    <span>Home</span>
                </li>
                <li data-title="Explore">
                    <img src="img/magnifying-glass.svg" alt="">
                    <span>Explore</span>
                </li>
                <li data-title="Notifications">
                    <img src="img/bell.svg" alt="">
                    <span>Notifications</span>
                </li>
                <li data-title="Messages">
                    <img src="img/message.svg" alt="">
                    <span>Messages</span>
                </li>
                <li data-title="List">
                    <img src="img/rectangle-list.svg" alt="">
                    <span>Lists</span>
                </li>
                <li data-title="Bookmarks">
                    <img src="img/bookmark.svg" alt="">
                    <span>Bookmarks</span>
                </li>
                <li data-title="Communities">
                    <img src="img/users.svg" alt="">
                    <span>Communities</span>
                </li>
                <li data-title="profil">
                    <img src="img/user.svg" alt="">
                    <span>Profile</span>
                </li>
                <a href="">
                    <button>POST</button>
                </a>
            </ul>





        </aside>

        <main>

            <div class="recommendation">
                <ul>
                    <li> <span class="active">For you</span> </li>
                    <li><span>Following</span></li>
                </ul>
            </div>
            <div class="post_cont">

                <div class="user_post">

                    <img src="img/user.svg" alt="">
                    <form action="" method="post">

                        <textarea name="post_text">What is happening?</textarea>

                        <label for="post_image">
                            <img src="img/image.svg" alt=""></label>
                        <input oninput="image_input()" accept="image/*" type="file" name="post_image" id="post_image">

                        <button type="submit">Post</button>
                    </form>
                </div>
                <div class="preview">
                    <img class="preview_img" src="" alt="">

                </div>
            </div>
            <div class="user_posts">
                <span>
                    <img src="img/user.svg" alt="">
                    <a href="/">
                        <h1> user_name</h1>
                        <p>@user_email@email.com</p>
                    </a>

                </span>
                <div class="post_text">

                    <p class="text_desc">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam temporibus labore ratione
                        asperiores cum consectetur necessitatibus sequi sunt in rerum! Ut magnam vel tenetur commodi,
                        eos impedit. Qui, excepturi cumque. Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Magnam temporibus labore ratione asperiores cum consectetur necessitatibus
                        sequi sunt in rerum! Ut magnam vel tenetur commodi, eos impedit. Qui, excepturi cumque.
                        <span>2012/23/12</span>
                    </p>

                    <div class="show_detail">
                        <small class="show_btn" onclick="show_more()"> show more
                        </small>
                    </div>


                    <div class="post_img">

                        <img src="img/4239052-thebeekeeper.jpg" alt="">

                    </div>
                    <div class="post_contents">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </div>
                </div>



            </div>
            <div class="user_posts">
                <span>
                    <img src="img/user.svg" alt="">
                    <a href="/">
                        <h1> user_name</h1>
                        <p>@user_email@email.com</p>
                    </a>

                </span>
                <div class="post_text">

                    <p class="text_desc">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam temporibus labore ratione
                        asperiores cum consectetur necessitatibus sequi sunt in rerum! Ut magnam vel tenetur commodi,
                        eos impedit. Qui, excepturi cumque. Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Magnam temporibus labore ratione asperiores cum consectetur necessitatibus
                        sequi sunt in rerum! Ut magnam vel tenetur commodi, eos impedit. Qui, excepturi cumque.
                        <span>2012/23/12</span>
                    </p>

                    <div class="show_detail">
                        <small class="show_btn" onclick="show_more()"> show more
                        </small>
                    </div>


                    <div class="post_img">

                        <img src="img/IMG_6587.JPG" alt="">

                    </div>
                    <div class="post_contents">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </div>
                </div>



            </div>

        </main>



    </div>
</template>

<script>
var show = false;

function show_more() {
    var show_btn = document.querySelector('.show_btn');
    var shows_text = document.querySelectorAll('.text_desc');

    if (show == false) {

        shows_text.forEach(shows_texts => {
            shows_texts.style.height = 'fit-content';
        });

        show = true;
        show_btn.innerHTML = 'show less';

    } else {

        shows_text.forEach(shows_texts => {
            shows_texts.style.height = '100px';
        });
        show = false;
        show_btn.innerHTML = 'show more'

    }
}

function image_input() {
    var preview = document.querySelector('.preview');
    var preview_img = document.querySelector('.preview_img');
    var post_image = document.getElementById('post_image');

    preview.style.display = 'block';

    preview_img.src = URL.createObjectURL(post_image.files[0]);


}
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
