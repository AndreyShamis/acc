<div class="{$col}" onclick="openHiddenPanel('hiddenPanelTpl{$id}');">
	<table style='width:95%;'><tr>
	<td style="width:80%;text-align:left;">{$quiz_question}</td>
	<td>{$subject_name}</td>
	</tr></table>
</div>
<div id="hiddenPanelTpl{$id}" class="hide_object">
	<table style='width:95%;'>
	<tr><td style="text-align:left;">
	<strong>Question</strong>:{$quiz_question}<br /><br />
	<textarea>{$quiz_code}</textarea>
	{$quiz_answer}
	<br />{$subject_name}<br />
	<div>{$urls}</div>
	</td><td style="text-align:left;width:30%">{$answers}</td>
	</tr></table>
</div>