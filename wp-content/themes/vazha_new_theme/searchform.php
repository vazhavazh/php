<form role="search" method="get" id="searchform" action="<?php echo home_url('/') ?>" class="form-group">
  <!-- <input type="text" placeholder="search" class="form-control" > -->
  <input type="text" placeholder="search" class="form-control" value="<?php echo get_search_query() ?>" name="s"
    id="s" />
  <!-- <button type="submit"><i class="fa fa-search"></i></button> -->
</form>