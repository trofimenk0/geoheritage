<button type="submit" class="header__searchSubmit">
    <svg class="header__searchIcon" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M21.4408 18.8679H20.0858L19.6055 18.4048C21.2865 16.4494 22.2985 13.9108 22.2985 11.1492C22.2985 4.99142 17.307 0 11.1492 0C4.99142 0 0 4.99142 0 11.1492C0 17.307 4.99142 22.2985 11.1492 22.2985C13.9108 22.2985 16.4494 21.2865 18.4048 19.6055L18.8679 20.0858V21.4408L27.4443 30L30 27.4443L21.4408 18.8679V18.8679ZM11.1492 18.8679C6.87822 18.8679 3.43053 15.4202 3.43053 11.1492C3.43053 6.87822 6.87822 3.43053 11.1492 3.43053C15.4202 3.43053 18.8679 6.87822 18.8679 11.1492C18.8679 15.4202 15.4202 18.8679 11.1492 18.8679Z" fill="#52D858"/>
    </svg>
</button>

<form role="search" method="get" id="searchform" class="header__searchForm" action="http://localhost:8888/geoheritage/app/">
    <h3 class="header__searchFormTitle">
        <?php _e('Пошук', 'geoheritage'); ?>
    </h3>
    <input class="header__searchInput" type="text" value="" name="s" id="searchInput" placeholder="Знайти геопамʼятку">

    <div class="header__searchResults" id="searchResults"></div>
</form>