/** JS SamsonCMS Select field interaction */
SamsonCMS_InputSelect = function(fields)
{
	// Create Select field instance with save handler
	SamsonCMS_InputField(fields, function(responce, field, sp)
	{
		sp.html(s('option:selected',field).html());
	});
};

s('.__inputfield.__select').pageInit(SamsonCMS_InputSelect);