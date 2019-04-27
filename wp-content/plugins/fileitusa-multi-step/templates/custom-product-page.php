
<div class="container-fluid"> 
	<div class="row">
		<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 12
		);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();global $product;?>
				<div class="col-sm-3 <?php echo 'rating_'.$loop->post->ID; ?>" id="<?php echo 'updetails_'.$loop->post->ID; ?>" style="background-color:lavenderblush;">
					<form onClick="checkAll('<?php echo $loop->post->ID; ?>')"  class="cart" action="<?php echo site_url(). '/package-selection-payment/';?>" method="post" enctype="multipart/form-data">

						<figure class="figure">
							<a href="<?php echo get_permalink( $loop->post->ID ) ?>">
								<?php echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');?>
							</a>
							<div class="updetails">
								<p class="price">$<?php echo $product->get_price(); ?></p>
							</div>
							<figcaption class="figure-caption">
								<h3 class="title"><?php echo the_title(); ?></h3>
								<div class="rating">
									<?php
									if( have_rows('product_services') ):
										while ( have_rows('product_services') ) : the_row();
											$addon_name  = get_sub_field('addon_name');
											$addon_price = get_sub_field('addon_price');
											$sr_addon_name = str_replace(' ', '_', $addon_name);
											?>
											<div class="form-check" id="<?php echo 'rating_'.$loop->post->ID; ?>">
												<input class="form-check-input" type="checkbox" value="<?php echo $addon_price; ?>" id="<?php echo $sr_addon_name; ?>" name="checkGroup[]">
												<label class="form-check-label" for="<?php echo $sr_addon_name; ?>">
													<?php echo $addon_name . ' + $' . $addon_price; ?>
												</label>
											</div>


										<?php  endwhile;
									endif;                                           
									?>
									<?php 

									echo '<input type="hidden" name="sr_addon_name" id="sr_addon_name_'. $loop->post->ID.'" class="sr_addon_name">';

									echo '<input type="hidden" name="total_price" class="total_price" value="'.$product->get_price().'">';
									echo '<input type="hidden" name="repair_price" class="repair_price">';
									echo '<input type="hidden" name="active_price" class="active_price" value="'.$product->get_price().'">';

									echo '<input type="hidden" name="mod_active_price" class="mod_active_price">';

									?>

								</div>
								<p class="description">Lightweight nylon and T-back design for a comfortable fit. Junior Sizes...</p>
								
								<div class="useraction">

									
									<div class="quantity">
										<label class="screen-reader-text" for="quantity_5cc1865883bb1">Polo quantity</label>
										<input type="hidden" id="quantity_5cc1865883bb1" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" inputmode="numeric">
									</div>
									
									<button type="submit"  name="add-to-cart" value="<?php echo $loop->post->ID; ?>" class="single_add_to_cart_button button alt">Add to cart</button> 
								</div>
							</figcaption>
							<script type="text/javascript">   
								function checkAll(p) {     
									var idss = p;
									var checkboxes = document.getElementsByName('checkGroup[]');
									var checkboxesChecked = [];
									for (var i=0; i<checkboxes.length; i++)
									{
										if (checkboxes[i].checked) {
											checkboxesChecked.push({id:checkboxes[i].value,name:checkboxes[i].id});

										}
									}
									document.getElementById('sr_addon_name_'+ idss).value = JSON.stringify(checkboxesChecked);

								}        

								jQuery(document).on("click", "div.rating div", function (event) {
									var target = jQuery(event.target);
									var id = jQuery(this).attr('id');
									var pp = '.'+ id + ' p.price';
									var totalprice1 = jQuery('.'+ id + ' .total_price').val();
									var repair_price =0;
									jQuery('#' + id + ' input[type="checkbox"]').change(function(){
										var repair_price =0;
										jQuery('#' + id + ' input[type="checkbox"]:checked').each(function(){                       
											repair_price= repair_price + parseFloat(jQuery(this).val());

										});
										var totalprice = parseFloat(totalprice1) + parseFloat(repair_price);                   
										jQuery('.' + id + ' .mod_active_price').val(totalprice);
										jQuery('.' + id + ' .repair_price').val(repair_price);
										var price = jQuery('.' + id + ' .mod_active_price').val();                        
										jQuery(pp).html('$' + parseFloat(price));
									});
									
								});
							</script>   

						</figure>
					</form>

				</div>
				<?php 
			endwhile;
		}else{
			echo __( 'No products found' );
		}
		wp_reset_postdata();
		?> 
	</div>
</div>
<script src="http://localhost/cnp610-fileitusa/wp-content/plugins/fileitusa-multi-step/assets/js/jquery.steps.js?ver=5.1.1">
</script>
<script src="http://localhost/cnp610-fileitusa/wp-content/plugins/fileitusa-multi-step/assets/js/jquery.validate.min.js?ver=5.1.1">
</script>
<script src="http://localhost/cnp610-fileitusa/wp-content/plugins/fileitusa-multi-step/assets/js/custom.js?ver=5.1.1">
</script>
