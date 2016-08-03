var modelRoles =
{
	vRoleID : ko.observable(),
	vRoleName : ko.observable(),
	vFunctionID : ko.observable(),
	vNote : ko.observable(),
	
	cList : ko.observableArray([]),

	onRequest : function(req, options, callback)
	{
		var json, self = this;

		json = ko.toJS(modelRoles);
		json.request = req;

		$.ajax(
		{
			url : '../classes/class.main.php',
			type : 'POST',
			data :
			{
				'json' : JSON.stringify(json)
			},
			success : function(data)
			{
				window[callback](data);
			}

		});
	},

	// Student Model
	rolesModel : function(vRoleID, vRoleName, vFunctionID, vNote)
	{
		var self = this;
		self.vRoleID = ko.observable(vRoleID);
		self.vRoleName = ko.observable(vRoleName);
		self.vFunctionID = ko.observable(vFunctionID);
		self.vNote = ko.observable(vNote);
	},
};

ko.applyBindings(modelRoles);