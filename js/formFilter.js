(function () {
console.log(formFilter.adminAjax)
// function makeRequest () {
	
// }
// for (var i = 0; i < formFilter.formIds.length; i++) {
// 	var selectedFormId = document.getElementById(formFilter.formIds[i])
// 	console.log(selectedFormId);
// 	selectedFormId.onsubmit = function (e) {
// 		console.log(selectedFormId)
// 		e.preventDefault()
// 		// var data = serializeForm(selectedFormId)
// 		// console.log(data)
		
// 		var request = new XMLHttpRequest();

// 		request.open('POST', formFilter.adminAjax, true);
// 		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
// 		request.onload = function () {
// 			if (this.status >= 200 && this.status < 400) {
// 				// If successful
// 				console.log(this.response);
// 			} else {
// 				// If fail
// 				console.log(this.response);
// 			}
// 		};
// 		request.onerror = function () {
// 			// Connection error
// 		};
// 		request.send('action=test_action&data=sdsd');
// 		return false
// 	}
// }

console.log('sds')

function serializeForm (form) {
	var formData = []
	for (var z = 0; z < form.elements.length; z++) {
		var field = form.elements[z]
		console.log(field.id)
		if (!field.name || field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button') continue;

		if (field.type === 'select-multiple') {
			for (var r = 0; r < field.options.length; r++) {
				if (!field.options[r].selected) continue;
				formData.push({
					name: field.name,
					value: field.options[r].value
				})
			}
		} 
		else if ((field.type !== 'checkbox' && field.type !== 'radio') || field.checked) {
			formData.push(encodeURIComponent(field.name) + "=" + encodeURIComponent(document.getElementsByName(field.name)[0].value))
		}
	}
	
	return formData.join('&');
}

	document.addEventListener('submit', function (event) {
		event.preventDefault()
		console.log(event)
		for (var i = 0; i < formFilter.formIds.length; i++) {
			var selectedFormId = document.getElementById(formFilter.formIds[i])
			// console.log(selectedFormId.id);
			if (event.target.matches('#' + selectedFormId.id)) {
				// console.log('here')
						var request = new XMLHttpRequest();
		var data = serializeForm(selectedFormId)
	console.log(data)
		request.open('POST', formFilter.adminAjax, true);
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
		request.onload = function () {
			if (this.status >= 200 && this.status < 400) {
				// If successful
				console.log(this.response);
			} else {
				// If fail
				console.log(this.response);
			}
		};
		request.onerror = function () {
			// Connection error
		};
		request.send('action=test_action&' + data);
			}
		}
		

		if (event.target.matches('.close')) {
			// Run your code to close a modal
		}

	}, false);
})()