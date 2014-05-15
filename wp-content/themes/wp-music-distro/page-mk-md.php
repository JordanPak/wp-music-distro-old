<?php
/*
Template Name: Marching Knights MusicDistro
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col col-lg-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					                        
                        <!--// PAGE HEADER //-->
						<header>
							
							<div class="page-header">
                            	<h1>
									<?php the_title(); ?>
                                    <a class="btn btn-warning pull-right" href="#"><span class="glyphicon glyphicon-exclamation-sign"></span> Report Issue</a>
                                </h1>
                            </div>
						
						</header> <!-- end article header -->
					
                    
						
   						<?php
							
							
							//------------------------------//
							//-- ARCHIVE PAGE INFORMATION --//
							//------------------------------//
							
							// SLUG of the band (parent category) called "Marching Knights" 
							$band_slug = 'marching-knights';
							
							
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
						
                        
                        <!--// FOR TESTING //-->
                        
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
                        	
           
                        
                        <div class="row">
                        	<div class="col-xs-4">
                                
                                
                                <form class="form-horizontal" role="form">
                                	                                     
                                    
									<?php 										
										
										// For Testing
										if( $selected != 0 ) {
											echo '<br><br><p><b>Different Instrument?</b></p>';
										}
										else {
											echo '<br><br><p><b>Select a ' . $band_name . ' Instrument:</b></p>';
										}
										
										
										// Parameters for category dropdown
										$catArgs = array(
											'show_option_all'    => '',
											'show_option_none'   => '',
											'orderby'            => 'ID', 
											'order'              => 'ASC',
											'show_count'         => 1,
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
                                    <button type="submit" class="btn btn-primary">Go</button>                          
                                
                                </form>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                        
                        
                        <br>
                        
                        
                        <!-- Another Row -->
                        <div class="row">
                        	<div class="col-md-12">
                        		
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
										
										
										// FOR TESTING!
										echo '<br><p><b>All <u>' . $band_name . '</u> <u>' . $selected_instrument_name . '</u> Arrangements</b></p>';
										
										if($arrangements->have_posts() ){
											echo '<ul>';
											while($arrangements->have_posts())
											{
												$arrangements->the_post();	
												echo '<li>' . get_the_title() . '</li>';
											}
											echo '</ul><br><br>';
										} // End if
										else
										{
											echo '<p>No arrangements found</p>';	
										}
										
										/* For Testing
										echo '<p><b>Arrangements: </b><br>';
										foreach($arrangements as $arrangement)
										{
											echo get_the_title($arrangement) . '<br>';
										}
										echo '</p>';
										*/
										
										
										// For Testing
										echo '<p><b>Song Categories:</b></p>';
										
																				
										// Array of all types of songs (Via tags)
										$tags = wp_get_object_terms( $arrangements, 'post_tag' /*, $optionalArgs = array() */);
										
																				
										/*
										// Loop through each tag and make a box for it
										foreach( $tags as $tag )
										{ ?>
                                            
                                            <div class="col-md-4">
                                                
                                                <div class="panel panel-warning">
                                                    
                                                    <div class="panel-heading"><?php echo $tag->name; ?> Kidden</div>
                                                	
                                                    <div class="panel-body">
                                                        Panel content
                                                    </div>
                                                    
                                                </div><!-- /.panel-warning -->
                                          	</div><!-- /.col-md-4 -->						
                                        
                                  <?php } // foreach $tags
								  */
										
										
										
                                    } // If $selected
									                                	
									
									/* Restore original Post Data */
									wp_reset_postdata();
									
                                ?>
                        
                        	</div><!-- /.col -->
                        </div><!-- /.row -->
					
					
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