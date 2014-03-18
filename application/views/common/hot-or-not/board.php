<?
//print_r($_DATA);

$this->layout->info('less', 'hot-or-not.less');
$this->layout->info('less', 'flipper.less');
$this->layout->info('js', 'flipper.js');
$this->layout->info('js', 'hot-or-not.js');

if(isset($_DATA['listings']) && ! empty($_DATA['listings'])) {
	?>
<div id="listingFlicker">
	<?
	foreach($_DATA['listings'] as $listing) {
		if ($listing['price'] > 0) {
			$priceDisplay = number_format($listing['price'], 2, '.', ',');
		} else {
			$priceDisplay = "Available On Request";
		}
		?>
	<div data-listingid="<?=$listing['listing_id']?>" data-votehash="<?=$listing['votehash']?>" class="propContainer flip-container hideme archivelistingContianer" ontouchstart="this.classList.toggle('hover');">
		<div class="flipper flipstyle">
			<div class="front">
				<div style="background-image:url('<?=$listing['image_url']?>')" class="picture">
					<h1>
						<?=$listing['displayable_address']?><br />
						<span>&pound; <?= $priceDisplay; ?></span>
					</h1>
					
				</div>
			</div>
			<div class="back">
				<div style="background-image:url('<?=$listing['image_url']?>')" class="picture">
					<h1>
						<?=$listing['displayable_address']?>
						
					</h1>
					<div class="scrollPlane">
					<p class="details"> 
						<strong class="label">Address:</strong>
						<?=$listing['displayable_address'] ?>, <?=$listing['post_town']?>
						<br/>
						
						<strong class="label">Bedrooms:</strong>
						<?=$listing['num_bedrooms'] ?>
						<br/>
						<strong class="label">Bathrooms:</strong>
						<?=$listing['num_bathrooms'] ?>
						<br/>
						<strong class="label">Property Type:</strong>
						<?=$listing['property_type'] ?>
						<br/>
						<strong class="label">Reception Rooms:</strong> <?=$listing['num_recepts']?><br />
					</p>
					<p class="desc">
						<?=$listing['short_description']?><br/><br/><a href="<?=$listing['details_url']?>">More Details</a>
					</p>
					</div>
					
					 </div>
			</div>
			<button class="viewListingDetails">View Details</button>
		</div>
	</div>
	<?	
	}
		echo $this->layout->common('hot-or-not/buttons', $_DATA); 
	?>
	
</div>
<?
	
	
} else { 
	echo $this->layout->common('message', array('type' => 'notice', 'message' => 'Sorry, we have no listings here'));
	
 } ?>
