<?php if (isset($this->pictures) && count($this->pictures)>0){?>	
<div class="slidergallery" id="slidergallery" style="width:auto">
	<div id="pageContainer">
		<div id="slideshow">
	   		<div id="slidesContainer">
	      		<div class="slide">
	      			<ul class="gallery">
						<?php 
							$index = 1;
							$totalItems = count($this->pictures); 
							$nrFrameSlides = $this->appSettings->nr_images_slide;
						?>
						<?php foreach( $this->pictures as $picture ){ ?>
							<li>
								<a href="<?php echo JURI::root().PICTURES_PATH.$picture["company_picture_path"] ?>" rel="prettyPhoto[pp_gal]" title="<?php echo $picture["company_picture_info"] ?>"> 
									<img src="<?php echo JURI::root().PICTURES_PATH.$picture["company_picture_path"] ?>" alt="<?php echo $picture["company_picture_info"] ?>" />
								</a>
							</li>
							<?php 
								if( $index%$nrFrameSlides==0 && $index < $totalItems){
							?>
								</ul>
								</div>
								<div class="slide">
								<ul class="gallery">
							<?php 		
								}
								$index++;
							?>
						<?php } ?>
					</ul>
			
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>