

<p>TESTESTESTEST</p>

<?php

	while(has_sub_field('inhalt')){

		if(get_row_layout() == 'beschreibung'){

            echo '<p>Debug!</p>';
			echo '<div class="row">';

				if(get_sub_field('text')){
					echo '<h1>' . get_sub_field('text') . '</h1>';
				};

			echo '</div>';

		}

		elseif(get_row_layout() == 'team'){

			echo '<div class="row team">';

			    echo '<h1>Team</h1>';

				if(have_rows('mitarbeiter')){

					while(have_rows('mitarbeiter')){
						the_row();

						echo '<div class="col">';

							// Setup
							$image = get_field('bild');

							// Output
							if($image){
								$alt = trim($image['alt']);
								$size = 'mitarbeiter';

								echo '<img src="' . $image['sizes'][$size] . '" width="' . $image['sizes'][ $size . '-width' ] . '" height="' . $image['sizes'][ $size . '-height' ] . '"';
									if($alt){
										echo ' alt="' . $alt . '"';
									};
								echo '>';

							};

							echo '<p>' . get_sub_field('name') . '</p>';

						echo '</div>';

					};

				};

			echo '</div>';

		};

	};
?>
