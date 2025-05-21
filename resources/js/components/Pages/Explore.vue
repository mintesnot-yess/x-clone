<template>
    <div class="explore">
        <div class="search-settings">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search" />
            </div>
            <button class="settings-btn" aria-label="Settings">
                <i class="fas fa-cog"></i>
            </button>
        </div>
        <nav>
            <button class="active">For You</button>
            <button>Trending</button>
            <button>News</button>
            <button>Sports</button>
            <button>Entertainment</button>
        </nav>
        <h2>Today's News</h2>
        <article class="news-item">
            <h3>Rep. Gerry Connolly Dies at 75; Leaves Legacy of Service</h3>
            <div class="news-meta">
                <div class="avatars">
                    <img src="https://storage.googleapis.com/a1aa/image/285f43cd-8a3c-4669-4f06-17de73870da9.jpg"
                        alt="Profile image of person 1 with blue shirt and glasses" />
                    <img src="https://storage.googleapis.com/a1aa/image/d5ee7c45-bea6-40c0-eb67-8f355dc54953.jpg"
                        alt="Profile image of person 2 with short hair and beard" />
                    <img src="https://storage.googleapis.com/a1aa/image/526760e5-77c5-49e9-148c-c0a1057394be.jpg"
                        alt="Profile image of person 3 with dark hair and glasses" />
                </div>
                <span>Trending now · News · 6K posts</span>
            </div>
        </article>
        <article class="news-item">
            <h3>Elon Musk's Optimus: The Future of Household Robotics?</h3>
            <div class="news-meta">
                <img src="https://storage.googleapis.com/a1aa/image/07c861dd-335f-4a63-fe6c-61996066348c.jpg"
                    alt="Profile image of Elon Musk with beard and brown hair"
                    style="width:20px; height:20px; border-radius:9999px; border:1px solid #000; margin-right:8px;" />
                <span>9 hours ago · News · 55K posts</span>
            </div>
        </article>
        <article class="news-item">
            <h3>Former Ukrainian Official Assassinated in Madrid</h3>
            <div class="news-meta">
                <img src="https://storage.googleapis.com/a1aa/image/8007b436-52e2-4ca1-69c2-95efa0b0df95.jpg"
                    alt="Profile image of Ukrainian official with dark hair"
                    style="width:20px; height:20px; border-radius:9999px; border:1px solid #000; margin-right:8px;" />
                <span>4 hours ago · News · 15K posts</span>
            </div>
        </article>
        <hr />
        <section>
            <div class="trending-item">
                <div class="trending-info">
                    <p class="category">Trending in Gaming</p>
                    <p class="title">Senua's Saga</p>
                    <p class="posts">1,477 posts</p>
                </div>
                <button class="more-btn" aria-label="More options"><i class="fas fa-ellipsis-h"></i></button>
            </div>
            <div class="trending-item">
                <div class="trending-info">
                    <p class="category">Trending in Gaming</p>
                    <p class="title">Hellblade II</p>
                    <p class="posts">1,405 posts</p>
                </div>
                <button class="more-btn" aria-label="More options"><i class="fas fa-ellipsis-h"></i></button>
            </div>
            <div class="trending-item">
                <div class="trending-info">
                    <p class="category">Trending in Ethiopia</p>
                    <p class="title">#AddisAbaba</p>
                </div>
                <button class="more-btn" aria-label="More options"><i class="fas fa-ellipsis-h"></i></button>
            </div>
            <div class="trending-item">
                <div class="trending-info">
                    <p class="category">Trending in Ethiopia</p>
                    <p class="title">#Eritrea</p>
                    <p class="posts">5,466 posts</p>
                </div>
                <button class="more-btn" aria-label="More options"><i class="fas fa-ellipsis-h"></i></button>
            </div>
            <div class="trending-item">
                <div class="trending-info">
                    <p class="category">Trending in Stocks &amp; indices</p>
                    <p class="title">Strong Buy</p>
                    <p class="posts">2,543 posts</p>
                </div>
                <button class="more-btn" aria-label="More options"><i class="fas fa-ellipsis-h"></i></button>
            </div>
            <div class="trending-item">
                <div class="trending-info">
                    <p class="category">Trending in Ethiopia</p>
                    <p class="title">#EthioMedProtest</p>
                </div>
                <button class="more-btn" aria-label="More options"><i class="fas fa-ellipsis-h"></i></button>
            </div>
        </section>
        <h3 class="who-to-follow">Who to follow</h3>
        <div class="follow-item">
            <img src="https://storage.googleapis.com/a1aa/image/1a0b1a35-6fcc-473f-4c81-388178d44ea3.jpg"
                alt="Profile image of coder girl with short hair and orange emoji" />
            <div class="follow-info">
                <span>coder_girl</span>
                <span>👩‍💻</span>
                <i class="fas fa-check-circle verified"></i>
            </div>
        </div>
    </div>
</template>