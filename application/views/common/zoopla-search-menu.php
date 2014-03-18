<?
	$this->layout->info('less', 'searchbox.less');
	$this->layout->info('js', 'searchbox.js');
	
?>

<div id="searchContainer">
	<button id="openCloseSearch">Add some search terms</button>
	<div id="options"> <span class="optionBlock <?=(isset($_DATA['searchterms']['order_by']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchOrderBy">Order By</label>
		<select id="searchOrderBy" name="order_by">
			<option value="age" <?=(isset($_DATA['searchterms']['order_by']) && $_DATA['searchterms']['order_by'] == "age" ? "selected" : "") ?>>Age</option>
			<option value="price" <?=(isset($_DATA['searchterms']['order_by']) && $_DATA['searchterms']['order_by'] == "price" ? "selected" : "") ?>>Price</option>
		</select>
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['listing_status']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchStatus">Status</label>
		<select id="searchStatus" name="listing_status">
			<option value="">Both</option>
			<option value="sale"  <?=(isset($_DATA['searchterms']['listing_status']) && $_DATA['searchterms']['listing_status'] == "sale" ? "selected" : "") ?>>Sale</option>
			<option value="rent"  <?=(isset($_DATA['searchterms']['listing_status']) && $_DATA['searchterms']['listing_status'] == "rent" ? "selected" : "") ?>>Rent</option>
		</select>
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['radius']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchRadius">Radius</label>
		<input id="searchRadius" type="range" name="radius" min="1" max="20" step="0.5"  value="<?=(isset($_DATA['searchterms']['radius']) && $_DATA['searchterms']['order_by'] == "radius" ? $_DATA['searchterms']['order_by'] : "") ?>">
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['include_sold']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchIncludeSold">Include Sold Properties</label>
		<select id="searchIncludeSold"  name="include_sold">
			<option value="">Both</option>
			<option value="0"  <?=(isset($_DATA['searchterms']['include_sold']) && $_DATA['searchterms']['include_sold'] == "0" ? "selected" : "") ?>>Yes</option>
			<option value="1" <?=(isset($_DATA['searchterms']['include_sold']) && $_DATA['searchterms']['include_sold'] == "1" ? "selected" : "") ?>>No</option>
		</select>
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['include_rented']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchIncludeRented">Include Rented Properties</label>
		<select id="searchIncludeRented"  name="include_rented">
			<option value="">Both</option>
			<option value="0" <?=(isset($_DATA['searchterms']['include_rented']) && $_DATA['searchterms']['include_rented'] == "1" ? "selected" : "") ?>>Yes</option>
			<option value="1" <?=(isset($_DATA['searchterms']['include_rented']) && $_DATA['searchterms']['include_rented'] == "1" ? "selected" : "") ?>>No</option>
		</select>
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['minimum_price']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchPriceMin">Min. Price (£)</label>
		<input id="searchPriceMin" type="number"  name="minimum_price" value="<?=(isset($_DATA['searchterms']['minimum_price'])? $_DATA['searchterms']['order_by'] : "") ?>">
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['maximum_price']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchPriceMax">Max. Price (£)</label>
		<input id="searchPriceMax" type="number" name="maximum_price" value="<?=(isset($_DATA['searchterms']['maximum_price']) ? $_DATA['searchterms']['maximum_price'] : "") ?>">
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['minimum_beds']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchBedsMin">Min. Beds</label>
		<input id="searchBedsMin" type="number"  name="minimum_beds" value="<?=(isset($_DATA['searchterms']['minimum_beds'])  ? $_DATA['searchterms']['minimum_beds'] : "") ?>">
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['maximum_beds']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchBedsMax">Max. Beds</label>
		<input id="searchBedsMax" type="number"  name="maximum_beds" value="<?=(isset($_DATA['searchterms']['maximum_beds']) ? $_DATA['searchterms']['maximum_beds'] : "") ?>">
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['order_by']) ? "furnished" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchFurnished">Furnishing</label>
		<select id="searchFurnished" name="furnished">
			<option value=""  <?=(isset($_DATA['searchterms']['furnished']) && $_DATA['searchterms']['furnished'] == "1" ? "selected" : "") ?>>All</option>
			<option value="furnished" <?=(isset($_DATA['searchterms']['furnished']) && $_DATA['searchterms']['furnished'] == "furnished" ? "selected" : "") ?>>Furnished</option>
			<option value="unfurnished <?=(isset($_DATA['searchterms']['furnished']) && $_DATA['searchterms']['furnished'] == "unfurnished" ? "selected" : "") ?>">Unfurnished</option>
			<option value="part-furnished <?=(isset($_DATA['searchterms']['furnished']) && $_DATA['searchterms']['furnished'] == "part-furnished" ? "selected" : "") ?>">Partly Furnished</option>
		</select>
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['property_type']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchPropertyType">Property Type</label>
		<select id="searchPropertyType" name="property_type">
			<option value="" <?=(isset($_DATA['searchterms']['property_type']) && $_DATA['searchterms']['property_type'] == "" ? "selected" : "") ?> >Both</option>
			<option value="houses" <?=(isset($_DATA['searchterms']['property_type']) && $_DATA['searchterms']['property_type'] == "houses" ? "selected" : "") ?>>Houses</option>
			<option value="flats" <?=(isset($_DATA['searchterms']['property_type']) && $_DATA['searchterms']['property_type'] == "flats" ? "selected" : "") ?>>Flats</option>
		</select>
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['new_homes']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchNewHomes">New Homes</label>
		<select id="searchNewHomes" name="new_homes">
			<option value="" <?=(isset($_DATA['searchterms']['new_homes']) && $_DATA['searchterms']['new_homes'] == "" ? "selected" : "") ?>>All Homes</option>
			<option value="yes" <?=(isset($_DATA['searchterms']['new_homes']) && $_DATA['searchterms']['new_homes'] == "yes" ? "selected" : "") ?>>New homes only</option>
		</select>
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['chain_free']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchChainFree">Chain Free</label>
		<select id="searchChainFree" name="chain_free">
			<option value="" <?=(isset($_DATA['searchterms']['chain_free']) && $_DATA['searchterms']['chain_free'] == "" ? "selected" : "") ?>>All Homes</option>
			<option value="yes" <?=(isset($_DATA['searchterms']['chain_free']) && $_DATA['searchterms']['chain_free'] == "yes" ? "selected" : "") ?>>Chain free only</option>
		</select>
		</span>



<span class="optionBlock <?=(isset($_DATA['searchterms']['keywords']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchKeywords">Keywords</label>
		<input type="text" id="searchKeywords" name="keywords"  value="<?=(isset($_DATA['searchterms']['keywords']) ? $_DATA['searchterms']['keywords'] : "") ?>">
		</span>



 <span class="optionBlock <?=(isset($_DATA['searchterms']['postcode']) ? "opened" : "") ?>">
		<button class="deleteMe">X</button>
		<label for="searchPostcode">Postcode</label>
	<!--	<input type="text" id="searchPostcode" placeholder="area" name="area" value="<?=(isset($_DATA['searchterms']['area']) ? $_DATA['searchterms']['area'] : "") ?>">
		or -->
		<input type="text" id="searchPostcode2" placeholder="Postcode" name="postcode" value="<?=(isset($_DATA['searchterms']['postcode']) ? $_DATA['searchterms']['postcode'] : "") ?>">
		</span>



 <span class="optionBlock">
		<button id="searchParams">Search with these options</button>
		<button id="searchClear">Clear search terms</button>
	</div>
</div>
