$(function() {

	$.ajax({
		url : '../classes/class.main.php',
		type : 'POST',
		dataType : 'JSON',
		error : function(ts) {
			alert(ts.responseText)
		}
	}).done(
			function(data) {
				// Clear the table after click
				modelRoles.cList([]);

				/**
				 * Getting data [info][contacts] from the server and knockout
				 * saves it to contactList
				 * 
				 * @param arrayID,
				 *            array value
				 */
				$.each(data['qr_role'], function(arrayID, role) {

					modelRoles.vRoleID(role['vRoleID']);
					modelRoles.vRoleName(role['vRoleName']);
					modelRoles.vFunctionID(role['vFunctionID']);
					modelRoles.vNote(role['vNote']);
					
					modelRoles.cList.push(new modelRoles.rolesModel(
						modelRoles.vRoleID(), modelRoles.vRoleName(), modelRoles.vFunctionID(),
						modelRoles.vNote()));
				});
			});

	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

});
