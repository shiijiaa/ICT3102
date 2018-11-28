<?php
echo '
<div id="locationFeedbackSubmission" class="col-xs-12">
	<iframe name="preventRefresh" style="display:none;"></iframe>
	<form onsubmit="submitFeedback(rating.value, comment.value)" target="preventRefresh">
		<p>Submit Feedback</p>
		
		<fieldset id="ratingField" class="rate">
			<input type="radio" id="rating5" name="rating" value="5" required/><label for="rating5" title="5 Stars"></label>
			<input type="radio" id="rating4.5" name="rating" value="4.5" /><label class="half" for="rating4.5" title="4.5 Stars"></label>
			<input type="radio" id="rating4" name="rating" value="4" /><label for="rating4" title="4 Stars"></label>
			<input type="radio" id="rating3.5" name="rating" value="3.5" /><label class="half" for="rating3.5" title="3.5 Stars"></label>
			<input type="radio" id="rating3" name="rating" value="3" /><label for="rating3" title="3 Stars"></label>
			<input type="radio" id="rating2.5" name="rating" value="2.5" /><label class="half" for="rating2.5" title="2.5 Stars"></label>
			<input type="radio" id="rating2" name="rating" value="2" /><label for="rating2" title="2 Stars"></label>
			<input type="radio" id="rating1.5" name="rating" value="1.5" /><label class="half" for="rating1.5" title="1.5 Stars"></label>
			<input type="radio" id="rating1" name="rating" value="1" /><label for="rating1" title="1 Stars"></label>
			<input type="radio" id="rating0.5" name="rating" value="0.5" /><label class="half" for="rating0.5" title="0.5 Stars"></label>
			<input type="radio" id="rating0" name="rating" value="0" /><label for="rating0" title="0 Stars"></label>
		</fieldset>
		
		<textarea id="inputComment" rows="1" name="comment" maxlength="255" required></textarea>
		<input class="submitFeedbackBtn" type="submit" class="btn btn-large btn-primary" value="Submit">
	</form>
</div>
';
?>