<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
							<label for="s" class="screen-reader-text">Search</label>
							<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="Search &#133;" />
							<input type="submit" class="submit" id="searchsubmit" value="Search" />
						</form>
