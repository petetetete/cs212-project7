// Save feedback messages
const EMPTY_MESAGE = "Field is required";

// Get all forms on the page
let forms = document.querySelectorAll("form");

// For every form
forms.forEach((form) => {

	// Get all inputs, textareas, and selects in the form and spread operate them all into one big array
	let inputs = [...form.querySelectorAll("input"), 
				  ...form.querySelectorAll("textarea"),
				  ...form.querySelectorAll("select")];

	// Object used to keep track of inputs with errors
	let errors = {};

	// For each input
	inputs.forEach((input, position) => {

		// When an input is 'blurred', or left, check if it is empty and add a data attribute if so
		input.onblur = (e) => {
			if (e.target.value == "") {
				if (e.target.nodeName != "SELECT") e.target.value = EMPTY_MESAGE; // Set input value to error message
				errors[position] = true; // Add key-value to errors object
				e.target.dataset.error = "true";
			}
			else {
				delete errors[position]; // Remove error from errors object
				e.target.removeAttribute("data-error");
			}
		}

		// When a user enters an input, temporarily remove the error, give them the benefit of the doubt ;)
		input.onfocus = (e) => {
			if (errors[position]) {
				e.target.value = ""; // Remove error message
				delete errors[position]; // Remove error from errors object
				e.target.removeAttribute("data-error");
			}
		}
	});

	// When the user tries to submit, check if there are any errors, and if so, do not submit
	form.onsubmit = (e) => {
		// Check if every input is valid
		inputs.forEach((input) => {
			input.focus();
			input.blur();
		});
		return !Object.keys(errors).length;
	}
});
