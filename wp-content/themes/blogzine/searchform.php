<form class="input-group" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
    <input class="form-control border-success" required type="text" placeholder="<?= get_field('subscribe', 16)['subscribe-form-input']; ?>" value="<?php echo get_search_query() ?>" name="s" id="s" />
    <input class="btn btn-success m-0" type="submit" id="searchsubmit" value="<?= get_field('subscribe', 16)['subscribe-form-btn']; ?>" />
</form>