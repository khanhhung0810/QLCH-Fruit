<div class="hero__search__form">
    <form action="{{ route('shop')}}" method="GET">
        <div class="hero__search__categories">
            Products
            <span class="arrow_carrot-down"></span>
        </div>
        <input type="text" placeholder="What do yo u need?" name="search">
        <button type="submit" class="site-btn">SEARCH</button>
    </form>
</div>