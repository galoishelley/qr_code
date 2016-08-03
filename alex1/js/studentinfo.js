$(function() {

	$.ajax({
		url : 'classes/class.main.php',
		type : 'POST',
		dataType : 'JSON',
		error : function(ts) {
			alert(ts.responseText)
		}
	}).done(
			function(data) {
				// Clear the table after click
				viewModel.cList([]);

				/**
				 * Getting data [info][contacts] from the server and knockout
				 * saves it to contactList
				 * 
				 * @param arrayID,
				 *            array value
				 */
				$.each(data['contacts'], function(arrayID, person) {

					viewModel.cID(person['cID']);
					viewModel.cFName(person['cFName']);
					viewModel.cLName(person['cLName']);
					viewModel.cEmail(person['cEmail']);
					viewModel.cTitle(person['cTitle']);
					viewModel.cPhone(person['cPhone']);
					viewModel.cNotes(person['cNotes']);

					viewModel.cList.push(new viewModel.contactModel(

					viewModel.cID(), viewModel.cFName(), viewModel.cLName(),
							viewModel.cEmail(), viewModel.cTitle(), viewModel
									.cPhone(), viewModel.cNotes()));

				});

			});

	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

});
