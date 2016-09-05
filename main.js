jQuery(document).ready(function($){
	$("#startDate").datepicker({ dateFormat: "dd/mm/yy" });
	$("#endDate").datepicker({ dateFormat: "dd/mm/yy" });
	$("#datepicker").datepicker({ dateFormat: "dd/mm/yy" });
	$(document).foundation();
	
	$('#searchDistrict').multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableClickableOptGroups: true,
		enableCollapsibleOptGroups: true,
		includeDeselectAllOption: true,
		enableCaseInsensitiveFiltering: true,
		nonSelectedText: "Select district",
		onChange: function(option, checked) {
			var brands = $('#searchDistrict option:selected');
			var selected = [];
			$(brands).each(function(index, brand){
				selected.push([$(this).val()]);
			});

			if (selected.length > 0) {
				var mergedSelected = selected.join('|');
				table
				.columns( 8 )
				.search(mergedSelected,true)
				.draw();
				console.log(selected);
			} else {
				table
				.columns( '' )
				.search( '' )
				.draw();
			}	
		}
	});
	$('#areaOfInterest').multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableClickableOptGroups: true,
		enableCollapsibleOptGroups: true,
		includeSelectAllOption: true,
		enableCaseInsensitiveFiltering: true,
		nonSelectedText: "Select your abilities/interest",
		/*
		onChange: function(option, checked) {
			var interest = $('#areaOfInterest option:selected');
			var selected = [];
			$(brands).each(function(index, interest){
				selected.push([$(this).val()]);
			});
			
		}
		*/
	});
});