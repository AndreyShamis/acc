

function openHiddenPanel(panel_id)
{
	var panel_obj = document.getElementById(panel_id);
	if(panel_obj.className == 'show_object')
		panel_obj.className = 'hide_object';	
	else
		panel_obj.className = 'show_object';
}


function listSwitcher(obj, p)
{
    var val = obj.options[obj.selectedIndex].value;
    if(obj.selectedIndex != -1)
        window.location = 'index.php?pg='+ p +'&cl=1&di='+ val;
}