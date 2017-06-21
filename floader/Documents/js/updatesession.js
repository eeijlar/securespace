// Calculate the total for items in the form which are selected.
function calculateTotal(inputItem,sessionCost) {
	//InitForm();
 	document.selectionForm.quantity.value=parseInt(inputItem.value);
 	document.selectionForm.amount.value= parseInt(sessionCost);

  	return ("\u20AC" + (inputItem.value * sessionCost));  
}

// This function initialzes all the form elements to default values.
function InitForm() {
  // Reset values on form.
  document.selectionForm.total.value='$0';
  document.selectionForm.calculatedTotal.value=0;
  document.selectionForm.previouslySelectedRadioButton.value=0;

  // Set all checkboxes and radio buttons on form to unchecked.
  for (i=0; i < document.selectionForm.elements.length; i++) {
    if (document.selectionForm.elements[i].type == 'radio') {
      document.selectionForm.elements[i].checked = false;
    }
  }
}

