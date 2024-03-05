
// Add a box shadow to any table cell on mouse over
function highlight() {
	$(this).css("box-shadow", "1px 1px 3px #8a0024");
}

// Remove box shadow on mouse out over all table cells
function unHighlight() {
	$(this).css("box-shadow", "");
}


// When a cell with an event is clicked, more information about the event is provided
function viewInfo() {
	$(this).addClass("highlight");
	$(this).children("p").addClass("highlight");
	$(this).children("p").css("display", "block");
	
	$(this).mouseout(unView);
	$(this).children("p").mouseout(unView);
}

// When the mouse leaves after clicking, the cell is returned to original state
function unView() {
	$(this).removeClass("highlight");
	$(this).children("p").removeClass("highlight");
	$(this).children("p").css("display", "none");
}

// Add effects only to cells with data, cells with more than the date can also be clicked for more information
for(let i = 0; i < $("td").length; i++) {
	$currCell = $("td").eq(i);
	if($currCell.text() !== "") {
		$currCell.hover(highlight, unHighlight);
	}
	if($currCell.text().length > 2) {
		$currCell.click(viewInfo);
	}
}