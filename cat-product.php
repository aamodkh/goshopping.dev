<?php if(isset($category_info)) { ?>
	<div class="top-brands">
		<div class="container">
			<h3><?php echo $category_info[0]->title;?></h3>
			<div class="agile_top_brands_grids">
				<?php 
				}
					$i=1;
					foreach($product_data as $product_info){
						//debugger($product_info, true);
				?>
				<div class="col-md-3 top_brand_left">
					<div class="hover14 column">
						<div class="agile_top_brand_left_grid">
							<?php 
								if($product_info->discount > 0)
								{
							?>
							<div class="agile_top_brand_left_grid_pos">
								<img src="<?php echo IMAGES_URL;?>offer.png" alt=" " class="img-responsive" />
							</div>
							<?php } ?>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="detail?id=<?php echo $product_info->id;?>&amp;act=<?php echo substr(md5('get-detail-'.$product_info->id), 3, 15);?>">
												<?php 
													if($product_info->image_name != "" && file_exists(PRODUCT_DIR."/".$product_info->image_name)){
														$thumbnail = PRODUCT_URL."/".$product_info->image_name;
													} else {
														$thumbnail = IMAGES_URL."default.jpg";
													}
												?>
												<img style="max-height: 130px" src="<?php echo $thumbnail;?>" alt=" " class="img-responsive" />
											</a>
											<p><?php echo substr($product_info->product_title, 0, 30);?><br></p>
											<h4>
												<?php 
													if($product_info->discount > 0){
														$discount_amount = ($product_info->price*$product_info->discount)/100;
														$discount_price = $product_info->price-$discount_amount;
													} else {
														$discount_amount = 0;
														$discount_price = $product_info->price;
													}
												?>
												NPR. <?php echo $discount_price;?> 
												<?php 
												if($product_info->discount >0 ) { ?><span>NPR. <?php echo $product_info->price;?></span> <?php } ?>
											</h4>
										</div>

										<div class="snipcart-details top_brand_home_details">
											<form action="#" method="post">
												<fieldset>
													<input type="hidden" name="cmd" value="_cart" />
													<input type="hidden" name="add" value="1" />
													<input type="hidden" name="business" value=" " />
													<input type="hidden" name="item_name" value="<?php echo $product_info->product_title;?>" />
													<input type="hidden" name="product_id" value="<?php echo $product_info->id;?>" />
													<input type="hidden" name="amount" value="<?php echo $product_info->price;?>" />
													<input type="hidden" name="discount_amount" value="<?php echo $discount_amount;?>" />
													<input type="hidden" name="currency_code" value="INR" />
													<input type="hidden" name="return" value=" " />
													<input type="hidden" name="cancel_return" value=" " />
													
													<input type="submit" name="submit" value="Add to cart" class="button" />
												</fieldset>
											</form>
											<form 
											<?php if($product_info->is_negotiable){ ?>
											action="negotiation" <?php } else{

											 ?> action="" onsubmit="return false" <?php } ?> method="post">
												<fieldset>
													<input type="hidden" name="add" value="1" />
													<input type="hidden" name="business" value=" " />
													<input type="hidden" name="item_name" value="<?php echo $product_info->product_title;?>" />
													<input type="hidden" name="product_id" value="<?php echo $product_info->id;?>" />

													<?php 
													if($product_info->is_negotiable)
													{
													 ?>
													<input type="hidden" name="negotiation_border" value="<?php echo $product_info->negotiation_border;?>" />
													<?php
													}
													else
													{ ?>
														<input type="hidden" name="negotiation_border" value="<?php echo 0;?>" />
													<?php

													}?>
													
													<input type="hidden" name="amount" value="<?php echo $product_info->price;?>" />
													<input type="hidden" name="discount_amount" value="<?php echo $discount_amount;?>" />
													<input type="hidden" name="currency_code" value="INR" />
													<input type="hidden" name="return" value=" " />
													<input type="hidden" name="cancel_return" value=" " />
													<input type="submit" 
													<?php if($product_info->is_negotiable) { ?> onclick="return confirm('Are you sure you want to negotiate price for <?php echo $product_info->product_title; ?> ???')"
													<?php } else { ?>  onclick="return alert('Sorry! negotiation is not available for <?php echo $product_info->product_title; ?>')" <?php } ?> name="negotiate" value="Negotiate Price" class="button" />
												</fieldset>
											</form>
										</div>
									</div>
								</figure>
							</div>
						</div>
					</div>
				</div>
				<?php
					if($i%4 ==0) {
						echo '<div class="clearfix"> </div>';
					}
				}
if(isset($category_info)) { ?>

			</div>
		</div>
	</div>
<?php } ?>
