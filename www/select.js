/** JS SamsonCMS Select field interaction */
SamsonCMS_InputSelect = function(fields)
{
	// Create Select field instance with save handler
	SamsonCMS_InputText(fields, function(responce, field, sp)
	{
		sp.html(s('option:selected',field).html());
	});
};

// Bind input
SamsonCMS_Input.bind(SamsonCMS_InputSelect, '.__inputfield.__select');