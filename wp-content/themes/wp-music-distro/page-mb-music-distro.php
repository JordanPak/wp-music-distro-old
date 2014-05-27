<?php
/*
Template Name: Marching Band MusicDistro
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col col-lg-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post();
						
                        
						
						//--------------------------------//
						//-- ENABLE PASSWORD PROTECTION --//
						//--------------------------------//
						
						if (post_password_required()) {
                            
							echo '<br><br>';
							the_content();
                        } 
						
						else { ?>

					                        
                            <!--// PAGE HEADER //-->
                            <header>
                                
                                <div class="page-header">
                                    <h1>
                                        <?php the_title(); ?>
                                        
                                        <!-- REPORT ISSUE BUTTON -->
                                        <a class="btn btn-warning pull-right" href="report-issue"><span class="glyphicon glyphicon-exclamation-sign"></span> Report Issue</a>
                                        
                                    </h1>
                                </div>
                            
                            </header> <!-- end article header -->
                        
                        
                            
                            <?php
                                
                                
                                //------------------------------//
                                //-- ARCHIVE PAGE INFORMATION --//
                                //------------------------------//
                                
                                // SLUG of the band (parent category)
                                $band_slug = 'marching-band';
                                
                                
                                // Get the whole term BY slug, using the BAND SLUG (Parent Category Slug) 
                                // as the term, INSIDE the download_category taxonomy
                                $band_term = get_term_by('slug', $band_slug, 'download_category');
                                
                                
                                // Get the ID from that term
                                $band_id = $band_term->term_id;
                                
                                
                                // Get the Name from that term also
                                $band_name = $band_term->name;
                                
    
    
                                //-------------------------------------//
                                //-- SELECTED INSTRUMENT INFORMATION --//
                                //-------------------------------------//
    
                                // Find the selected instrument
                                $selected = isset($_REQUEST['cat']) && $_REQUEST['cat'] != '' ? $_REQUEST['cat'] : 0;
                                
                                
                                // ID of selected instrument
                                $selected_instrument_id = $selected;
                                
                                
                                // TERM of selected instrument
                                $selected_instrument_term = get_term_by('id', $selected_instrument_id, 'download_category');
                                
                                
                                // SLUG of selected instrument
                                $selected_instrument_slug = $selected_instrument_term->slug;
                                
                                
                                // NAME of selected instrument
                                $selected_instrument_name = $selected_instrument_term->name;
                            
                            ?>
                            
                            
                            <!--// FOR TESTING //--><?php /*
                            
                            <div class="row">
                            
                                <div class="col-md-6">
                                    
                                    <!-- Archive Page Info -->
                                    <h4>Archive Page Info</h4>
                                    <p>
                                        <b>Band Name: </b><?php echo $band_name; ?><br>
                                        <b>Band Slug: </b><?php echo $band_slug; ?><br>
                                        <b>Band ID: </b><?php echo $band_id; ?><br>
                                    </p>
                                    
                                </div><!-- Archive Page Col -->
                            
                                
                                <div class="col-md-6">
                                    
                                    <!-- Selected Instrument Info -->
                                    <h4>Selected Instrument Info</h4>
                                    <p>
                                        
                                        <?php if( $selected != 0 ) { ?>
                                        <b>Name: </b><?php echo $selected_instrument_name; ?><br>
                                        <b>Slug: </b><?php echo $selected_instrument_slug; ?><br>
                                        <b>ID: </b><?php echo $selected_instrument_id; ?><br>
                                        <?php } 
                                        
                                        else { ?>
                                        <b>No instrument selected</b>
                                        <?php } ?>
                                    </p>
                                    
                                </div><!-- Archive Page Col -->
                                                        
                            </div><!-- /.row -->
                                
                                
                            <!-- END TESTING -->
                            
                            */?>
                            
                            
                            <div class="row">
                                <div class="col-xs-4">
                                    
                                    
                                    <form class="form-horizontal" role="form">
                                                                             
                                        
                                        <?php 										
                                            
    
                                            if( $selected != 0 ) {
                                                echo '<p><b>Different Instrument?</b></p>';
                                            }
                                            else {
                                                echo '<p><b>Select an Instrument:</b></p>';
                                            }
                                            
                                            
                                            // Parameters for category dropdown
                                            $catArgs = array(
                                                'show_option_all'    => '',
                                                'show_option_none'   => '',
                                                'orderby'            => 'ID', 
                                                'order'              => 'ASC',
                                                'show_count'         => 0, // Shows number of arrangements for that instrument
                                                'hide_empty'         => 0, 
                                                'child_of'           => $band_id,
                                                'exclude'            => '',
                                                'echo'               => 1,
                                                'selected'           => $selected_instrument_id,
                                                'hierarchical'       => 0, 
                                                'name'               => 'cat',
                                                'id'                 => '',
                                                'class'              => 'form-control',
                                                'depth'              => 0,
                                                'tab_index'          => 0,
                                                'taxonomy'           => 'download_category',
                                                'hide_if_empty'      => false,
                                                'walker'             => ''
                                            );
                                            
                                            // Display dropdown for categories
                                            wp_dropdown_categories( $catArgs );
                                        ?>                 
                                        
                                        <br>
                                        
                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary">Get Music</button>                          
                                    
                                    </form>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            
                            
                            <br>
                            
                            
                            <!-- Another Row -->
                            <div class="row">
                            
                                <br>
                                    
                                    <?php
                                        
                                        // If an instrument was selected
                                        if($selected)
                                        {	
                                                                                    
                                            // Args for Arrangements wp_query
                                            $arrangementSelection = array(
                                                'post_type'			=> 'download',
                                                'download_category'	=> $selected_instrument_slug
                                            );
                                            
                                            // Array of all the songs for the selected instrument
                                            $arrangements = new WP_Query( $arrangementSelection );
                                            
                                            
                                            // Throw error if no arrangements
                                            if(($arrangements->have_posts()) == false)
                                            {
                                                echo '<div class="col-md-12">';
                                                echo '<div class="alert alert-warning">No ' . $band_name . ' ' . $selected_instrument_name . ' arrangements found!</div>';
                                                echo '</div>';
                                            }
                                                    
                                                                                    
                                            
                                            // Args for Arrangements wp_query
                                            $arrangementSelection = array(
                                                'post_type'			=> 'download',
                                                'download_category'	=> $selected_instrument_slug,
                                                'fields' => 'ids' // This is so only the ID is returned instead of the WHOLE post object (Performance)
                                            );
                                            
                                            
                                            // Array of all the songs for the selected instrument
                                            $arrangements = new WP_Query( $arrangementSelection );
                                            $arrangements = $arrangements->get_posts();
                                                        
                                                                                
                                            // Array of all types of songs (Via tags)
                                            $tags = wp_get_object_terms( $arrangements, 'download_tag' /*, $optionalArgs = array() */);										
                                            
                                            
                                            // Loop through each tag and make a box for it
                                            foreach( $tags as $tag )
                                            { ?>
                                                
                                                <div class="col-md-4">
                                                    
                                                    <div class="panel panel-primary">
                                                        
                                                        <div class="panel-heading"><?php echo '<h4>' . $tag->name . '</h4>'; ?></div>
                                                        
                                                        <div class="panel-body">
                                                            
                                                            <?php
                                                                
                                                                // Go through all the arrangements (which is only ids
                                                                // of arrangements)
                                                                foreach($arrangements as $arrangement)
                                                                {
                                                                    
																	// Get the arrangement object from the ID	
                                                                    $object = get_post($arrangement);
                                                                    
                                                                    
                                                                    // See if the arrangement has the tag of the tag we're checking
                                                                    if( has_term( $tag, 'download_tag', $object ) )
                                                                    {
                                                                        
                                                                        // Show the Title
                                                                        echo '<b>' . get_the_title($arrangement);
                                                                        echo ': </b>';
                                                                        
                                                                        
                                                                        // Get the file (names & URLs)
                                                                        $files = edd_get_download_files($arrangement);
                                                                        
                                                                        
                                                                        // Set counter for unsetting, keeps track of what index we're at for removing
                                                                        $counter_a = 0;
                                                                        
                                                                        
                                                                        // Go through each file 
                                                                        foreach( $files as $file){
                                                                            
                                                                            
                                                                            // Break file into array of strings
                                                                            $explosion = explode(" ", $file['name']);
                                                                            
                                                                            
                                                                            // TWO WORD INSTRUMENT //
    
                                                                            // Check for instrument names with two words by seeing if the second
                                                                            // exists and if it's a number or not
                                                                            if( (is_numeric($explosion[1]) == FALSE) && ($explosion[1] != NULL) )
                                                                            {
                                                                                
                                                                                // For Testing
                                                                                //echo '<br><b>$explosion[1] is not a number!</b><br>';
                                                                                if (($explosion[0] . ' ' . $explosion[1]) !== $selected_instrument_name){
                                                                                    unset($files[$counter]);
                                                                                }
                                                                                                                                                            
                                                                            } // if (two word instrument)
                                                                            
                                                                            
                                                                            
                                                                            // ONE WORD INSTRUMENT //
                                                                            
                                                                            // If the the file name does not begin with the selected instrument,
                                                                            // remove the FILE from the array.
                                                                            else {
                                                                                
                                                                                if ($explosion[0] !== $selected_instrument_name){
                                                                                    unset($files[$counter]);
                                                                                }
                                                                                
                                                                            } // else
																			
                                                                            
                                                                            $counter++;
                                                                        }
                                                                        
                                                                        
																		// Sorts the array alphabetically
                                                                        asort($files);
                                                                        
                                                                        
                                                                        // Counter for pipes (USING BUTTONS NOW)
                                                                        $counter = 1;
                                                                        
                                                                        
                                                                        // Go through each file
                                                                        foreach( $files as $file){
                                                                            
                                                                            // Take the string and break into an array (Explode)
                                                                            // ex: "Hello World"
                                                                            // explode(" ", Hello World) = array(Hello, World); (Indexed array)
                                                                            $explosion = explode(" ", $file['name']);																		
                                                                            
																			
																			// For Testing
																			echo '<br>Expl: ' . $explosion[0] . ' ' . $explosion[1] . ' ' . $explosion[2];
																			
                                                                                                                                                    
                                                                            // If the first of the array = the selected instrument OR
                                                                            // If the first two of the array = selected instrument
                                                                            if (  
                                                                                  ($explosion[0] == $selected_instrument_name) || 
                                                                                  (($explosion[0] . ' ' . $explosion[1]) == $selected_instrument_name)
                                                                               )
                                                                            {
                                                                                
                                                                                // Remove the instrument name and space from file name (variable)
                                                                                $name = str_replace($selected_instrument_name." ","",$file['name']);
                                                                                
                                                                                
																				// Output link for file
                                                                                // To be updated later to force download when Chris finishes rewritting
                                                                                // the disgusting thing that is EDD Free Downloads
                                                                                
																				
																				// If the arrangment only has one part for a given instrument
																				// (Detected by the input name not having a number)
																				if ( 
																					( is_numeric($explosion[1]) == FALSE ) &&
																					( is_numeric($explosion[2]) == FALSE ) 
																				   )
																				{
																					echo '<a class="btn btn-xs btn-default" href="'.$file['file'].'" target="_blank"><span class="glyphicon glyphicon-arrow-down"></span></a>';
																				}
																				
																				
																				// For sheet music with more than one part for a given instrument
																				else {
																					echo '<a class="btn btn-xs btn-default" href="'.$file['file'].'" target="_blank">' . $name . '</a>';
																				}
																				
                                                                                
                                                                                // If it's not the last item, put in a pipe (DISABLED)
                                                                                if ( $counter != count($files)){
                                                                                    echo '&nbsp';
                                                                                }
																				
																				
																				// Unset / Reset array to avoid pulling two numbers in explosion
																				//unset($explosion);
																				$explosion = array();
																				
                                                                                
                                                                                $counter++;
                                                                            
                                                                            } // IF the name of the file = selected instrument
                                                                            
                                                                            
                                                                        } // IF the arrangement has the tag of the tag we're checking
                                                                        
                                                                        
                                                                    } // foreach($arrangements as $arrangement)
                                                                
                                                                
                                                                } // foreach
                                                                
                                                            ?>
                                                            
                                                        </div>
                                                        
                                                    </div><!-- /.panel-warning -->
                                                </div><!-- /.col-md-4 -->						
                                            
                                      <?php } // foreach $tags
                                      
                                            
                                            
                                            
                                        } // If $selected
                                                                            
                                        
                                        /* Restore original Post Data */
                                        wp_reset_postdata();
                                        
                                    ?>
                            
                            </div><!-- /.row -->
                            
					
						<?php } // Password Protection ?> 
                    
					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>