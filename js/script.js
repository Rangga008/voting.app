document.addEventListener("DOMContentLoaded", function () {
	const form = document.querySelector("form");
	form.addEventListener("submit", function (event) {
		let valid = true;
		const selects = document.querySelectorAll('select[name^="candidate"]');

		selects.forEach((select) => {
			if (select.value === "") {
				valid = false;
			}
		});

		if (!valid) {
			event.preventDefault();
			alert("Please select a candidate for each factor before voting.");
		} else {
			const confirmation = confirm(
				"Are you sure you want to submit your vote?"
			);
			if (!confirmation) {
				event.preventDefault();
			}
		}
	});
});
